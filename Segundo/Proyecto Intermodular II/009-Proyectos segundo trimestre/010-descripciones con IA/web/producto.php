<?php
// producto.php — JSON + diseño Appleweb-like (tu estilo) + SEO dinámico
// Soporta JSON e imágenes dentro de subcarpetas como:
//   /web/productos/jocarsa-rosybrown/jocarsa-rosybrown.json
//   /web/productos/jocarsa-rosybrown/img/*.jpg
//
// Uso recomendado:
//   producto.php?p=jocarsa-rosybrown
// o producto.php?file=productos/jocarsa-rosybrown/jocarsa-rosybrown.json

error_reporting(E_ALL);
ini_set('display_errors', 1);

function h($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

// -------------------------------
// Helpers SEO (URL absolutas)
// -------------------------------
function is_https_request(): bool {
  if (!empty($_SERVER['HTTPS']) && strtolower((string)$_SERVER['HTTPS']) !== 'off') return true;
  if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower((string)$_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https') return true;
  return false;
}

function site_origin(): string {
  $scheme = is_https_request() ? 'https' : 'http';
  $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
  // sanitizar host mínimamente
  $host = preg_replace('/[^a-zA-Z0-9\.\-\:\[\]]/', '', (string)$host);
  return $scheme . '://' . $host;
}

function base_path_dir(): string {
  // path del script sin el nombre del archivo
  $uri = $_SERVER['REQUEST_URI'] ?? '/producto.php';
  $path = parse_url($uri, PHP_URL_PATH);
  if (!is_string($path) || $path === '') $path = '/producto.php';
  $dir = rtrim(str_replace('\\','/', dirname($path)), '/');
  return $dir === '' ? '' : $dir;
}

function abs_url(string $relOrAbs): string {
  $relOrAbs = trim($relOrAbs);
  if ($relOrAbs === '') return '';
  if (preg_match('#^https?://#i', $relOrAbs)) return $relOrAbs;
  $origin = site_origin();
  $base = base_path_dir(); // ej: "" o "/web"
  $rel = '/' . ltrim($relOrAbs, '/');
  return $origin . $base . $rel;
}

function current_request_path(): string {
  $uri = $_SERVER['REQUEST_URI'] ?? '/producto.php';
  $path = parse_url($uri, PHP_URL_PATH);
  return is_string($path) && $path !== '' ? $path : '/producto.php';
}

function build_canonical_url(string $p, string $fileParam): string {
  // canonical preferido: si hay p => ?p=...
  // si no, si hay file => ?file=... (URL encode)
  $path = current_request_path();
  $origin = site_origin();
  $base = base_path_dir();
  $fullPath = $origin . $base . $path;

  if ($p !== '') {
    return $fullPath . '?p=' . rawurlencode($p);
  }
  if ($fileParam !== '') {
    return $fullPath . '?file=' . rawurlencode($fileParam);
  }
  // fallback
  return $fullPath;
}

function seo_truncate(string $s, int $max = 160): string {
  $s = trim(preg_replace('/\s+/', ' ', $s));
  if ($s === '') return '';
  if (mb_strlen($s, 'UTF-8') <= $max) return $s;
  $cut = mb_substr($s, 0, $max, 'UTF-8');
  // evitar cortar palabra a medias
  $cut = preg_replace('/\s+\S*$/u', '', $cut);
  return rtrim($cut, " \t\n\r\0\x0B.,;:") . '…';
}

// -------------------------------
// Helpers de seguridad y rutas
// -------------------------------
function is_safe_rel_path(string $p): bool {
  // Permite rutas relativas simples dentro del proyecto (sin ../)
  if ($p === "") return false;
  if (str_contains($p, "\0")) return false;
  if (str_contains($p, '..')) return false;
  return (bool)preg_match('/^[a-zA-Z0-9_\-\/\.]+$/', $p);
}

function normalize_slash(string $p): string {
  return str_replace('\\', '/', $p);
}

function realpath_safe(string $path): ?string {
  $rp = realpath($path);
  return $rp !== false ? $rp : null;
}

/**
 * Busca un JSON por slug ($p) dentro de /productos (incluyendo subcarpetas).
 * Prioridad:
 *   1) productos/<p>/<p>.json
 *   2) productos/<p>.json
 *   3) primer match recursivo productos<p>.json
 */
function find_product_json_by_slug(string $slug, string $baseDir): ?string {
  $slug = trim($slug);
  if ($slug === "") return null;

  $candidates = [
    $baseDir . "/productos/" . $slug . "/" . $slug . ".json",
    $baseDir . "/productos/" . $slug . ".json",
  ];

  foreach ($candidates as $c) {
    $rp = realpath_safe($c);
    if ($rp && file_exists($rp)) return $rp;
  }

  // Recursivo
  $root = $baseDir . "/productos";
  if (!is_dir($root)) return null;

  $it = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS)
  );

  foreach ($it as $fileInfo) {
    /** @var SplFileInfo $fileInfo */
    if (!$fileInfo->isFile()) continue;
    if (strtolower($fileInfo->getExtension()) !== 'json') continue;

    if (strtolower($fileInfo->getBasename('.json')) === strtolower($slug)) {
      return $fileInfo->getRealPath();
    }
  }

  return null;
}

/**
 * Convierte una ruta absoluta del servidor a una ruta web relativa
 * a este directorio (__DIR__).
 */
function abs_to_web_path(string $abs, string $baseDir): string {
  $abs = normalize_slash($abs);
  $baseDir = normalize_slash($baseDir);
  if (str_starts_with($abs, $baseDir)) {
    $rel = ltrim(substr($abs, strlen($baseDir)), '/');
    return $rel; // ej: "productos/jocarsa-rosybrown/img/a.jpg"
  }
  return $abs; // fallback (no debería pasar)
}

// -------------------------------
// 1) Cargar JSON de producto
// -------------------------------
$BASE_DIR = __DIR__;

$p = (string)($_GET['p'] ?? '');
$fileParam = (string)($_GET['file'] ?? '');

$jsonFileAbs = null;

// Si viene ?file=..., lo usamos (restringido a dentro de __DIR__)
if ($fileParam !== '' && is_safe_rel_path($fileParam)) {
  $candidate = $BASE_DIR . '/' . ltrim($fileParam, '/');
  $rp = realpath_safe($candidate);
  if ($rp && str_starts_with(normalize_slash($rp), normalize_slash($BASE_DIR)) && file_exists($rp)) {
    $jsonFileAbs = $rp;
  }
}

// Si no hay file válido, buscamos por slug
if ($jsonFileAbs === null) {
  $jsonFileAbs = find_product_json_by_slug($p, $BASE_DIR);
}

if ($jsonFileAbs === null || !file_exists($jsonFileAbs)) {
  http_response_code(404);
  die("JSON no encontrado para p=".h($p)." / file=".h($fileParam));
}

$raw = file_get_contents($jsonFileAbs);
if ($raw === false) {
  http_response_code(500);
  die("Error leyendo JSON: ".h($jsonFileAbs));
}

$data = json_decode($raw, true);
if (!is_array($data)) {
  http_response_code(500);
  die("JSON inválido: ".h(json_last_error_msg()));
}

// Acepta tanto el JSON con raíz "productPage" como el objeto directo
$page = $data['productPage'] ?? $data;
if (!is_array($page)) {
  http_response_code(500);
  die("Estructura JSON inválida: falta 'productPage' u objeto raíz equivalente.");
}

// Directorio del JSON (absoluto) y su path web relativo
$jsonDirAbs = dirname($jsonFileAbs);
$jsonDirWeb = abs_to_web_path($jsonDirAbs, $BASE_DIR); // ej: "productos/jocarsa-rosybrown"
$jsonDirWeb = rtrim($jsonDirWeb, '/');

// -------------------------------
// Helpers JSON
// -------------------------------
function arr_get($a, $path, $default = null) {
  if (!is_array($a)) return $default;
  $parts = explode('.', (string)$path);
  $cur = $a;
  foreach ($parts as $p) {
    if (!is_array($cur) || !array_key_exists($p, $cur)) return $default;
    $cur = $cur[$p];
  }
  return $cur;
}

function list_strings($v): array {
  $out = [];
  if (is_array($v)) {
    foreach ($v as $x) {
      if (is_string($x) || is_numeric($x)) $out[] = trim((string)$x);
    }
  } elseif (is_string($v) || is_numeric($v)) {
    $out[] = trim((string)$v);
  }
  return array_values(array_filter($out, fn($s)=>$s!==""));
}

function read_image_from_section($section): array {
  $src = "";
  $alt = "";
  if (is_array($section)) {
    $img = $section['media']['image'] ?? null;
    if (is_array($img)) {
      $src = (string)($img['@src'] ?? '');
      $alt = (string)($img['@alt'] ?? '');
    }
  }
  return ['src'=>$src, 'alt'=>$alt];
}

/**
 * Normaliza src de imagen:
 * - Si es http(s): devuelve tal cual
 * - Si es relativo: lo hace relativo al directorio del JSON (productos/<slug>/...)
 */
function safe_img_src(string $src, string $baseWebDir): string {
  $src = trim($src);
  if ($src === "") return "";
  if (str_contains($src, '..')) return "";

  if (preg_match('#^https?://#i', $src)) return $src;

  // Solo caracteres "seguros" en ruta web
  if (!preg_match('/^[a-zA-Z0-9_\-\/\.\%\=\?\&]+$/', $src)) return "";

  $src = ltrim($src, '/');

  // Si ya viene prefijado con productos/... lo respetamos
  if (str_starts_with($src, 'productos/')) return $src;

  // Prefijar con la carpeta del JSON (p.ej. productos/jocarsa-rosybrown/)
  $baseWebDir = trim($baseWebDir, '/');
  if ($baseWebDir === '') return $src;

  return $baseWebDir . '/' . $src;
}

// Render helper (imagen en cabecera de article)
function render_article_image(array $img, string $baseWebDir){
  $src = safe_img_src((string)($img['src'] ?? ''), $baseWebDir);
  if ($src === "") return;
  $alt = trim((string)($img['alt'] ?? ''));
  ?>
  <div class="articleMedia">
    <img src="<?= h($src) ?>" alt="<?= h($alt) ?>" loading="lazy">
  </div>
  <?php
}

// -------------------------------
// Datos
// -------------------------------
$metaTitle = (string)(arr_get($page, 'meta.title', arr_get($page, 'hero.name', 'Producto')));

$heroSection = arr_get($page, 'hero', []);
$heroImg   = read_image_from_section($heroSection);
$heroName  = (string)(arr_get($page, 'hero.name', ''));
$heroValue = (string)(arr_get($page, 'hero.valueProposition', ''));
$heroSub   = (string)(arr_get($page, 'hero.subtitle', ''));

$heroActions = [];
$actions = arr_get($page, 'hero.actions.action', []);
if (is_array($actions)) {
  foreach ($actions as $a) {
    if (is_array($a)) {
      $heroActions[] = [
        'type' => (string)($a['@type'] ?? ''),
        'text' => trim((string)($a['#text'] ?? '')),
      ];
    } elseif (is_string($a) || is_numeric($a)) {
      $heroActions[] = ['type'=>'', 'text'=>trim((string)$a)];
    }
  }
}

$badges = list_strings(arr_get($page, 'hero.badges.badge', []));

// Secciones + imagen
$problemSection = arr_get($page, 'problem', []);
$problemImg   = read_image_from_section($problemSection);
$problemTitle = (string)(arr_get($page, 'problem.title', 'Problemas'));
$problemItems = list_strings(arr_get($page, 'problem.items.item', []));

$solutionSection = arr_get($page, 'solution', []);
$solutionImg      = read_image_from_section($solutionSection);
$solutionTitle    = (string)(arr_get($page, 'solution.title', 'La solución'));
$solutionOverview = (string)(arr_get($page, 'solution.overview', ''));
$solutionChanges  = list_strings(arr_get($page, 'solution.whatChanges.change', []));

$featuresSection = arr_get($page, 'keyFeatures', []);
$featuresImg   = read_image_from_section($featuresSection);
$featuresTitle = (string)(arr_get($page, 'keyFeatures.title', 'Funcionalidades'));
$features = [];
$featArr = arr_get($page, 'keyFeatures.feature', []);
if (is_array($featArr)) {
  foreach ($featArr as $f) {
    if (!is_array($f)) continue;
    $features[] = ['name'=>(string)($f['name'] ?? ''), 'benefit'=>(string)($f['benefit'] ?? '')];
  }
}

$audSection = arr_get($page, 'targetAudience', []);
$audImg   = read_image_from_section($audSection);
$audTitle = (string)(arr_get($page, 'targetAudience.title', '¿Para quién es?'));
$profiles = [];
$profArr = arr_get($page, 'targetAudience.profiles.profile', []);
if (is_array($profArr)) {
  foreach ($profArr as $p2) {
    if (!is_array($p2)) continue;
    $profiles[] = ['name'=>(string)($p2['name'] ?? ''), 'fit'=>(string)($p2['fit'] ?? '')];
  }
}

$useSection = arr_get($page, 'useCases', []);
$useImg   = read_image_from_section($useSection);
$useTitle = (string)(arr_get($page, 'useCases.title', 'Casos de uso'));
$useCases = [];
$casesArr = arr_get($page, 'useCases.case', []);
if (is_array($casesArr)) {
  foreach ($casesArr as $c) {
    if (!is_array($c)) continue;
    $useCases[] = ['name'=>(string)($c['name'] ?? ''), 'description'=>(string)($c['description'] ?? '')];
  }
}

$benefitsSection = arr_get($page, 'benefits', []);
$benefitsImg   = read_image_from_section($benefitsSection);
$benefitsTitle = (string)(arr_get($page, 'benefits.title', 'Beneficios'));
$benefitItems  = list_strings(arr_get($page, 'benefits.items.item', []));

$integrationsSection = arr_get($page, 'integrations', null);
$integrationsImg   = is_array($integrationsSection) ? read_image_from_section($integrationsSection) : ['src'=>'','alt'=>''];
$integrationsTitle = (string)(arr_get($page, 'integrations.title', ''));
$integrationsNotes = (string)(arr_get($page, 'integrations.notes', ''));
$integrationsItems = list_strings(arr_get($page, 'integrations.items.item', []));

$trustSection = arr_get($page, 'trust', []);
$trustImg    = read_image_from_section($trustSection);
$trustTitle  = (string)(arr_get($page, 'trust.title', 'Confianza'));
$trustPoints = list_strings(arr_get($page, 'trust.points.point', []));

$ctaSection = arr_get($page, 'finalCTA', []);
$ctaImg   = read_image_from_section($ctaSection);
$ctaTitle = (string)(arr_get($page, 'finalCTA.title', '¿Hablamos?'));
$ctaDesc  = (string)(arr_get($page, 'finalCTA.description', ''));

$ctaActions = [];
$ctaActArr = arr_get($page, 'finalCTA.actions.action', []);
if (is_array($ctaActArr)) {
  foreach ($ctaActArr as $a) {
    if (is_array($a)) {
      $ctaActions[] = ['type'=>(string)($a['@type'] ?? ''), 'text'=>trim((string)($a['#text'] ?? ''))];
    } elseif (is_string($a) || is_numeric($a)) {
      $ctaActions[] = ['type'=>'', 'text'=>trim((string)$a)];
    }
  }
}

$contactEmail = (string)(arr_get($page, 'finalCTA.contact.email', ''));
$formFields = [];
$fieldsArr = arr_get($page, 'finalCTA.contact.form.field', []);
if (is_array($fieldsArr)) {
  foreach ($fieldsArr as $f) {
    if (!is_array($f)) continue;
    $formFields[] = [
      'name' => (string)($f['@name'] ?? ''),
      'type' => (string)($f['@type'] ?? 'text'),
      'required' => ((string)($f['@required'] ?? 'false')) === 'true',
    ];
  }
}

$faqSection = arr_get($page, 'faq', []);
$faqImg   = read_image_from_section($faqSection);
$faqTitle = (string)(arr_get($page, 'faq.title', 'Preguntas frecuentes'));
$faqs = [];
$qaArr = arr_get($page, 'faq.qa', []);
if (is_array($qaArr)) {
  foreach ($qaArr as $qa) {
    if (!is_array($qa)) continue;
    $faqs[] = ['q'=>(string)($qa['q'] ?? ''), 'a'=>(string)($qa['a'] ?? '')];
  }
}

$footerSummary = (string)(arr_get($page, 'footer.summary', ''));

// Header/footer JSON como tu web
$cats = [];
$catsFile = __DIR__ . "/db/categorias.json";
if (file_exists($catsFile)) {
  $cats = json_decode(file_get_contents($catsFile), true);
  if (!is_array($cats)) $cats = [];
}
$footerJson = [];
$footerFile = __DIR__ . "/db/piedepagina.json";
if (file_exists($footerFile)) {
  $footerJson = json_decode(file_get_contents($footerFile), true);
  if (!is_array($footerJson)) $footerJson = [];
}

// -------------------------------
// SEO dinámico (HEAD)
// -------------------------------
$canonical = build_canonical_url($p, $fileParam);

$heroSrcRel = safe_img_src((string)($heroImg['src'] ?? ''), $jsonDirWeb);
$ogImageAbs = $heroSrcRel !== '' ? abs_url($heroSrcRel) : '';

$seoName = trim($heroName) !== '' ? $heroName : $metaTitle;

// meta description: si existe en JSON úsala; si no, compón
$metaDescJson = (string)arr_get($page, 'meta.description', '');
$descParts = [];
if (trim($metaDescJson) !== '') {
  $descParts[] = $metaDescJson;
} else {
  if (trim($heroValue) !== '') $descParts[] = $heroValue;
  if (trim($heroSub) !== '') $descParts[] = $heroSub;
  if (count($benefitItems)) $descParts[] = 'Beneficios: ' . implode(', ', array_slice($benefitItems, 0, 3)) . '.';
}
$metaDescription = seo_truncate(implode(' ', $descParts), 160);

// títulos OG/Twitter
$ogTitle = $seoName . ' · jocarsa';
$ogDesc  = $metaDescription;

// JSON-LD: SoftwareApplication
$softwareJsonLd = [
  '@context' => 'https://schema.org',
  '@type'    => 'SoftwareApplication',
  'name'     => $seoName,
  'applicationCategory' => 'BusinessApplication',
  'operatingSystem' => 'Web',
  'url'      => $canonical,
  'description' => seo_truncate($metaDescription, 300),
  'image'    => $ogImageAbs !== '' ? $ogImageAbs : null,
  'brand'    => ['@type'=>'Brand','name'=>'Jocarsa'],
  'publisher'=> ['@type'=>'Organization','name'=>'Jocarsa','url'=>abs_url('/')]
];
$softwareJsonLd = array_filter($softwareJsonLd, fn($v)=>$v!==null && $v!=='');

// JSON-LD: FAQPage (solo si hay FAQs válidas)
$faqEntities = [];
foreach ($faqs as $qa) {
  $q = trim((string)($qa['q'] ?? ''));
  $a = trim((string)($qa['a'] ?? ''));
  if ($q === '' || $a === '') continue;
  $faqEntities[] = [
    '@type' => 'Question',
    'name'  => $q,
    'acceptedAnswer' => [
      '@type' => 'Answer',
      'text'  => $a
    ]
  ];
}

$faqJsonLd = null;
if (count($faqEntities)) {
  $faqJsonLd = [
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => $faqEntities
  ];
}

// JSON-LD: BreadcrumbList simple
$breadcrumbsJsonLd = [
  '@context' => 'https://schema.org',
  '@type' => 'BreadcrumbList',
  'itemListElement' => [
    [
      '@type' => 'ListItem',
      'position' => 1,
      'name' => 'Inicio',
      'item' => abs_url('/index.php')
    ],
    [
      '@type' => 'ListItem',
      'position' => 2,
      'name' => $seoName,
      'item' => $canonical
    ]
  ]
];

?>
<!doctype html>
<html lang="es">
  <head>
    <title><?= h($metaTitle) ?> · jocarsa</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <meta name="description" content="<?= h($metaDescription) ?>">
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="<?= h($canonical) ?>">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= h($ogTitle) ?>">
    <meta property="og:description" content="<?= h($ogDesc) ?>">
    <meta property="og:url" content="<?= h($canonical) ?>">
    <?php if ($ogImageAbs !== '') { ?>
      <meta property="og:image" content="<?= h($ogImageAbs) ?>">
    <?php } ?>
    <meta property="og:site_name" content="Jocarsa">
    <meta property="og:locale" content="es_ES">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= h($ogTitle) ?>">
    <meta name="twitter:description" content="<?= h($ogDesc) ?>">
    <?php if ($ogImageAbs !== '') { ?>
      <meta name="twitter:image" content="<?= h($ogImageAbs) ?>">
    <?php } ?>

    <!-- JSON-LD: Software -->
    <script type="application/ld+json"><?= json_encode($softwareJsonLd, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) ?></script>
    <!-- JSON-LD: Breadcrumbs -->
    <script type="application/ld+json"><?= json_encode($breadcrumbsJsonLd, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) ?></script>
    <?php if ($faqJsonLd) { ?>
      <!-- JSON-LD: FAQ -->
      <script type="application/ld+json"><?= json_encode($faqJsonLd, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) ?></script>
    <?php } ?>

    <style>
      @font-face {font-family: Ubuntu;src: url(estilo/Ubuntu-R.ttf);}
      @font-face {font-family: UbuntuB;src: url(estilo/Ubuntu-B.ttf);}

      html,body{padding:0;margin:0;font-family:Ubuntu,sans-serif;width:100%;height:100%;background:#fff;color:#111;}

      header{
        width:100%;
        display:flex;
        justify-content:center;
        align-items:center;
        box-shadow:0px 2px 4px rgba(0,0,0,0.3);
        gap:20px;
        padding:10px;
        position:sticky;top:0;
        background:rgba(255,255,255,0.95);
        backdrop-filter:saturate(180%) blur(12px);
        z-index:10;
      }
      header img{width:30px;}
      header a{text-decoration:none;color:indigo;font-size:11px;}

      .wrap{width:min(1100px, calc(100% - 24px)); margin:0 auto;}

      .hero{padding:60px 0 30px 0;text-align:center;}
      .hero h1{font-family:UbuntuB,Ubuntu,sans-serif;font-size:52px;margin:0;letter-spacing:-0.5px;}
      .hero .value{font-size:18px;color:#333;margin:14px 0 0 0;}
      .hero .sub{font-size:14px;color:#666;margin:10px 0 0 0;line-height:1.5;}

      .badges{margin-top:16px;display:flex;justify-content:center;gap:10px;flex-wrap:wrap;}
      .badge{font-size:11px;padding:6px 10px;border-radius:999px;background:rgba(75,0,130,0.08);color:indigo;border:1px solid rgba(75,0,130,0.15);}

      .actions{margin-top:22px;display:flex;justify-content:center;gap:10px;flex-wrap:wrap;}
      .btn{text-decoration:none;padding:10px 18px;border-radius:999px;font-size:12px;display:inline-flex;align-items:center;gap:8px;border:1px solid rgba(0,0,0,0.12);background:#fff;color:#111;}
      .btn.primary{background:indigo;border-color:indigo;color:#fff;}

      main{width:100%;display:grid;grid-template-columns:1fr;gap:10px;padding:10px 0 30px 0;}

      main article{
        width:100%;
        min-height:360px;
        display:flex;
        justify-content:flex-start;
        align-items:center;
        background:linear-gradient(180deg, #f2f2f7, #ffffff);
        flex-direction:column;
        gap:12px;
        border-radius:18px;
        border:1px solid rgba(0,0,0,0.08);
        box-shadow:0px 10px 30px rgba(0,0,0,0.06);
        padding:0px;
        box-sizing:border-box;
        overflow:hidden;
        position:relative;
      }

      .articleMedia{
        width:100%;
        height:170px;
        overflow:hidden;
        background:rgba(0,0,0,0.03);
        border-bottom:1px solid rgba(0,0,0,0.06);
      }
      .articleMedia img{
        width:100%;
        height:100%;
        object-fit:cover;
        display:block;
        transform:scale(1.02);
      }

      .articleBody{
        width:100%;
        padding:22px 24px 24px 24px;
        box-sizing:border-box;
        display:flex;
        flex-direction:column;
        align-items:center;
        gap:12px;
      }

      main article h3, main article h4{padding:0;margin:0;text-align:center;}
      main article h3{font-family:UbuntuB,Ubuntu,sans-serif;font-size:28px;letter-spacing:-0.3px;}
      main article h4{font-size:13px;color:#555;font-weight:normal;line-height:1.5;max-width:760px;}

      .content{width:min(900px, 100%);display:flex;flex-direction:column;gap:10px;}

      .list{
        width:min(900px, 100%);
        margin:0 auto;
        padding:0;
        list-style:none;
        display:flex;
        flex-direction:column;
        gap:8px;
      }
      .list li{
        background:rgba(255,255,255,0.7);
        border:1px solid rgba(0,0,0,0.06);
        border-radius:12px;
        padding:10px 12px;
        font-size:13px;
        line-height:1.45;
      }

      .twocol{width:min(900px, 100%);display:grid;grid-template-columns:1fr;gap:10px;}
      .card{
        background:rgba(255,255,255,0.7);
        border:1px solid rgba(0,0,0,0.06);
        border-radius:14px;
        padding:14px;
        display:flex;
        flex-direction:column;
        gap:6px;
        min-height:120px;
      }
      .card b{font-family:UbuntuB,Ubuntu,sans-serif;}
      .card p{margin:0;font-size:13px;color:#444;line-height:1.45;}

      main article:nth-child(-n+3){grid-column:1 / -1;}

      @media (min-width:600px){
        main{grid-template-columns:1fr 1fr;}
        main article:nth-child(-n+3){grid-column:1 / -1;}
        .twocol{grid-template-columns:1fr 1fr;}
        .articleMedia{height:190px;}
      }

      details{
        width:min(900px, 100%);
        background:rgba(255,255,255,0.7);
        border:1px solid rgba(0,0,0,0.06);
        border-radius:14px;
        padding:12px 14px;
      }
      summary{cursor:pointer;font-family:UbuntuB,Ubuntu,sans-serif;font-size:13px;color:#111;}
      details p{margin:10px 0 0 0;font-size:13px;color:#444;line-height:1.5;}

      .ctaBox{width:min(900px, 100%);display:flex;flex-direction:column;gap:10px;align-items:center;}
      .mini{font-size:12px;color:#666;text-align:center;line-height:1.45;}
      .email{font-size:12px;color:indigo;text-decoration:none;}

      form{width:min(650px, 100%);display:grid;grid-template-columns:1fr;gap:10px;margin-top:6px;}
      input, textarea, select{
        width:100%;
        padding:12px 12px;
        border-radius:12px;
        border:1px solid rgba(0,0,0,0.12);
        font-family:Ubuntu,sans-serif;
        font-size:13px;
        box-sizing:border-box;
        outline:none;
      }
      textarea{min-height:120px;resize:vertical;}
      .submit{
        background:indigo;border:1px solid indigo;color:white;
        padding:12px 16px;border-radius:999px;cursor:pointer;
        font-size:12px;justify-self:center;width:220px;
      }

      footer{
        display:flex;justify-content:center;gap:20px;
        padding:20px;font-size:11px;border-top:1px solid rgba(0,0,0,0.08);
      }
      footer article{display:flex;flex-direction:column;gap:10px;}
      footer article a{text-decoration:none;color:indigo;}
      .footerSummary{padding:0 0 30px 0;text-align:center;color:#666;font-size:11px;}
      .social img{
            width: 16px;
            margin-left: 6px;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.4));
            
        }

        .social a:hover img { transform: translateY(-1px); }
        .social{display:flex;}
    </style>
  </head>
  <body>

    <header>
      <a href="index.php"><img src="https://static.jocarsa.com/logos/jocarsa%20%7C%20Indigo.svg" alt="jocarsa"></a>
      <a href="blog.php" style="font-weight:bold;">Blog</a>
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

    <section class="hero">
      <div class="wrap">
        <?php
          $heroSrc = safe_img_src((string)($heroImg['src'] ?? ''), $jsonDirWeb);
          if ($heroSrc !== "") { ?>
            <div style="width:min(1100px, calc(100% - 24px));margin:0 auto 18px auto;border-radius:18px;overflow:hidden;border:1px solid rgba(0,0,0,0.08);box-shadow:0px 10px 30px rgba(0,0,0,0.06);">
              <img src="<?= h($heroSrc) ?>" alt="<?= h($heroImg['alt'] ?? '') ?>" style="width:100%;height:240px;object-fit:cover;display:block;">
            </div>
        <?php } ?>

        <h1><?= h($heroName ?: $metaTitle) ?></h1>
        <?php if($heroValue !== ""){ ?><p class="value"><?= h($heroValue) ?></p><?php } ?>
        <?php if($heroSub !== ""){ ?><p class="sub"><?= h($heroSub) ?></p><?php } ?>

        <?php if(count($badges)){ ?>
          <div class="badges">
            <?php foreach($badges as $b){ ?><span class="badge"><?= h($b) ?></span><?php } ?>
          </div>
        <?php } ?>

        <?php if(count($heroActions)){ ?>
          <div class="actions">
            <?php foreach($heroActions as $a){
              $cls = ($a['type']==='primary') ? 'btn primary' : 'btn';
              $anchor = '#contacto';
              if (stripos($a['text'], 'cómo') !== false || stripos($a['text'], 'funciona') !== false) $anchor = '#como';
              if (stripos($a['text'], 'contact') !== false) $anchor = '#contacto';
            ?>
              <a class="<?= h($cls) ?>" href="<?= h($anchor) ?>"><?= h($a['text']) ?></a>
            <?php } ?>
          </div>
        <?php } ?>
      </div>
    </section>

    <main class="wrap">

      <article id="problema">
        <?php render_article_image($problemImg, $jsonDirWeb); ?>
        <div class="articleBody">
          <h3><?= h($problemTitle) ?></h3>
          <h4>Lo que normalmente frena a un centro cuando quiere crecer sin perder control.</h4>
          <ul class="list">
            <?php foreach($problemItems as $it){ ?><li><?= h($it) ?></li><?php } ?>
          </ul>
        </div>
      </article>

      <article id="solucion">
        <?php render_article_image($solutionImg, $jsonDirWeb); ?>
        <div class="articleBody">
          <h3><?= h($solutionTitle) ?></h3>
          <div class="content">
            <?php if($solutionOverview !== ""){ ?><h4><?= h($solutionOverview) ?></h4><?php } ?>
            <?php if(count($solutionChanges)){ ?>
              <ul class="list">
                <?php foreach($solutionChanges as $ch){ ?><li><?= h($ch) ?></li><?php } ?>
              </ul>
            <?php } ?>
          </div>
        </div>
      </article>

      <article id="como">
        <?php render_article_image($featuresImg, $jsonDirWeb); ?>
        <div class="articleBody">
          <h3><?= h($featuresTitle) ?></h3>
          <h4>Lo esencial, explicado desde el beneficio.</h4>
          <div class="twocol">
            <?php foreach($features as $f){ ?>
              <div class="card">
                <b><?= h($f['name']) ?></b>
                <p><?= h($f['benefit']) ?></p>
              </div>
            <?php } ?>
          </div>
        </div>
      </article>

      <article>
        <?php render_article_image($audImg, $jsonDirWeb); ?>
        <div class="articleBody">
          <h3><?= h($audTitle) ?></h3>
          <h4>Si te reconoces aquí, esto está hecho para tu día a día.</h4>
          <div class="twocol">
            <?php foreach($profiles as $p2){ ?>
              <div class="card">
                <b><?= h($p2['name']) ?></b>
                <p><?= h($p2['fit']) ?></p>
              </div>
            <?php } ?>
          </div>
        </div>
      </article>

      <article>
        <?php render_article_image($useImg, $jsonDirWeb); ?>
        <div class="articleBody">
          <h3><?= h($useTitle) ?></h3>
          <h4>Situaciones reales donde se nota el cambio.</h4>
          <div class="twocol">
            <?php foreach($useCases as $c){ ?>
              <div class="card">
                <b><?= h($c['name']) ?></b>
                <p><?= h($c['description']) ?></p>
              </div>
            <?php } ?>
          </div>
        </div>
      </article>

      <article>
        <?php render_article_image($benefitsImg, $jsonDirWeb); ?>
        <div class="articleBody">
          <h3><?= h($benefitsTitle) ?></h3>
          <h4>Resultados prácticos para el centro y el equipo.</h4>
          <ul class="list">
            <?php foreach($benefitItems as $it){ ?><li><?= h($it) ?></li><?php } ?>
          </ul>
        </div>
      </article>

      <?php if($integrationsTitle !== "" || count($integrationsItems)){ ?>
      <article>
        <?php render_article_image($integrationsImg, $jsonDirWeb); ?>
        <div class="articleBody">
          <h3><?= h($integrationsTitle ?: "Integración y compatibilidad") ?></h3>
          <?php if($integrationsNotes !== ""){ ?><h4><?= h($integrationsNotes) ?></h4><?php } ?>
          <ul class="list">
            <?php foreach($integrationsItems as $it){ ?><li><?= h($it) ?></li><?php } ?>
          </ul>
        </div>
      </article>
      <?php } ?>

      <article>
        <?php render_article_image($trustImg, $jsonDirWeb); ?>
        <div class="articleBody">
          <h3><?= h($trustTitle) ?></h3>
          <h4>Para decidir con tranquilidad.</h4>
          <ul class="list">
            <?php foreach($trustPoints as $it){ ?><li><?= h($it) ?></li><?php } ?>
          </ul>
        </div>
      </article>

      <article id="contacto">
        <?php render_article_image($ctaImg, $jsonDirWeb); ?>
        <div class="articleBody">
          <h3><?= h($ctaTitle) ?></h3>
          <?php if($ctaDesc !== ""){ ?><h4><?= h($ctaDesc) ?></h4><?php } ?>

          <div class="ctaBox">
            <?php if(count($ctaActions)){ ?>
              <div class="actions">
                <?php foreach($ctaActions as $a){
                  $cls = ($a['type']==='primary') ? 'btn primary' : 'btn';
                ?>
                  <a class="<?= h($cls) ?>" href="#contacto"><?= h($a['text']) ?></a>
                <?php } ?>
              </div>
            <?php } ?>

            <?php if($contactEmail !== ""){ ?>
              <div class="mini">Contacto directo: <a class="email" href="mailto:<?= h($contactEmail) ?>"><?= h($contactEmail) ?></a></div>
            <?php } ?>

            <?php if(count($formFields)){ ?>
              <form method="post" action="enviar.php">
                <?php foreach($formFields as $f){
                  $name = $f['name'];
                  $type = $f['type'];
                  $req  = $f['required'] ? 'required' : '';
                  $ph = ucfirst(str_replace('_',' ', $name));

                  if ($type === 'textarea') { ?>
                    <textarea name="<?= h($name) ?>" placeholder="<?= h($ph) ?>" <?= $req ?>></textarea>
                  <?php } elseif ($type === 'checkbox') { ?>
                    <label style="width:100%;display:flex;gap:10px;align-items:center;background:rgba(255,255,255,0.7);border:1px solid rgba(0,0,0,0.12);border-radius:12px;padding:12px;">
                      <input type="checkbox" name="<?= h($name) ?>" value="1" <?= $req ?> style="width:auto;">
                      <span style="font-size:13px;color:#444;"><?= h($ph) ?></span>
                    </label>
                  <?php } else { ?>
                    <input type="<?= h($type === 'tel' ? 'tel' : ($type === 'email' ? 'email' : 'text')) ?>"
                           name="<?= h($name) ?>"
                           placeholder="<?= h($ph) ?>"
                           <?= $req ?>>
                  <?php } ?>
                <?php } ?>
                <button class="submit" type="submit">Enviar</button>
              </form>
              <div class="mini">Puedes conectar <b>enviar.php</b> a tu CRM o a un correo.</div>
            <?php } ?>
          </div>
        </div>
      </article>

      <article>
        <?php render_article_image($faqImg, $jsonDirWeb); ?>
        <div class="articleBody">
          <h3><?= h($faqTitle) ?></h3>
          <h4>Respuestas rápidas a dudas habituales.</h4>
          <?php foreach($faqs as $qa){ ?>
            <details>
              <summary><?= h($qa['q']) ?></summary>
              <p><?= h($qa['a']) ?></p>
            </details>
          <?php } ?>
        </div>
      </article>

    </main>

    <?php if($footerSummary !== ""){ ?>
      <div class="footerSummary wrap"><?= h($footerSummary) ?></div>
    <?php } ?>

    <footer>
      <?php
        $catsFooter = $footerJson['categorias'] ?? [];
        $linksFooter = $footerJson['enlaces'] ?? [];
      ?>
      <article class="categorias">
        <?php if(is_array($catsFooter)) for($i=0;$i<count($catsFooter);$i++){ ?>
          <a href="index.php?cat=<?= h($catsFooter[$i]) ?>"><?= h($catsFooter[$i]) ?></a>
        <?php } ?>
      </article>

      <article class="paginas">
        <?php if(is_array($linksFooter)) for($i=0;$i<count($linksFooter);$i++){ ?>
          <a href="<?= h($linksFooter[$i]['enlace'] ?? '#') ?>"><?= h($linksFooter[$i]['nombre'] ?? '') ?></a>
        <?php } ?>
      </article>
    </footer>

  </body>
</html>
<?php include 'logger.php'; ?>
