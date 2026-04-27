<?php
// ============================
// SITEMAP GENERATOR (sitemap.xml)
// ============================

// Ajusta tu dominio canónico aquí:
$SITE_BASE = "https://jocarsa.com";

// Dónde guardar el sitemap (en el mismo directorio que index.php)
$sitemapPath = __DIR__ . "/sitemap.xml";

// Recoge URLs (relativas) y genera XML
function build_sitemap_xml(string $siteBase, array $urls): string {
	$siteBase = rtrim($siteBase, "/");
	$now = date("c"); // ISO 8601

	// Deduplicar y limpiar
	$clean = [];
	foreach ($urls as $u) {
		$u = trim((string)$u);
		if ($u === "") continue;

		// Normaliza: si viene absoluta al mismo dominio, pásala a ruta
		if (preg_match('~^https?://~i', $u)) {
			// deja tal cual si es absoluta (pero intentaremos normalizar)
			$clean[] = $u;
		} else {
			// fuerza prefijo /
			if ($u[0] !== "/") $u = "/" . $u;
			$clean[] = $siteBase . $u;
		}
	}
	$clean = array_values(array_unique($clean));

	$xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
	$xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

	foreach ($clean as $abs) {
		// Escape mínimo XML
		$loc = htmlspecialchars($abs, ENT_QUOTES | ENT_XML1, "UTF-8");
		$xml .= "  <url>\n";
		$xml .= "    <loc>{$loc}</loc>\n";
		$xml .= "    <lastmod>{$now}</lastmod>\n";
		$xml .= "  </url>\n";
	}

	$xml .= "</urlset>\n";
	return $xml;
}

function write_if_changed(string $path, string $content): void {
	$prev = @file_get_contents($path);
	if ($prev === $content) return; // no reescribir si no cambia
	@file_put_contents($path, $content, LOCK_EX);
}

// ---- 1) URLs base
$urls = [];
$urls[] = "/"; // home

// ---- 2) Links del header: categorías + "Sobre nosotros" + "Contacto"
// (mismo comportamiento que tu header actual)
if (is_array($cats)) {
	for ($i = 0; $i < count($cats); $i++) {
		// Tu header genera <a href="?"> para categorías ahora mismo.
		// Eso NO es ideal para sitemap. Mejor usa un parámetro explícito:
		// Ej: /?cat=Nombre
		$cat = (string)$cats[$i];
		if ($cat !== "") {
			$urls[] = "/?cat=" . rawurlencode($cat);
		}
	}
}

// Enlaces fijos de header (los que ya tienes)
$urls[] = "/pagina.php?p=sobrenosotros";
$urls[] = "/contacto.php";

// ---- 3) Productos: producto.php?p=<slug>
if (is_array($products)) {
	for ($i = 0; $i < count($products); $i++) {
		$nombre = (string)($products[$i]["nombre"] ?? "");
		$slug = (string)($products[$i]["slug"] ?? $nombre);
		$slug = trim($slug);
		if ($slug !== "") {
			$urls[] = "/producto.php?p=" . rawurlencode($slug);
		}
	}
}

// ---- 4) (Opcional) Enlaces del footer si quieres incluirlos también
//     Si NO los quieres, borra este bloque.
$footerFile = __DIR__ . "/db/piedepagina.json";
if (file_exists($footerFile)) {
	$footer = json_decode(file_get_contents($footerFile), true);
	if (is_array($footer)) {
		$catsFooter = $footer["categorias"] ?? [];
		if (is_array($catsFooter)) {
			foreach ($catsFooter as $c) {
				$c = (string)$c;
				if ($c !== "") $urls[] = "/?cat=" . rawurlencode($c);
			}
		}
		$linksFooter = $footer["enlaces"] ?? [];
		if (is_array($linksFooter)) {
			foreach ($linksFooter as $l) {
				$enlace = (string)($l["enlace"] ?? "");
				if ($enlace === "") continue;

				// Si es relativo, lo metemos; si es absoluto, también.
				$urls[] = $enlace;
			}
		}
	}
}

// ---- Generar y guardar
$xml = build_sitemap_xml($SITE_BASE, $urls);
write_if_changed($sitemapPath, $xml);
?>

