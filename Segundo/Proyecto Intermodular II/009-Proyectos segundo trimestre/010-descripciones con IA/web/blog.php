<?php
// blog.php — listado de posts desde /posts/**/*.md (recursivo)
// Layout inspirado en tu index (Appleweb-like + tarjetas con fondo imagen aleatoria)

error_reporting(E_ALL);
ini_set('display_errors', 1);

function h($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
function norm($p){ return str_replace('\\','/',$p); }

/**
 * Devuelve rutas absolutas de .md dentro de /posts (recursivo).
 */
function list_post_md_files(string $postsDirAbs): array {
  if (!is_dir($postsDirAbs)) return [];
  $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($postsDirAbs));
  $out = [];
  foreach ($rii as $file) {
    if ($file->isDir()) continue;
    $p = (string)$file->getPathname();
    if (preg_match('/\.md$/i', $p)) $out[] = $p;
  }
  sort($out);
  return $out;
}

/**
 * Parsea un archivo markdown con front matter YAML
 * Retorna: ['frontmatter' => [...], 'content' => '...']
 */
function parse_markdown_file(string $abs): ?array {
  $raw = @file_get_contents($abs);
  if ($raw === false) return null;
  
  $raw = trim($raw);
  
  // Detectar front matter: ---\n...\n---
  if (!preg_match('/^---\s*\n(.*?)\n---\s*\n(.*)$/s', $raw, $m)) {
    // Sin front matter, todo es contenido
    return [
      'frontmatter' => [],
      'content' => $raw
    ];
  }
  
  $yamlRaw = $m[1];
  $content = trim($m[2]);
  
  // Parsear YAML simple (solo key: "value" o key: [val1, val2])
  $fm = [];
  $lines = explode("\n", $yamlRaw);
  foreach ($lines as $line) {
    $line = trim($line);
    if ($line === '' || $line[0] === '#') continue;
    
    // key: "value"
    if (preg_match('/^(\w+):\s*"(.*)"\s*$/', $line, $lm)) {
      $fm[$lm[1]] = $lm[2];
      continue;
    }
    
    // key: value (sin comillas)
    if (preg_match('/^(\w+):\s*(.+?)\s*$/', $line, $lm)) {
      $key = $lm[1];
      $val = $lm[2];
      
      // Array: ["item1", "item2"]
      if (preg_match('/^\[(.*)\]$/', $val, $am)) {
        $items = explode(',', $am[1]);
        $arr = [];
        foreach ($items as $it) {
          $it = trim($it);
          $it = trim($it, '"\'');
          if ($it !== '') $arr[] = $it;
        }
        $fm[$key] = $arr;
        continue;
      }
      
      // Valor simple
      $fm[$key] = trim($val, '"\'');
    }
  }
  
  return [
    'frontmatter' => $fm,
    'content' => $content
  ];
}

function abs_to_web(string $abs, string $baseDirAbs): string {
  $abs = norm($abs);
  $baseDirAbs = rtrim(norm($baseDirAbs), '/');
  if (str_starts_with($abs, $baseDirAbs)) {
    return ltrim(substr($abs, strlen($baseDirAbs)), '/');
  }
  return $abs;
}

function list_images_in_dir(string $dirAbs): array {
  if (!is_dir($dirAbs)) return [];
  $exts = ['jpg','jpeg','png','webp','gif'];
  $files = [];
  foreach ($exts as $e) {
    foreach (glob($dirAbs . '/*.' . $e) ?: [] as $f) if (is_file($f)) $files[] = $f;
    foreach (glob($dirAbs . '/*.' . strtoupper($e)) ?: [] as $f) if (is_file($f)) $files[] = $f;
  }
  return array_values(array_unique($files));
}

function pick_random_blog_bg(string $baseDirAbs): string {
  // 1) Si existe /posts/img/, usa esa
  $candidates = list_images_in_dir($baseDirAbs . '/posts/img');
  // 2) fallback: /img/blog/
  if (count($candidates) === 0) $candidates = list_images_in_dir($baseDirAbs . '/img/blog');
  // 3) fallback: /img/
  if (count($candidates) === 0) $candidates = list_images_in_dir($baseDirAbs . '/img');

  if (count($candidates) === 0) return ""; // sin imagen
  $pick = $candidates[array_rand($candidates)];
  $pickWeb = abs_to_web($pick, $baseDirAbs);
  $pickWeb .= (str_contains($pickWeb, '?') ? '&' : '?') . 'v=' . @filemtime($pick);
  return $pickWeb;
}

function post_date_ts(string $d): int {
  // espera YYYY-MM-DD
  $t = strtotime($d);
  return $t ? $t : 0;
}

// Base del proyecto (carpeta donde está blog.php)
$BASE_DIR = __DIR__;

// Header categorías (reuse)
$cats = [];
$catsFile = __DIR__ . '/db/categorias.json';
if (file_exists($catsFile)) {
  $cats = json_decode(file_get_contents($catsFile), true);
  if (!is_array($cats)) $cats = [];
}

// Leer posts desde /posts
$POSTS_DIR = $BASE_DIR . '/posts';
$mdFiles = list_post_md_files($POSTS_DIR);

$allPosts = [];
foreach ($mdFiles as $f) {
  $parsed = parse_markdown_file($f);
  if (!is_array($parsed)) continue;
  
  $fm = $parsed['frontmatter'];
  $content = $parsed['content'];
  
  // Validar que tenga título y contenido
  $title = trim((string)($fm['title'] ?? ''));
  if ($title === '' || trim($content) === '') continue;
  
  // Construir post
  $post = [
    'title' => $title,
    'date' => (string)($fm['date'] ?? ''),
    'excerpt' => (string)($fm['excerpt'] ?? ''),
    'categories' => $fm['categories'] ?? [],
    'tags' => $fm['tags'] ?? [],
    'content' => $content,
    '_source' => $f,
    '_date_ts' => post_date_ts((string)($fm['date'] ?? ''))
  ];
  
  if (!is_array($post['categories'])) $post['categories'] = [];
  if (!is_array($post['tags'])) $post['tags'] = [];
  
  $allPosts[] = $post;
}

// Filtros (opcional): ?cat=...  ?q=...
$filterCat = isset($_GET['cat']) ? trim((string)$_GET['cat']) : '';
$q = isset($_GET['q']) ? trim((string)$_GET['q']) : '';

$filtered = [];
foreach ($allPosts as $p) {
  $ok = true;

  if ($filterCat !== '') {
    $pc = $p['categories'] ?? [];
    if (!is_array($pc)) $pc = [];
    $ok = in_array($filterCat, $pc, true);
  }
  if ($ok && $q !== '') {
    $hay = strtolower(($p['title'] ?? '') . ' ' . ($p['excerpt'] ?? '') . ' ' . ($p['content'] ?? ''));
    $ok = str_contains($hay, strtolower($q));
  }

  if ($ok) $filtered[] = $p;
}

// Orden: más reciente primero
usort($filtered, function($a,$b){
  return ($b['_date_ts'] ?? 0) <=> ($a['_date_ts'] ?? 0);
});

?>
<!doctype html>
<html lang="es">
  <head>
    <title>JOCARSA | Blog</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="https://jocarsa.com/blog.php">

    <style>
      @font-face {font-family: Ubuntu;src: url(estilo/Ubuntu-R.ttf);}
      @font-face {font-family: UbuntuB;src: url(estilo/Ubuntu-B.ttf);}

      html,body{
        padding:0;margin:0;
        font-family:Ubuntu,sans-serif;
        width:100%;height:100%;
        background:#fff;
      }

      header{
        width:100%;
        display:flex;
        justify-content:center;
        align-items:center;
        box-shadow:0px 2px 4px rgba(0,0,0,0.3);
        gap:20px;
        padding:10px;
        position:sticky;
        top:0;
        background:rgba(255,255,255,0.95);
        backdrop-filter:saturate(180%) blur(12px);
        z-index:10;
        flex-wrap:wrap;
      }
      header img{width:30px;}
      header a{
        text-decoration:none;color:indigo;font-size:11px;
        display:flex;gap:5px;align-items:center;
      }
      header a h1{font-size:14px;margin:0;}
      .search{
        display:flex;gap:8px;align-items:center;
        border:1px solid rgba(0,0,0,0.12);
        border-radius:999px;
        padding:6px 10px;
        background:#fff;
      }
      .search input{
        border:0;outline:none;
        font-size:12px;
        width:180px;
        font-family:Ubuntu,sans-serif;
      }
      .search button{
        border:0;
        background:indigo;
        color:#fff;
        padding:6px 10px;
        border-radius:999px;
        cursor:pointer;
        font-size:12px;
      }

      main{
        width:100%;
        display:grid;
        grid-template-columns:1fr;
        gap:10px;
        padding:10px;
        box-sizing:border-box;
      }

      main article{
        width:100%;
        min-height:420px;
        display:flex;
        justify-content:center;
        align-items:center;
        flex-direction:column;
        gap:10px;
        position:relative;
        overflow:hidden;
        border:1px solid rgba(0,0,0,0.08);
        box-shadow:0px 10px 30px rgba(0,0,0,0.06);
        background:lightgrey;
        background-size:cover;
        background-position:center;
        padding:22px;
        box-sizing:border-box;
      }

      main article::before{
        content:"";
        position:absolute; inset:0;
        z-index:0;
      }

      main article h3, main article h4, main article p, main article a, main article .meta{
        position:relative; z-index:1;
        padding:0;margin:0;text-align:center;color:white;
      }
      main article h3{font-family:UbuntuB,Ubuntu,sans-serif;font-size:42px;line-height:1.05;}
      main article h4{font-size:18px;font-weight:bold;max-width:900px;padding:0 16px;box-sizing:border-box;}
      main article p{
        max-width:900px;
        text-align:center;
        color:white;
        font-size:13px;
        line-height:1.45;
      }
      .meta{
        font-size:12px;
        opacity:0.95;
        display:flex;
        gap:10px;
        flex-wrap:wrap;
        justify-content:center;
      }
      .chip{
        background:rgba(255,255,255,0.18);
        border:1px solid rgba(255,255,255,0.22);
        padding:6px 10px;
        border-radius:999px;
        font-size:12px;
        color:white;
        text-decoration:none;
      }

      main article a.cta{
        background:indigo;
        text-decoration:none;
        color:white;
        padding:10px 20px;
        border-radius:50px;
        font-size:12px;
        border:1px solid rgba(255,255,255,0.25);
      }

      /* 2 columnas a partir de 600px, pero los 2 primeros full width */
      @media (min-width:600px){
        main{ grid-template-columns:1fr 1fr; }
        main article:nth-child(-n+2){ grid-column:1 / -1; }
      }

      footer{
        display:flex;justify-content:center;gap:20px;
        padding:20px;font-size:11px;flex-wrap:wrap;
      }
      footer article{display:flex;flex-direction:column;gap:10px;}
      footer article a{text-decoration:none;color:indigo;}

      .social img{
        width: 16px;
        margin-left: 6px;
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.4));
      }
      .social a:hover img { transform: translateY(-1px); }
      .social{display:flex;}

      article *{ text-shadow:0px 0px 25px white; }
    </style>
  </head>
  <body>

    <header>
      <a href="index.php"><img src="https://static.jocarsa.com/logos/jocarsa%20%7C%20Indigo.svg" alt="jocarsa"><h1>jocarsa</h1></a>

      <a href="blog.php" style="font-weight:bold;">Blog</a>

      <?php for($i=0;$i<count($cats);$i++){ ?>
        <a href="index.php?cat=<?= h($cats[$i]) ?>"><?= h($cats[$i]) ?></a>
      <?php } ?>

      <a href="pagina.php?p=sobrenosotros">Sobre nosotros</a>
      <a href="contacto.php">Contacto</a>

      <form class="search" method="get" action="blog.php">
        <?php if($filterCat !== ''){ ?>
          <input type="hidden" name="cat" value="<?= h($filterCat) ?>">
        <?php } ?>
        <input type="text" name="q" value="<?= h($q) ?>" placeholder="Buscar en el blog...">
        <button type="submit">Buscar</button>
      </form>

      <div class="social">
        <a href="https://facebook.com/carratala" aria-label="Facebook de José Vicente Carratalá Sanchis"><img src="https://jocarsa.com/logos/facebook.png" alt="Facebook" loading="lazy" decoding="async"></a>
        <a href="https://www.instagram.com/jvcarratala/" aria-label="Instagram de José Vicente Carratalá Sanchis"><img src="https://jocarsa.com/logos/instagram.png" alt="Instagram" loading="lazy" decoding="async"></a>
        <a href="mailto:info@josevicentecarratala.com" aria-label="Enviar correo a José Vicente Carratalá Sanchis"><img src="https://jocarsa.com/logos/email.png" alt="Email" loading="lazy" decoding="async"></a>
        <a href="https://github.com/jocarsa" aria-label="GitHub de José Vicente Carratalá Sanchis"><img src="https://jocarsa.com/logos/github.png" alt="GitHub" loading="lazy" decoding="async"></a>
        <a href="https://josevicentecarratala.com" aria-label="Web principal de José Vicente Carratalá Sanchis"><img src="https://jocarsa.com/logos/home.png" alt="Web" loading="lazy" decoding="async"></a>
        <a href="https://www.linkedin.com/in/jvcarratala/" aria-label="LinkedIn de José Vicente Carratalá Sanchis"><img src="https://jocarsa.com/logos/linkedin.png" alt="LinkedIn" loading="lazy" decoding="async"></a>
        <a href="https://wa.me/34620891718" aria-label="WhatsApp de José Vicente Carratalá Sanchis"><img src="https://jocarsa.com/logos/whatsapp.png" alt="WhatsApp" loading="lazy" decoding="async"></a>
        <a href="https://www.youtube.com/@VicenteCarratala" aria-label="YouTube de José Vicente Carratalá Sanchis"><img src="https://jocarsa.com/logos/youtube.png" alt="YouTube" loading="lazy" decoding="async"></a>
      </div>
    </header>

    <main>
      <?php
        if (count($filtered) === 0){
          $msg = "No hay posts todavía en /posts o no coinciden con el filtro.";
          if ($filterCat !== '' || $q !== '') $msg = "No hay resultados con ese filtro.";
      ?>
        <article style="background:#f2f2f2;color:#000;">
          <h3 style="color:#111;text-shadow:none;">Blog</h3>
          <h4 style="color:#111;text-shadow:none;"><?= h($msg) ?></h4>
          <a class="cta" href="blog.php" style="text-shadow:none;">Ver todo</a>
        </article>
      <?php
        } else {
          foreach ($filtered as $p){
            $title = (string)($p['title'] ?? '');
            $excerpt = (string)($p['excerpt'] ?? '');
            $date = (string)($p['date'] ?? '');
            $categories = $p['categories'] ?? [];
            if (!is_array($categories)) $categories = [];
            $tags = $p['tags'] ?? [];
            if (!is_array($tags)) $tags = [];

            // URL al post: blog_post.php?f=... (ruta relativa)
            $srcAbs = (string)($p['_source'] ?? '');
            $srcWeb = abs_to_web($srcAbs, $BASE_DIR);
            $href = "blog_post.php?f=" . rawurlencode($srcWeb);

            // Fondo: imagen aleatoria
            $bg = pick_random_blog_bg($BASE_DIR);
            $bgStyle = "";
            if ($bg !== "") {
              $bgStyle = "background-image:url('img/negrotrans.png'),url('".h($bg)."');";
            }
      ?>
        <article style="<?= h($bgStyle) ?>">
          <h3><?= h($title) ?></h3>
          <?php if($excerpt !== ''){ ?>
            <h4><?= h($excerpt) ?></h4>
          <?php } ?>

          <div class="meta">
            <?php if($date !== ''){ ?><span class="chip"><?= h($date) ?></span><?php } ?>
            <?php
              // mostrar 1-2 categorías
              for($c=0;$c<min(2,count($categories));$c++){
                $cat = (string)$categories[$c];
                if($cat==='') continue;
            ?>
              <a class="chip" href="blog.php?cat=<?= h(rawurlencode($cat)) ?>"><?= h($cat) ?></a>
            <?php } ?>
            <?php
              // 2 tags
              for($t=0;$t<min(2,count($tags));$t++){
                $tag = (string)$tags[$t];
                if($tag==='') continue;
            ?>
              <span class="chip"><?= h($tag) ?></span>
            <?php } ?>
          </div>

          <a class="cta" href="<?= h($href) ?>">Leer artículo</a>
        </article>
      <?php
          }
        }
      ?>
    </main>

    <footer>
      <?php
        $footer = [];
        $footerFile = __DIR__ . '/db/piedepagina.json';
        if (file_exists($footerFile)) {
          $footer = json_decode(file_get_contents($footerFile), true);
          if (!is_array($footer)) $footer = [];
        }
        $catsFooter = $footer['categorias'] ?? [];
        $linksFooter = $footer['enlaces'] ?? [];
      ?>
      <article class="categorias">
        <?php if(is_array($catsFooter)) for($i=0;$i<count($catsFooter);$i++){?>
          <a href="index.php?cat=<?= h($catsFooter[$i]) ?>"><?= h($catsFooter[$i]) ?></a>
        <?php } ?>
      </article>

      <article class="paginas">
        <?php if(is_array($linksFooter)) for($i=0;$i<count($linksFooter);$i++){
          $enlace = (string)($linksFooter[$i]['enlace'] ?? '#');
          $nombreLink = (string)($linksFooter[$i]['nombre'] ?? '');
        ?>
          <a href="<?= h($enlace) ?>"><?= h($nombreLink) ?></a>
        <?php } ?>
      </article>
    </footer>

  </body>
</html>
<?php include "sitemap.php"; ?>
<?php include 'logger.php'; ?>
