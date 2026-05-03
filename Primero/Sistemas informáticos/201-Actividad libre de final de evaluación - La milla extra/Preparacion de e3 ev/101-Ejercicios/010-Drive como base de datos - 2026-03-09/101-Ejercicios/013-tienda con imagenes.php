<?php

// --------------------------------------------------
// CONFIGURACIÓN SMTP DESDE VARIABLES DE ENTORNO
// --------------------------------------------------
define('SMTP_HOST', getenv('MI_SERVIDORSMTP_CORREO_JOCARSA'));
define('SMTP_PORT', 587);
define('SMTP_USER', getenv('MI_CORREO_JOCARSA'));
define('SMTP_PASS', getenv('MI_CONTRASENA_CORREO_JOCARSA'));
define('SMTP_FROM_EMAIL', getenv('MI_CORREO_JOCARSA'));
define('SMTP_FROM_NAME', 'Tienda deportiva');
define('SMTP_TO_EMAIL', "jocarsa2@gmail.com");
define('SMTP_SECURE', 'tls');


// --------------------------------------------------
// FUNCIÓN SMTP POR SOCKETS
// --------------------------------------------------
function smtp_read($socket) {
    $data = '';
    while ($str = fgets($socket, 515)) {
        $data .= $str;
        if (preg_match('/^\d{3}\s/', $str)) {
            break;
        }
    }
    return $data;
}

function smtp_expect($response, $codes) {
    foreach ((array)$codes as $code) {
        if (strpos($response, (string)$code) === 0) {
            return true;
        }
    }
    return false;
}

function smtp_cmd($socket, $command, $expectCodes) {
    fwrite($socket, $command . "\r\n");
    $response = smtp_read($socket);
    if (!smtp_expect($response, $expectCodes)) {
        throw new Exception("Error SMTP en comando [$command]: $response");
    }
    return $response;
}

function smtp_send_mail($toEmail, $toName, $subject, $htmlBody, $textBody = '') {
    $host = SMTP_HOST;
    $port = SMTP_PORT;
    $user = SMTP_USER;
    $pass = SMTP_PASS;
    $fromEmail = SMTP_FROM_EMAIL;
    $fromName = SMTP_FROM_NAME;
    $secure = SMTP_SECURE;

    $socket = fsockopen($host, $port, $errno, $errstr, 20);
    if (!$socket) {
        throw new Exception("No se pudo conectar al servidor SMTP: $errstr ($errno)");
    }

    stream_set_timeout($socket, 20);

    $response = smtp_read($socket);
    if (!smtp_expect($response, 220)) {
        fclose($socket);
        throw new Exception("Respuesta inicial SMTP no válida: $response");
    }

    smtp_cmd($socket, "EHLO localhost", 250);

    if ($secure === 'tls') {
        smtp_cmd($socket, "STARTTLS", 220);

        if (!stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT)) {
            fclose($socket);
            throw new Exception("No se pudo activar TLS.");
        }

        smtp_cmd($socket, "EHLO localhost", 250);
    }

    smtp_cmd($socket, "AUTH LOGIN", 334);
    smtp_cmd($socket, base64_encode($user), 334);
    smtp_cmd($socket, base64_encode($pass), 235);

    smtp_cmd($socket, "MAIL FROM:<$fromEmail>", 250);
    smtp_cmd($socket, "RCPT TO:<$toEmail>", [250, 251]);
    smtp_cmd($socket, "DATA", 354);

    $boundary = 'b1_' . md5(uniqid((string)mt_rand(), true));

    $encodedSubject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
    $encodedFromName = '=?UTF-8?B?' . base64_encode($fromName) . '?=';
    $encodedToName = '=?UTF-8?B?' . base64_encode($toName) . '?=';

    if ($textBody === '') {
        $textBody = strip_tags(str_replace(['<br>', '<br/>', '<br />'], "\n", $htmlBody));
    }

    $headers = [];
    $headers[] = "From: $encodedFromName <$fromEmail>";
    $headers[] = "To: $encodedToName <$toEmail>";
    $headers[] = "Subject: $encodedSubject";
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-Type: multipart/alternative; boundary=\"$boundary\"";
    $headers[] = "Date: " . date('r');
    $headers[] = "Message-ID: <" . uniqid() . "@localhost>";

    $message  = implode("\r\n", $headers) . "\r\n\r\n";
    $message .= "--$boundary\r\n";
    $message .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $message .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
    $message .= $textBody . "\r\n\r\n";
    $message .= "--$boundary\r\n";
    $message .= "Content-Type: text/html; charset=UTF-8\r\n";
    $message .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
    $message .= $htmlBody . "\r\n\r\n";
    $message .= "--$boundary--\r\n.\r\n";

    fwrite($socket, $message);
    $response = smtp_read($socket);
    if (!smtp_expect($response, 250)) {
        fclose($socket);
        throw new Exception("Error al enviar el cuerpo del mensaje: $response");
    }

    smtp_cmd($socket, "QUIT", 221);
    fclose($socket);

    return true;
}


// --------------------------------------------------
// FUNCIONES PARA GOOGLE DRIVE
// --------------------------------------------------
function extraerFolderId($url) {
    if (preg_match('/\/folders\/([a-zA-Z0-9_-]+)/', $url, $m)) {
        return $m[1];
    }
    return trim($url);
}

function descargar($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    $respuesta = curl_exec($ch);
    $error = curl_error($ch);
    $http = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    if ($respuesta === false) {
        return [false, $error];
    }

    if ($http < 200 || $http >= 300) {
        return [false, "HTTP $http"];
    }

    return [$respuesta, null];
}

function cargarImagenesDrive($folderUrl) {
    $folderId = extraerFolderId($folderUrl);

    if (!$folderId) {
        return [[], "No se pudo extraer el ID de la carpeta."];
    }

    $embeddedUrl = "https://drive.google.com/embeddedfolderview?id=" . $folderId . "#grid";
    $proxyUrl = "https://r.jina.ai/http://" . ltrim($embeddedUrl, '/');
    $proxyUrl = str_replace("http://https://", "https://", $proxyUrl);

    list($contenido, $fallo) = descargar($proxyUrl);

    if ($contenido === false) {
        return [[], "No se pudo leer la carpeta: " . $fallo];
    }

    $imagenes = [];

    preg_match_all(
        '/\[(.*?)\]\(https:\/\/drive\.google\.com\/file\/d\/([a-zA-Z0-9_-]+)\/view/',
        $contenido,
        $matches,
        PREG_SET_ORDER
    );

    if (empty($matches)) {
        return [[], "No se encontraron imágenes en la respuesta."];
    }

    foreach ($matches as $match) {
        $textoEnlace = trim($match[1]);
        $id = trim($match[2]);

        $nombreArchivo = $textoEnlace;

        if (preg_match('/([^\]]+\.(png|jpg|jpeg|webp))/i', $textoEnlace, $mNombre)) {
            $nombreArchivo = trim($mNombre[1]);
        }

        $imagenes[] = [
            "id" => $id,
            "filename" => $nombreArchivo,
            "thumb" => "https://drive.google.com/thumbnail?id=$id&sz=w1200",
            "view" => "https://drive.google.com/file/d/$id/view"
        ];
    }

    return [$imagenes, ""];
}

function normalizarNombreArchivo($texto) {
    $texto = trim($texto);
    $texto = preg_replace('/\s+/', ' ', $texto);
    return mb_strtolower($texto, 'UTF-8');
}


// --------------------------------------------------
// PROCESAR PEDIDO AJAX
// --------------------------------------------------
if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_SERVER['CONTENT_TYPE']) &&
    str_contains($_SERVER['CONTENT_TYPE'], 'application/json')
) {
    header('Content-Type: application/json; charset=utf-8');

    try {
        $raw = file_get_contents("php://input");
        $pedido = json_decode($raw, true);

        if (!$pedido) {
            throw new Exception("No se ha recibido un pedido válido.");
        }

        $cliente = $pedido['cliente'] ?? [];
        $productos = $pedido['productos'] ?? [];
        $total = (float)($pedido['total'] ?? 0);
        $fecha = $pedido['fecha'] ?? date('c');

        if (empty($cliente['nombre']) || empty($cliente['email']) || empty($cliente['telefono']) || empty($cliente['direccion'])) {
            throw new Exception("Faltan datos del cliente.");
        }

        if (empty($productos)) {
            throw new Exception("El pedido no contiene productos.");
        }

        $filasHtml = '';
        $filasTexto = '';

        foreach ($productos as $producto) {
            $nombre = htmlspecialchars($producto['nombre'] ?? '');
            $descripcion = htmlspecialchars($producto['descripcion'] ?? '');
            $precio = (float)($producto['precio'] ?? 0);
            $cantidad = (int)($producto['cantidad'] ?? 0);
            $subtotal = $precio * $cantidad;

            $filasHtml .= "
                <tr>
                    <td style='padding:8px;border:1px solid #ddd;'>$nombre</td>
                    <td style='padding:8px;border:1px solid #ddd;'>$descripcion</td>
                    <td style='padding:8px;border:1px solid #ddd;text-align:right;'>" . number_format($precio, 2, ',', '.') . " €</td>
                    <td style='padding:8px;border:1px solid #ddd;text-align:center;'>$cantidad</td>
                    <td style='padding:8px;border:1px solid #ddd;text-align:right;'>" . number_format($subtotal, 2, ',', '.') . " €</td>
                </tr>
            ";

            $filasTexto .= "- $nombre | $descripcion | " . number_format($precio, 2, ',', '.') . " € | Cantidad: $cantidad | Subtotal: " . number_format($subtotal, 2, ',', '.') . " €\n";
        }

        $html = "
            <html>
            <body style='font-family:Arial,Helvetica,sans-serif;color:#1f2933;'>
                <h2>Nuevo pedido recibido</h2>

                <h3>Datos del cliente</h3>
                <p><strong>Nombre:</strong> " . htmlspecialchars($cliente['nombre']) . "</p>
                <p><strong>Email:</strong> " . htmlspecialchars($cliente['email']) . "</p>
                <p><strong>Teléfono:</strong> " . htmlspecialchars($cliente['telefono']) . "</p>
                <p><strong>Dirección:</strong><br>" . nl2br(htmlspecialchars($cliente['direccion'])) . "</p>
                <p><strong>Fecha:</strong> " . htmlspecialchars($fecha) . "</p>

                <h3>Productos</h3>
                <table cellspacing='0' cellpadding='0' style='border-collapse:collapse;width:100%;'>
                    <thead>
                        <tr>
                            <th style='padding:8px;border:1px solid #ddd;background:#f5f7fa;text-align:left;'>Nombre</th>
                            <th style='padding:8px;border:1px solid #ddd;background:#f5f7fa;text-align:left;'>Descripción</th>
                            <th style='padding:8px;border:1px solid #ddd;background:#f5f7fa;text-align:right;'>Precio</th>
                            <th style='padding:8px;border:1px solid #ddd;background:#f5f7fa;text-align:center;'>Cantidad</th>
                            <th style='padding:8px;border:1px solid #ddd;background:#f5f7fa;text-align:right;'>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        $filasHtml
                    </tbody>
                </table>

                <p style='margin-top:20px;font-size:18px;'><strong>Total:</strong> " . number_format($total, 2, ',', '.') . " €</p>
            </body>
            </html>
        ";

        $texto = "Nuevo pedido recibido\n\n";
        $texto .= "DATOS DEL CLIENTE\n";
        $texto .= "Nombre: " . $cliente['nombre'] . "\n";
        $texto .= "Email: " . $cliente['email'] . "\n";
        $texto .= "Teléfono: " . $cliente['telefono'] . "\n";
        $texto .= "Dirección: " . $cliente['direccion'] . "\n";
        $texto .= "Fecha: " . $fecha . "\n\n";
        $texto .= "PRODUCTOS\n";
        $texto .= $filasTexto . "\n";
        $texto .= "TOTAL: " . number_format($total, 2, ',', '.') . " €\n";

        smtp_send_mail(
            SMTP_TO_EMAIL,
            'Administrador',
            'Nuevo pedido de la tienda deportiva',
            $html,
            $texto
        );

        echo json_encode([
            'ok' => true,
            'mensaje' => 'Compra registrada y enviada por correo correctamente.'
        ]);
        exit;

    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode([
            'ok' => false,
            'mensaje' => $e->getMessage()
        ]);
        exit;
    }
}


// --------------------------------------------------
// CARGA DEL CSV
// --------------------------------------------------
$url = "https://docs.google.com/spreadsheets/d/e/2PACX-1vSnPzzPFyDT1mMvKU9XWdUZdI68tw65egXqAAABRsESkZ5nu7pZUorkf-NLq9y-Yx3A6XVUF0hcw-fW/pub?output=csv";

$datos = [];

if (($handle = fopen($url, "r")) !== false) {
    $cabeceras = fgetcsv($handle, 1000, ",");

    while (($fila = fgetcsv($handle, 1000, ",")) !== false) {
        if (count($cabeceras) === count($fila)) {
            $datos[] = array_combine($cabeceras, $fila);
        }
    }

    fclose($handle);
}


// --------------------------------------------------
// CARGA Y EMPAREJADO DE IMÁGENES
// --------------------------------------------------
$folderUrl = "https://drive.google.com/drive/folders/1EoZM-6uTUx5s3Y-qiec8o-ddmbwwhmSX?usp=sharing";
list($imagenesDrive, $errorImagenesDrive) = cargarImagenesDrive($folderUrl);

$imagenesPorNombre = [];

foreach ($imagenesDrive as $imagen) {
    $clave = normalizarNombreArchivo($imagen['filename']);
    $imagenesPorNombre[$clave] = $imagen;
}

foreach ($datos as $i => $articulo) {
    $nombreEsperado = trim($articulo['nombre']) . ".png";
    $claveBusqueda = normalizarNombreArchivo($nombreEsperado);

    if (isset($imagenesPorNombre[$claveBusqueda])) {
        $datos[$i]['imagen'] = $imagenesPorNombre[$claveBusqueda]['thumb'];
        $datos[$i]['imagen_view'] = $imagenesPorNombre[$claveBusqueda]['view'];
    } else {
        $datos[$i]['imagen'] = '';
        $datos[$i]['imagen_view'] = '';
    }
}
?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tienda de artículos deportivos</title>
	<style>
		*{
			margin:0;
			padding:0;
			box-sizing:border-box;
		}

		:root{
			--fondo:#f5f7fa;
			--superficie:#ffffff;
			--borde:#d9e1e8;
			--texto:#1f2933;
			--texto-secundario:#52606d;
			--primario:#2d6cdf;
			--primario-hover:#1f5ac7;
			--exito:#1f9d55;
			--peligro:#d64545;
			--sombra:0 8px 24px rgba(15, 23, 42, 0.08);
			--radio:12px;
			--ancho:1200px;
		}

		body{
			font-family:Arial, Helvetica, sans-serif;
			background:var(--fondo);
			color:var(--texto);
			line-height:1.5;
		}

		header{
			background:var(--superficie);
			border-bottom:1px solid var(--borde);
			box-shadow:0 2px 10px rgba(0,0,0,0.03);
			position:sticky;
			top:0;
			z-index:20;
		}

		.header-contenido{
			max-width:var(--ancho);
			margin:auto;
			padding:20px;
			display:flex;
			align-items:center;
			justify-content:space-between;
			gap:20px;
		}

		header h1{
			font-size:32px;
			font-weight:700;
			color:var(--texto);
		}

		.boton-carrito{
			border:none;
			background:var(--primario);
			color:white;
			padding:12px 18px;
			border-radius:10px;
			cursor:pointer;
			font-size:15px;
			font-weight:700;
			transition:background 0.2s ease;
		}

		.boton-carrito:hover{
			background:var(--primario-hover);
		}

		.aviso-imagenes{
			max-width:var(--ancho);
			margin:20px auto 0 auto;
			padding:0 20px;
		}

		.aviso-imagenes div{
			background:#fff7e6;
			border:1px solid #f5d08a;
			color:#8a5a00;
			padding:14px 16px;
			border-radius:10px;
		}

		main{
			max-width:var(--ancho);
			margin:40px auto;
			padding:0 20px;
			display:grid;
			grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
			gap:24px;
		}

		article{
			background:var(--superficie);
			border:1px solid var(--borde);
			border-radius:var(--radio);
			overflow:hidden;
			box-shadow:var(--sombra);
			transition:transform 0.2s ease, box-shadow 0.2s ease;
			display:flex;
			flex-direction:column;
		}

		article:hover{
			transform:translateY(-4px);
			box-shadow:0 12px 30px rgba(15, 23, 42, 0.12);
		}

		.producto-imagen{
			width:100%;
			height:220px;
			background:#eef2f6;
			display:block;
			object-fit:cover;
			border-bottom:1px solid var(--borde);
		}

		.producto-imagen-placeholder{
			width:100%;
			height:220px;
			background:linear-gradient(135deg, #eef2f6, #dde6ef);
			border-bottom:1px solid var(--borde);
			display:flex;
			align-items:center;
			justify-content:center;
			color:var(--texto-secundario);
			font-size:14px;
			text-align:center;
			padding:20px;
		}

		.producto-cuerpo{
			padding:24px;
			display:flex;
			flex-direction:column;
			flex:1;
		}

		article h3{
			font-size:22px;
			margin-bottom:12px;
			color:var(--texto);
		}

		article p{
			font-size:15px;
			color:var(--texto-secundario);
			margin-bottom:10px;
		}

		.precio{
			margin-top:auto;
			font-size:26px;
			font-weight:700;
			color:var(--primario);
			margin-bottom:18px;
		}

		.boton-anadir{
			border:none;
			background:var(--texto);
			color:white;
			padding:12px 16px;
			border-radius:10px;
			cursor:pointer;
			font-size:15px;
			font-weight:700;
			transition:background 0.2s ease;
		}

		.boton-anadir:hover{
			background:#101820;
		}

		aside#panelCarrito{
			position:fixed;
			top:0;
			right:-420px;
			width:420px;
			max-width:100%;
			height:100vh;
			background:var(--superficie);
			box-shadow:-10px 0 30px rgba(0,0,0,0.12);
			border-left:1px solid var(--borde);
			transition:right 0.3s ease;
			z-index:50;
			display:flex;
			flex-direction:column;
		}

		aside#panelCarrito.abierto{
			right:0;
		}

		.carrito-cabecera{
			padding:22px 20px;
			border-bottom:1px solid var(--borde);
			display:flex;
			align-items:center;
			justify-content:space-between;
			gap:10px;
		}

		.carrito-cabecera h2{
			font-size:24px;
		}

		.cerrar{
			border:none;
			background:transparent;
			font-size:28px;
			cursor:pointer;
			color:var(--texto-secundario);
		}

		.carrito-contenido{
			padding:20px;
			overflow:auto;
			flex:1;
		}

		.linea-carrito{
			border:1px solid var(--borde);
			border-radius:12px;
			padding:14px;
			margin-bottom:12px;
			background:#fafbfd;
		}

		.linea-carrito h4{
			font-size:17px;
			margin-bottom:6px;
		}

		.linea-carrito p{
			font-size:14px;
			color:var(--texto-secundario);
			margin-bottom:4px;
		}

		.controles-linea{
			display:flex;
			align-items:center;
			justify-content:space-between;
			gap:10px;
			margin-top:10px;
		}

		.cantidad{
			display:flex;
			align-items:center;
			gap:8px;
		}

		.cantidad button{
			width:32px;
			height:32px;
			border:none;
			border-radius:8px;
			background:#e9eef5;
			cursor:pointer;
			font-size:18px;
		}

		.borrar{
			border:none;
			background:var(--peligro);
			color:white;
			padding:8px 10px;
			border-radius:8px;
			cursor:pointer;
			font-size:13px;
		}

		.carrito-pie{
			border-top:1px solid var(--borde);
			padding:20px;
			background:#fbfcfe;
		}

		.total{
			display:flex;
			align-items:center;
			justify-content:space-between;
			font-size:20px;
			font-weight:700;
			margin-bottom:16px;
		}

		.acciones-carrito{
			display:flex;
			gap:10px;
		}

		.acciones-carrito button{
			flex:1;
			border:none;
			padding:12px 14px;
			border-radius:10px;
			cursor:pointer;
			font-weight:700;
			font-size:15px;
		}

		#vaciarCarrito{
			background:#e9eef5;
			color:var(--texto);
		}

		#comprar{
			background:var(--exito);
			color:white;
		}

		#overlay,
		#checkoutOverlay{
			position:fixed;
			inset:0;
			background:rgba(15, 23, 42, 0.45);
			opacity:0;
			pointer-events:none;
			transition:opacity 0.25s ease;
			z-index:40;
		}

		#overlay.visible,
		#checkoutOverlay.visible{
			opacity:1;
			pointer-events:auto;
		}

		#checkoutModal{
			position:fixed;
			top:50%;
			left:50%;
			transform:translate(-50%, -50%) scale(0.96);
			width:560px;
			max-width:calc(100% - 30px);
			background:var(--superficie);
			border-radius:16px;
			box-shadow:0 20px 50px rgba(0,0,0,0.2);
			z-index:60;
			opacity:0;
			pointer-events:none;
			transition:all 0.25s ease;
		}

		#checkoutModal.visible{
			opacity:1;
			pointer-events:auto;
			transform:translate(-50%, -50%) scale(1);
		}

		.modal-cabecera{
			padding:20px;
			border-bottom:1px solid var(--borde);
			display:flex;
			align-items:center;
			justify-content:space-between;
			gap:10px;
		}

		.modal-cuerpo{
			padding:20px;
		}

		form{
			display:grid;
			gap:14px;
		}

		label{
			font-weight:700;
			font-size:14px;
			display:block;
			margin-bottom:6px;
		}

		input, textarea{
			width:100%;
			padding:12px 14px;
			border:1px solid var(--borde);
			border-radius:10px;
			font-size:15px;
			outline:none;
			background:white;
		}

		textarea{
			min-height:90px;
			resize:vertical;
		}

		.resumen-pedido{
			background:#f8fafc;
			border:1px solid var(--borde);
			border-radius:12px;
			padding:14px;
			margin-bottom:8px;
		}

		.resumen-pedido h3{
			font-size:18px;
			margin-bottom:10px;
		}

		.resumen-pedido ul{
			padding-left:18px;
			color:var(--texto-secundario);
		}

		.resumen-pedido li{
			margin-bottom:4px;
		}

		.botones-formulario{
			display:flex;
			gap:10px;
			margin-top:8px;
		}

		.botones-formulario button{
			flex:1;
			border:none;
			padding:12px 14px;
			border-radius:10px;
			cursor:pointer;
			font-weight:700;
			font-size:15px;
		}

		.cancelar{
			background:#e9eef5;
			color:var(--texto);
		}

		.enviar{
			background:var(--primario);
			color:white;
		}

		.mensaje{
			margin-top:14px;
			padding:12px 14px;
			border-radius:10px;
			display:none;
		}

		.mensaje.ok{
			background:#edf7ed;
			color:#1b5e20;
		}

		.mensaje.error{
			background:#fdecec;
			color:#8a1f1f;
		}

		.vacio{
			color:var(--texto-secundario);
			text-align:center;
			padding:40px 10px;
		}

		footer{
			margin-top:40px;
			padding:30px 20px;
			text-align:center;
			color:var(--texto-secundario);
			font-size:14px;
			border-top:1px solid var(--borde);
			background:var(--superficie);
		}

		@media (max-width:768px){
			.header-contenido{
				padding:16px;
			}

			header h1{
				font-size:24px;
			}

			main{
				margin:24px auto;
				padding:0 16px;
				gap:16px;
			}

			.producto-cuerpo{
				padding:18px;
			}

			aside#panelCarrito{
				width:100%;
			}

			.botones-formulario,
			.acciones-carrito{
				flex-direction:column;
			}
		}
	</style>
</head>
<body>
	<header>
		<div class="header-contenido">
			<h1>Tienda de artículos deportivos</h1>
			<button class="boton-carrito" id="abrirCarrito">Carrito (<span id="contadorCarrito">0</span>)</button>
		</div>
	</header>

	<?php if (!empty($errorImagenesDrive)): ?>
	<div class="aviso-imagenes">
		<div><?php echo htmlspecialchars($errorImagenesDrive); ?></div>
	</div>
	<?php endif; ?>

	<main>
		<?php foreach($datos as $articulo): ?>
			<article>
				<?php if (!empty($articulo['imagen'])): ?>
					<a href="<?php echo htmlspecialchars($articulo['imagen_view']); ?>" target="_blank" rel="noopener">
						<img
							class="producto-imagen"
							src="<?php echo htmlspecialchars($articulo['imagen']); ?>"
							alt="<?php echo htmlspecialchars($articulo['nombre']); ?>"
							loading="lazy"
						>
					</a>
				<?php else: ?>
					<div class="producto-imagen-placeholder">Imagen no disponible</div>
				<?php endif; ?>

				<div class="producto-cuerpo">
					<h3><?php echo htmlspecialchars($articulo['nombre']); ?></h3>
					<p><?php echo htmlspecialchars($articulo['descripcion']); ?></p>
					<p class="precio"><?php echo number_format((float)$articulo['precio'], 2, ',', '.'); ?> €</p>
					<button
						class="boton-anadir"
						data-nombre="<?php echo htmlspecialchars($articulo['nombre'], ENT_QUOTES); ?>"
						data-descripcion="<?php echo htmlspecialchars($articulo['descripcion'], ENT_QUOTES); ?>"
						data-precio="<?php echo (float)$articulo['precio']; ?>"
					>
						Añadir al carrito
					</button>
				</div>
			</article>
		<?php endforeach; ?>
	</main>

	<aside id="panelCarrito">
		<div class="carrito-cabecera">
			<h2>Carrito</h2>
			<button class="cerrar" id="cerrarCarrito">&times;</button>
		</div>

		<div class="carrito-contenido" id="lineasCarrito"></div>

		<div class="carrito-pie">
			<div class="total">
				<span>Total</span>
				<span id="totalCarrito">0,00 €</span>
			</div>
			<div class="acciones-carrito">
				<button id="vaciarCarrito">Vaciar</button>
				<button id="comprar">Comprar</button>
			</div>
		</div>
	</aside>

	<div id="overlay"></div>

	<div id="checkoutOverlay"></div>
	<div id="checkoutModal">
		<div class="modal-cabecera">
			<h2>Datos del cliente</h2>
			<button class="cerrar" id="cerrarCheckout">&times;</button>
		</div>
		<div class="modal-cuerpo">
			<div class="resumen-pedido">
				<h3>Resumen del pedido</h3>
				<ul id="resumenPedido"></ul>
				<p style="margin-top:10px;font-weight:700;">Total: <span id="resumenTotal">0,00 €</span></p>
			</div>

			<form id="formularioCompra">
				<div>
					<label for="nombreCliente">Nombre completo</label>
					<input type="text" id="nombreCliente" name="nombreCliente" required>
				</div>

				<div>
					<label for="emailCliente">Correo electrónico</label>
					<input type="email" id="emailCliente" name="emailCliente" required>
				</div>

				<div>
					<label for="telefonoCliente">Teléfono</label>
					<input type="text" id="telefonoCliente" name="telefonoCliente" required>
				</div>

				<div>
					<label for="direccionCliente">Dirección</label>
					<textarea id="direccionCliente" name="direccionCliente" required></textarea>
				</div>

				<div class="botones-formulario">
					<button type="button" class="cancelar" id="cancelarCheckout">Cancelar</button>
					<button type="submit" class="enviar">Confirmar compra</button>
				</div>
			</form>

			<div class="mensaje" id="mensajeCompra"></div>
		</div>
	</div>

	<footer>
		(c) 2026 Jose Vicente Carratala
	</footer>

	<script>
		const carrito = [];
		const contadorCarrito = document.getElementById("contadorCarrito");
		const totalCarrito = document.getElementById("totalCarrito");
		const lineasCarrito = document.getElementById("lineasCarrito");
		const panelCarrito = document.getElementById("panelCarrito");
		const overlay = document.getElementById("overlay");

		const checkoutOverlay = document.getElementById("checkoutOverlay");
		const checkoutModal = document.getElementById("checkoutModal");
		const resumenPedido = document.getElementById("resumenPedido");
		const resumenTotal = document.getElementById("resumenTotal");
		const formularioCompra = document.getElementById("formularioCompra");
		const mensajeCompra = document.getElementById("mensajeCompra");

		function formatoEuros(valor){
			return valor.toLocaleString("es-ES", {
				minimumFractionDigits: 2,
				maximumFractionDigits: 2
			}) + " €";
		}

		function totalUnidades(){
			return carrito.reduce((acumulado, item) => acumulado + item.cantidad, 0);
		}

		function totalImporte(){
			return carrito.reduce((acumulado, item) => acumulado + (item.precio * item.cantidad), 0);
		}

		function abrirCarrito(){
			panelCarrito.classList.add("abierto");
			overlay.classList.add("visible");
		}

		function cerrarCarrito(){
			panelCarrito.classList.remove("abierto");
			overlay.classList.remove("visible");
		}

		function abrirCheckout(){
			if(carrito.length === 0){
				alert("El carrito está vacío.");
				return;
			}

			resumenPedido.innerHTML = "";
			carrito.forEach(item => {
				const li = document.createElement("li");
				li.textContent = item.nombre + " x " + item.cantidad + " = " + formatoEuros(item.precio * item.cantidad);
				resumenPedido.appendChild(li);
			});

			resumenTotal.textContent = formatoEuros(totalImporte());
			checkoutOverlay.classList.add("visible");
			checkoutModal.classList.add("visible");
		}

		function cerrarCheckout(){
			checkoutOverlay.classList.remove("visible");
			checkoutModal.classList.remove("visible");
		}

		function renderCarrito(){
			contadorCarrito.textContent = totalUnidades();
			totalCarrito.textContent = formatoEuros(totalImporte());

			if(carrito.length === 0){
				lineasCarrito.innerHTML = '<div class="vacio">Todavía no has añadido productos.</div>';
				return;
			}

			lineasCarrito.innerHTML = "";

			carrito.forEach((item, indice) => {
				const linea = document.createElement("div");
				linea.className = "linea-carrito";

				linea.innerHTML = `
					<h4>${item.nombre}</h4>
					<p>${item.descripcion}</p>
					<p><strong>${formatoEuros(item.precio)}</strong> por unidad</p>
					<div class="controles-linea">
						<div class="cantidad">
							<button type="button" data-accion="restar" data-indice="${indice}">-</button>
							<span>${item.cantidad}</span>
							<button type="button" data-accion="sumar" data-indice="${indice}">+</button>
						</div>
						<button type="button" class="borrar" data-accion="borrar" data-indice="${indice}">Eliminar</button>
					</div>
				`;

				lineasCarrito.appendChild(linea);
			});
		}

		function anadirProducto(nombre, descripcion, precio){
			const existente = carrito.find(item => item.nombre === nombre);

			if(existente){
				existente.cantidad++;
			}else{
				carrito.push({
					nombre,
					descripcion,
					precio: parseFloat(precio),
					cantidad: 1
				});
			}

			renderCarrito();
			abrirCarrito();
		}

		document.querySelectorAll(".boton-anadir").forEach(boton => {
			boton.addEventListener("click", function(){
				anadirProducto(
					this.dataset.nombre,
					this.dataset.descripcion,
					this.dataset.precio
				);
			});
		});

		document.getElementById("abrirCarrito").addEventListener("click", abrirCarrito);
		document.getElementById("cerrarCarrito").addEventListener("click", cerrarCarrito);
		overlay.addEventListener("click", cerrarCarrito);

		lineasCarrito.addEventListener("click", function(e){
			const accion = e.target.dataset.accion;
			const indice = parseInt(e.target.dataset.indice);

			if(isNaN(indice)) return;

			if(accion === "sumar"){
				carrito[indice].cantidad++;
			}

			if(accion === "restar"){
				carrito[indice].cantidad--;
				if(carrito[indice].cantidad <= 0){
					carrito.splice(indice, 1);
				}
			}

			if(accion === "borrar"){
				carrito.splice(indice, 1);
			}

			renderCarrito();
		});

		document.getElementById("vaciarCarrito").addEventListener("click", function(){
			carrito.length = 0;
			renderCarrito();
		});

		document.getElementById("comprar").addEventListener("click", abrirCheckout);
		document.getElementById("cerrarCheckout").addEventListener("click", cerrarCheckout);
		document.getElementById("cancelarCheckout").addEventListener("click", cerrarCheckout);
		checkoutOverlay.addEventListener("click", cerrarCheckout);

		formularioCompra.addEventListener("submit", async function(e){
			e.preventDefault();

			if(carrito.length === 0){
				mensajeCompra.className = "mensaje error";
				mensajeCompra.style.display = "block";
				mensajeCompra.textContent = "El carrito está vacío.";
				return;
			}

			const productosPedido = carrito.map(item => ({
				nombre: item.nombre,
				descripcion: item.descripcion,
				precio: item.precio,
				cantidad: item.cantidad
			}));

			const pedido = {
				cliente: {
					nombre: document.getElementById("nombreCliente").value,
					email: document.getElementById("emailCliente").value,
					telefono: document.getElementById("telefonoCliente").value,
					direccion: document.getElementById("direccionCliente").value
				},
				productos: productosPedido,
				total: totalImporte(),
				fecha: new Date().toISOString()
			};

			try{
				const respuesta = await fetch(window.location.href, {
					method: "POST",
					headers: {
						"Content-Type": "application/json"
					},
					body: JSON.stringify(pedido)
				});

				const resultado = await respuesta.json();

				if(resultado.ok){
					mensajeCompra.className = "mensaje ok";
					mensajeCompra.style.display = "block";
					mensajeCompra.textContent = resultado.mensaje;

					formularioCompra.reset();
					carrito.length = 0;
					renderCarrito();

					setTimeout(() => {
						cerrarCheckout();
						mensajeCompra.style.display = "none";
						mensajeCompra.textContent = "";
					}, 1800);
				}else{
					mensajeCompra.className = "mensaje error";
					mensajeCompra.style.display = "block";
					mensajeCompra.textContent = resultado.mensaje || "No se pudo procesar el pedido.";
				}
			}catch(error){
				mensajeCompra.className = "mensaje error";
				mensajeCompra.style.display = "block";
				mensajeCompra.textContent = "Error de comunicación con el servidor.";
			}
		});

		renderCarrito();
	</script>
</body>
</html>
