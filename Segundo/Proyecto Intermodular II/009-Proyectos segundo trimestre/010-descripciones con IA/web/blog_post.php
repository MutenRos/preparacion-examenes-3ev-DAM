<?php
// blog_post.php — muestra un post individual desde archivo .md
// Recibe: ?f=posts/jocarsa-xxx/slug_timestamp.md

error_reporting(E_ALL);
ini_set('display_errors', 1);

function h($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

/**
 * Parsea un archivo markdown con front matter YAML
 */
function parse_markdown_file(string $abs): ?array {
  $raw = @file_get_contents($abs);
  if ($raw === false) return null;
  
  $raw = trim($raw);
  
  // Detectar front matter: ---\n...\n---
  if (!preg_match('/^---\s*\n(.*?)\n---\s*\n(.*)$/s', $raw, $m)) {
    // Sin front matter
    return [
      'frontmatter' => [],
      'content' => $raw
    ];
  }
  
  $yamlRaw = $m[1];
  $content = trim($m[2]);
  
  // Parsear YAML simple
  $fm = [];
  $lines = explode("\n", $yamlRaw);
  foreach ($lines as $line) {
    $line = trim($line);
    if ($line === '' || $line[0] === '#') continue;
    
    if (preg_match('/^(\w+):\s*"(.*)"\s*$/', $line, $lm)) {
      $fm[$lm[1]] = $lm[2];
      continue;
    }
    
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
      
      $fm[$key] = trim($val, '"\'');
    }
  }
  
  return [
    'frontmatter' => $fm,
    'content' => $content
  ];
}

/**
 * Convierte Markdown básico a HTML
 * Soporta: # headers, **bold**, *italic*, links, listas, párrafos
 */
function markdown_to_html(string $md): string {
  $html = '';
  $lines = explode("\n", $md);
  $inList = false;
  $inParagraph = false;
  
  foreach ($lines as $line) {
    $trimmed = trim($line);
    
    // Línea vacía
    if ($trimmed === '') {
      if ($inList) {
        $html .= "</ul>\n";
        $inList = false;
      }
      if ($inParagraph) {
        $html .= "</p>\n";
        $inParagraph = false;
      }
      continue;
    }
    
    // Headers
    if (preg_match('/^(#{1,6})\s+(.+)$/', $trimmed, $m)) {
      if ($inList) { $html .= "</ul>\n"; $inList = false; }
      if ($inParagraph) { $html .= "</p>\n"; $inParagraph = false; }
      
      $level = strlen($m[1]);
      $text = inline_markdown($m[2]);
      $html .= "<h{$level}>{$text}</h{$level}>\n";
      continue;
    }
    
    // Listas no ordenadas
    if (preg_match('/^[-*]\s+(.+)$/', $trimmed, $m)) {
      if ($inParagraph) { $html .= "</p>\n"; $inParagraph = false; }
      if (!$inList) {
        $html .= "<ul>\n";
        $inList = true;
      }
      $text = inline_markdown($m[1]);
      $html .= "<li>{$text}</li>\n";
      continue;
    }
    
    // Párrafo normal
    if ($inList) {
      $html .= "</ul>\n";
      $inList = false;
    }
    if (!$inParagraph) {
      $html .= "<p>";
      $inParagraph = true;
    } else {
      $html .= " ";
    }
    $html .= inline_markdown($trimmed);
  }
  
  // Cerrar tags abiertos
  if ($inList) $html .= "</ul>\n";
  if ($inParagraph) $html .= "</p>\n";
  
  return $html;
}

/**
 * Procesa markdown inline: **bold**, *italic*, [link](url)
 */
function inline_markdown(string $text): string {
  // Links: [text](url)
  $text = preg_replace_callback(
    '/\[([^\]]+)\]\(([^\)]+)\)/',
    function($m) {
      $linkText = h($m[1]);
      $url = h($m[2]);
      return "<a href=\"{$url}\">{$linkText}</a>";
    },
    $text
  );
  
  // Bold: **text**
  $text = preg_replace('/\*\*([^\*]+)\*\*/', '<strong>$1</strong>', $text);
  
  // Italic: *text*
  $text = preg_replace('/\*([^\*]+)\*/', '<em>$1</em>', $text);
  
  return $text;
}

// Base del proyecto
$BASE_DIR = __DIR__;

// Header categorías
$cats = [];
$catsFile = __DIR__ . '/db/categorias.json';
if (file_exists($catsFile)) {
  $cats = json_decode(file_get_contents($catsFile), true);
  if (!is_array($cats)) $cats = [];
}

// Obtener archivo
$file = isset($_GET['f']) ? trim((string)$_GET['f']) : '';
if ($file === '') {
  die("Error: No se especificó archivo (parámetro 'f')");
}

// Validación de seguridad: el archivo debe estar en /posts
$filePath = $BASE_DIR . '/' . ltrim($file, '/');
$filePath = realpath($filePath);
$postsDir = realpath($BASE_DIR . '/posts');

if (!$filePath || !$postsDir || !str_starts_with($filePath, $postsDir)) {
  die("Error: Archivo no permitido");
}

if (!file_exists($filePath)) {
  die("Error: Archivo no encontrado: " . h($file));
}

// Parsear markdown
$parsed = parse_markdown_file($filePath);
if (!$parsed) {
  die("Error: No se pudo leer el archivo");
}

$fm = $parsed['frontmatter'];
$content = $parsed['content'];

$title = (string)($fm['title'] ?? 'Post sin título');
$date = (string)($fm['date'] ?? '');
$excerpt = (string)($fm['excerpt'] ?? '');
$categories = $fm['categories'] ?? [];
$tags = $fm['tags'] ?? [];

if (!is_array($categories)) $categories = [];
if (!is_array($tags)) $tags = [];

// Convertir markdown a HTML
$contentHtml = markdown_to_html($content);

?>
<!doctype html>
<html lang="es">
  <head>
    <title><?= h($title) ?> | JOCARSA Blog</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= h($excerpt) ?>">
    <meta name="robots" content="index,follow">
    
    <style>
      @font-face {font-family: Ubuntu;src: url(estilo/Ubuntu-R.ttf);}
      @font-face {font-family: UbuntuB;src: url(estilo/Ubuntu-B.ttf);}

      html,body{
        padding:0;margin:0;
        font-family:Ubuntu,sans-serif;
        background:#fff;
        color:#333;
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

      .social img{
        width: 16px;
        margin-left: 6px;
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.4));
      }
      .social a:hover img { transform: translateY(-1px); }
      .social{display:flex;}

      .post-header{
        max-width:900px;
        margin:40px auto 20px;
        padding:0 20px;
      }
      .post-header h1{
        font-family:UbuntuB,Ubuntu,sans-serif;
        font-size:42px;
        line-height:1.1;
        margin:0 0 20px;
        color:#111;
      }
      .post-meta{
        display:flex;
        gap:12px;
        flex-wrap:wrap;
        font-size:13px;
        color:#666;
        margin-bottom:20px;
      }
      .post-meta .date{
        font-weight:bold;
        color:indigo;
      }
      .chip{
        background:#f0f0f0;
        border:1px solid #ddd;
        padding:4px 10px;
        border-radius:999px;
        font-size:12px;
        color:#555;
        text-decoration:none;
      }
      .chip:hover{
        background:#e8e8e8;
      }
      
      .post-excerpt{
        font-size:18px;
        line-height:1.5;
        color:#555;
        font-style:italic;
        margin-bottom:30px;
        padding-bottom:30px;
        border-bottom:1px solid #eee;
      }

      .post-content{
        max-width:900px;
        margin:0 auto 60px;
        padding:0 20px;
        font-size:16px;
        line-height:1.7;
        color:#333;
      }

      .post-content h1{
        font-family:UbuntuB,Ubuntu,sans-serif;
        font-size:36px;
        margin:40px 0 20px;
        color:#111;
      }
      .post-content h2{
        font-family:UbuntuB,Ubuntu,sans-serif;
        font-size:28px;
        margin:35px 0 18px;
        color:#222;
      }
      .post-content h3{
        font-family:UbuntuB,Ubuntu,sans-serif;
        font-size:22px;
        margin:30px 0 15px;
        color:#333;
      }
      .post-content h4{
        font-size:18px;
        font-weight:bold;
        margin:25px 0 12px;
        color:#444;
      }

      .post-content p{
        margin:0 0 20px;
      }

      .post-content ul{
        margin:20px 0;
        padding-left:30px;
      }
      .post-content li{
        margin:10px 0;
      }

      .post-content a{
        color:indigo;
        text-decoration:underline;
      }
      .post-content a:hover{
        text-decoration:none;
      }

      .post-content strong{
        font-weight:bold;
        color:#111;
      }

      .post-content em{
        font-style:italic;
      }

      .back-link{
        max-width:900px;
        margin:0 auto 40px;
        padding:0 20px;
      }
      .back-link a{
        display:inline-flex;
        align-items:center;
        gap:8px;
        text-decoration:none;
        color:indigo;
        font-size:14px;
        padding:8px 16px;
        border:1px solid indigo;
        border-radius:999px;
        transition:all 0.2s;
      }
      .back-link a:hover{
        background:indigo;
        color:white;
      }

      footer{
        display:flex;justify-content:center;gap:20px;
        padding:20px;font-size:11px;flex-wrap:wrap;
        border-top:1px solid #eee;
      }
      footer article{display:flex;flex-direction:column;gap:10px;}
      footer article a{text-decoration:none;color:indigo;}

      @media (max-width:600px){
        .post-header h1{font-size:32px;}
        .post-content h1{font-size:28px;}
        .post-content h2{font-size:24px;}
        .post-content h3{font-size:20px;}
      }
    </style>
  </head>
  <body>

    <header>
      <a href="index.php"><img src="https://static.jocarsa.com/logos/jocarsa%20%7C%20Indigo.svg" alt="jocarsa"><h1>jocarsa</h1></a>

      <a href="blog.php">Blog</a>

      <?php for($i=0;$i<count($cats);$i++){ ?>
        <a href="index.php?cat=<?= h($cats[$i]) ?>"><?= h($cats[$i]) ?></a>
      <?php } ?>

      <a href="pagina.php?p=sobrenosotros">Sobre nosotros</a>
      <a href="contacto.php">Contacto</a>

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

    <div class="back-link">
      <a href="blog.php">← Volver al blog</a>
    </div>

    <article class="post-header">
      <h1><?= h($title) ?></h1>
      
      <div class="post-meta">
        <?php if($date !== ''){ ?>
          <span class="date"><?= h($date) ?></span>
        <?php } ?>
        
        <?php foreach($categories as $cat){ 
          if($cat === '') continue;
        ?>
          <a class="chip" href="blog.php?cat=<?= h(rawurlencode($cat)) ?>"><?= h($cat) ?></a>
        <?php } ?>
        
        <?php foreach($tags as $tag){ 
          if($tag === '') continue;
        ?>
          <span class="chip"><?= h($tag) ?></span>
        <?php } ?>
      </div>

      <?php if($excerpt !== ''){ ?>
        <div class="post-excerpt">
          <?= h($excerpt) ?>
        </div>
      <?php } ?>
    </article>

    <div class="post-content">
      <?= $contentHtml ?>
    </div>

    <div class="back-link">
      <a href="blog.php">← Volver al blog</a>
    </div>

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
<?php include 'logger.php'; ?>
