<!doctype html>
<html lang="es">
  <head>
    <title>JOCARSA | Software de gestión y soluciones digitales para empresas</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <meta name="description" content="Desarrollamos software de gestión y soluciones digitales con inteligencia artificial para empresas. Automatiza procesos, mejora la productividad y haz crecer tu negocio con Jocarsa.">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Jocarsa | Software de gestión y soluciones digitales con inteligencia artificial">
    <meta property="og:description" content="Desarrollamos software de gestión y soluciones digitales con inteligencia artificial para empresas. Automatiza procesos, mejora la productividad y haz crecer tu negocio con Jocarsa.">
    <meta property="og:url" content="https://jocarsa.com/">
    <meta property="og:site_name" content="Jocarsa">
    <meta property="og:image" content="https://jocarsa.com/img/og-jocarsa.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="es_ES">


    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Jocarsa | Software de gestión con inteligencia artificial">
    <meta name="twitter:description" content="Soluciones de software de gestión con inteligencia artificial para automatizar procesos y mejorar la productividad empresarial.">
    <meta name="twitter:image" content="https://jocarsa.com/img/og-jocarsa.jpg">
    <meta name="twitter:site" content="@jocarsa">
    <meta name="twitter:creator" content="@jocarsa">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="https://jocarsa.com/">

   <script type="application/ld+json">
{
  "@context":"https://schema.org",
  "@type":"Organization",
  "name":"Jocarsa",
  "url":"https://jocarsa.com/",
  "logo":"https://jocarsa.com/img/og-jocarsa.jpg",
  "sameAs":[
    "https://github.com/jocarsa"
  ]
}
</script>

<script type="application/ld+json">
{
  "@context":"https://schema.org",
  "@type":"WebSite",
  "url":"https://jocarsa.com/",
  "name":"JOCARSA | Software de gestión y soluciones digitales para empresas"
}
</script>

    <style>
      @font-face {font-family: Ubuntu;src: url(estilo/Ubuntu-R.ttf);}
      @font-face {font-family: UbuntuB;src: url(estilo/Ubuntu-B.ttf);}

      /* ESTILOS GENERALES /////////////////////////////////////// */
      html,body{
        padding:0px;
        margin:0px;
        font-family:Ubuntu,sans-serif;
        width:100%;
        height:100%;
        background:#fff;
      }

      /* ESTILOS CABECERA  /////////////////////////////////////// */
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
      }
      header img{width:30px;}
      header a{text-decoration:none;color:indigo;font-size:11px;
      display:flex;gap:5px;}
      header a h1{font-size:14px;}

      /* ESTILOS PRODUCTOS  /////////////////////////////////////// */
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
        height:400px;
        display:flex;
        justify-content:center;
        align-items:center;
        flex-direction:column;
        gap:10px;
        position:relative;
        overflow:hidden;
     
        border:1px solid rgba(0,0,0,0.08);
        box-shadow:0px 10px 30px rgba(0,0,0,0.06);

        /* fondo por defecto si no hay imagen */
        background:lightgrey;
        background-size:cover;
        background-position:center;
      }

      /* overlay para legibilidad */
      main article::before{
        content:"";
        position:absolute; inset:0;
        /*background:linear-gradient(180deg, rgba(0,0,0,0.50), rgba(0,0,0,0.15));*/
        z-index:0;
      }

      main article h3, main article h4, main article a{
        position:relative;
        z-index:1;
        padding:0px;
        margin:0px;
        text-align:center;
        color:white;
       
      }
      main article h3{font-family:UbuntuB,Ubuntu,sans-serif;font-size:48px;}
      main article h4{font-size:24px;font-weight:bold;max-width:800px;padding:0 16px;box-sizing:border-box;}
      main article p{
        width:50%;
        text-align:center;
        color:white;
        font-size:11px;
      }
      main article a{
        background:indigo;
        text-decoration:none;
        color:white;
        padding:10px 20px;
        border-radius:50px;
        font-size:12px;
        border:1px solid rgba(255,255,255,0.25);
      }

      /* LOS 3 PRIMEROS OCUPAN TODA LA FILA ////////////////////// */
      main article:nth-child(-n+3){
        grid-column:1 / -1;
      }

      /* ARTÍCULOS 4+ EN DOS COLUMNAS /////////////////////////// */
      @media (min-width:600px){
        main{
          grid-template-columns:1fr 1fr;
        }
        main article:nth-child(-n+3){
          grid-column:1 / -1;
        }
      }

      footer{display:flex;justify-content:center;gap:20px;padding:20px;font-size:11px;}
      footer article{display:flex;flex-direction:column;gap:10px;}
      footer article a{text-decoration:none;color:indigo;}
      .social img{
            width: 16px;
            margin-left: 6px;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.4));
            
        }

        .social a:hover img { transform: translateY(-1px); }
        .social{display:flex;}
        article *{
          text-shadow:0px 0px 25px white;
        }
    </style>
  </head>
  <body>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

function h($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
function norm($p){ return str_replace('\\','/',$p); }

function list_product_images(string $productDirAbs): array {
  $imgDir = rtrim($productDirAbs,'/') . '/img';
  if (!is_dir($imgDir)) return [];

  $exts = ['jpg','jpeg','png','webp','gif'];
  $files = [];

  foreach ($exts as $e) {
    foreach (glob($imgDir . '/*.' . $e) ?: [] as $f) {
      if (is_file($f)) $files[] = $f;
    }
    foreach (glob($imgDir . '/*.' . strtoupper($e)) ?: [] as $f) {
      if (is_file($f)) $files[] = $f;
    }
  }

  // quitar duplicados
  $files = array_values(array_unique($files));
  return $files;
}

function abs_to_web(string $abs, string $baseDirAbs): string {
  $abs = norm($abs);
  $baseDirAbs = rtrim(norm($baseDirAbs), '/');
  if (str_starts_with($abs, $baseDirAbs)) {
    return ltrim(substr($abs, strlen($baseDirAbs)), '/');
  }
  return $abs;
}

// Base del proyecto (carpeta donde está este index.php)
$BASE_DIR = __DIR__;

// Cargar header categorías
$cats = [];
$catsFile = __DIR__ . '/db/categorias.json';
if (file_exists($catsFile)) {
  $cats = json_decode(file_get_contents($catsFile), true);
  if (!is_array($cats)) $cats = [];
}

// Cargar productos de db/productos.json (como ya lo tienes)
$products = [];
$prodFile = __DIR__ . '/db/productos.json';
if (file_exists($prodFile)) {
  $products = json_decode(file_get_contents($prodFile), true);
  if (!is_array($products)) $products = [];
}
?>

    <header>
      <a href="?"><img src="https://static.jocarsa.com/logos/jocarsa%20%7C%20Indigo.svg" alt="jocarsa"><h1>jocarsa</h1></a>
      <a href="blog.php" style="font-weight:bold;">Blog</a>
      <?php for($i = 0; $i < count($cats); $i++){ ?>
        <a href="?"><?= h($cats[$i]) ?></a>
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

    <main>
      <?php
        for($i = 0; $i < count($products); $i++){
          $nombre = (string)($products[$i]['nombre'] ?? '');
          $slogan = (string)($products[$i]['slogan'] ?? '');
          $descripcion = (string)($products[$i]['descripcion'] ?? '');
          // slug “carpeta”: a partir del nombre (mismo criterio simple que usabas)
          // Si tu db/productos.json ya tiene 'slug', úsalo aquí directamente.
          $slug = $products[$i]['slug'] ?? $nombre;
          $slug = trim((string)$slug);

          // Carpeta del producto: productos/<slug>/
          $productDirAbs = $BASE_DIR . '/productos/' . $slug;

          // Elegir una imagen aleatoria de productos/<slug>/img/
          $imgsAbs = list_product_images($productDirAbs);
          $bgStyle = "";
          if (count($imgsAbs) > 0) {
            $pick = $imgsAbs[array_rand($imgsAbs)];
            $pickWeb = abs_to_web($pick, $BASE_DIR);
            // cache-bust suave para que si regeneras imágenes se refresque
            $pickWeb .= (str_contains($pickWeb, '?') ? '&' : '?') . 'v=' . @filemtime($pick);
            $bgStyle = "background-image:url('img/negrotrans.png'),url('".h($pickWeb)."');";
          }

          // Enlace: por consistencia con producto.php actualizado, mejor pasar slug
          // (si tu producto.php busca por slug de carpeta)
          $href = "producto.php?p=" . rawurlencode($slug);
      ?>
        <article style="<?= h($bgStyle) ?>">
          <h3><?= h($nombre) ?></h3>
          <h4><?= h($slogan) ?></h4>
          <p><?= h($descripcion) ?></p>
          <a href="<?= h($href) ?>">Saber más</a>
        </article>
      <?php } ?>
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
          <a href="?cat=<?= h($catsFooter[$i]) ?>"><?= h($catsFooter[$i]) ?></a>
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
