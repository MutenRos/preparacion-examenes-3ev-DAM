<?php
declare(strict_types=1);

/**
 * index.php (FULL FILE)
 * - Página completa (tu HTML) + sección de vídeo
 * - Procesa el formulario (POST)
 * - Envía email REAL por SMTP usando sockets (STARTTLS + AUTH LOGIN)
 *
 * Seguridad:
 * - NO incrusta la contraseña en el código.
 * - La lee de variables de entorno: SMTP_PASS (recomendado).
 *
 * Variables de entorno esperadas:
 *   SMTP_HOST=smtp.ionos.es
 *   SMTP_PORT=587
 *   SMTP_USER=info@jocarsa.com
 *   SMTP_PASS=TU_PASSWORD
 *
 * Envío:
 *   From: info@jocarsa.com
 *   To:   info@jocarsa.com
 *   Subject: CORREO DESDE LA WEB
 */

function h(string $s): string {
    return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function envv(string $k, string $default = ''): string {
    $v = getenv($k);
    return ($v === false || $v === null || $v === '') ? $default : (string)$v;
}

/** Lee respuesta SMTP (soporta multi-línea) */
function smtp_read($fp): string {
    $data = '';
    while (!feof($fp)) {
        $line = fgets($fp, 515);
        if ($line === false) break;
        $data .= $line;
        if (strlen($line) >= 4 && $line[3] === ' ') break; // fin multi-línea
    }
    return $data;
}

/** Envía comando SMTP y comprueba códigos */
function smtp_cmd($fp, string $cmd, array $expectCodes): string {
    fwrite($fp, $cmd . "\r\n");
    $resp = smtp_read($fp);
    $code = (int)substr($resp, 0, 3);
    if (!in_array($code, $expectCodes, true)) {
        throw new RuntimeException("SMTP error.\nCMD: {$cmd}\nRESP: {$resp}");
    }
    return $resp;
}

/** Construye mensaje RFC (headers + body) */
function build_message(string $from, string $to, string $subject, string $bodyText): string {
    $date  = date('r');
    $msgId = '<' . bin2hex(random_bytes(16)) . '@jocarsa.com>';
    $encodedSubject = '=?UTF-8?B?' . base64_encode($subject) . '?=';

    $headers = [
        "Date: {$date}",
        "Message-ID: {$msgId}",
        "From: <{$from}>",
        "To: <{$to}>",
        "Subject: {$encodedSubject}",
        "MIME-Version: 1.0",
        "Content-Type: text/plain; charset=UTF-8",
        "Content-Transfer-Encoding: 8bit",
    ];

    $bodyText = preg_replace("/\r\n|\r|\n/", "\r\n", $bodyText);

    return implode("\r\n", $headers) . "\r\n\r\n" . $bodyText . "\r\n";
}

/**
 * SMTP por sockets + STARTTLS + AUTH LOGIN (587).
 * Si quisieras 465 (TLS implícito), se adapta, pero IONOS normalmente 587.
 */
function smtp_send_mail(array $cfg, string $from, string $to, string $subject, string $body): void {
    $host = $cfg['host'];
    $port = (int)$cfg['port'];
    $user = $cfg['user'];
    $pass = $cfg['pass'];

    if ($host === '' || $port <= 0 || $user === '' || $pass === '') {
        throw new RuntimeException("Faltan credenciales SMTP. Define SMTP_HOST/SMTP_PORT/SMTP_USER/SMTP_PASS en el entorno.");
    }

    $fp = fsockopen($host, $port, $errno, $errstr, 20);
    if (!$fp) {
        throw new RuntimeException("No se pudo conectar a {$host}:{$port} ({$errno}) {$errstr}");
    }
    stream_set_timeout($fp, 20);

    $banner = smtp_read($fp);
    if ((int)substr($banner, 0, 3) !== 220) {
        fclose($fp);
        throw new RuntimeException("Banner SMTP inválido: {$banner}");
    }

    smtp_cmd($fp, "EHLO jocarsa-web", [250]);
    smtp_cmd($fp, "STARTTLS", [220]);

    $cryptoOk = stream_socket_enable_crypto($fp, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
    if ($cryptoOk !== true) {
        fclose($fp);
        throw new RuntimeException("No se pudo iniciar TLS (STARTTLS). Revisa extensión openssl de PHP y configuración del servidor.");
    }

    smtp_cmd($fp, "EHLO jocarsa-web", [250]);

    // AUTH LOGIN
    smtp_cmd($fp, "AUTH LOGIN", [334]);
    smtp_cmd($fp, base64_encode($user), [334]);
    smtp_cmd($fp, base64_encode($pass), [235]);

    smtp_cmd($fp, "MAIL FROM:<{$from}>", [250]);
    smtp_cmd($fp, "RCPT TO:<{$to}>", [250, 251]);
    smtp_cmd($fp, "DATA", [354]);

    $raw = build_message($from, $to, $subject, $body);

    // Dot-stuffing
    $raw = preg_replace("/\r\n\./", "\r\n..", $raw);

    fwrite($fp, $raw . "\r\n.\r\n");
    $resp = smtp_read($fp);
    if ((int)substr($resp, 0, 3) !== 250) {
        fclose($fp);
        throw new RuntimeException("El servidor no aceptó DATA: {$resp}");
    }

    smtp_cmd($fp, "QUIT", [221, 250]);
    fclose($fp);
}

/* ----------------------------
   Procesamiento formulario POST
-----------------------------*/
$sentOk   = false;
$errorMsg = '';

$empresa  = '';
$contacto = '';
$email    = '';
$interes  = '';
$mensaje  = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $empresa  = trim((string)($_POST['empresa']  ?? ''));
    $contacto = trim((string)($_POST['contacto'] ?? ''));
    $email    = trim((string)($_POST['email']    ?? ''));
    $interes  = trim((string)($_POST['interes']  ?? ''));
    $mensaje  = trim((string)($_POST['mensaje']  ?? ''));

    if ($empresa === '' || $contacto === '' || $email === '' || $interes === '' || $mensaje === '') {
        $errorMsg = "Por favor, complete todos los campos.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg = "El email no tiene un formato válido.";
    } else {
        // Config SMTP desde entorno (NO hardcode del password)
        $cfg = [
            'host' => envv('SMTP_HOST', 'smtp.ionos.es'),
            'port' => envv('SMTP_PORT', '587'),
            'user' => envv('SMTP_USER', 'info@jocarsa.com'),
            'pass' => envv('SMTP_PASS', ''), // <- imprescindible
        ];

        $from    = 'info@jocarsa.com';
        $to      = 'info@jocarsa.com';
        $subject = 'CORREO DESDE LA WEB';

        $body =
            "Nuevo contacto desde la web\n"
            . "--------------------------\n"
            . "Empresa: {$empresa}\n"
            . "Persona de contacto: {$contacto}\n"
            . "Email del solicitante: {$email}\n"
            . "Interés: {$interes}\n"
            . "Mensaje:\n{$mensaje}\n"
            . "\n"
            . "Meta:\n"
            . "IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'n/a') . "\n"
            . "UA: " . ($_SERVER['HTTP_USER_AGENT'] ?? 'n/a') . "\n";

        try {
            smtp_send_mail($cfg, $from, $to, $subject, $body);
            $sentOk = true;

            // Limpia campos tras enviar
            $empresa = $contacto = $email = $interes = $mensaje = '';
        } catch (Throwable $e) {
            $errorMsg = "No se pudo enviar el correo. " . $e->getMessage();
        }
    }
}

// Para que, tras POST, el usuario aterrice visualmente en Contacto
$jumpToContacto = ($_SERVER['REQUEST_METHOD'] === 'POST');
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>JOCARSA · IA para empresas (PYMES)</title>
  <meta name="description" content="JOCARSA implanta soluciones prácticas de Inteligencia Artificial para PYMES: automatización de correos, documentos, atención al cliente, analítica y copilotos internos." />
  <meta property="og:title" content="JOCARSA · IA para empresas (PYMES)" />
  <meta property="og:description" content="Automatización, análisis y asistentes inteligentes, con implantación progresiva y mantenimiento." />
  <meta name="theme-color" content="#2b2a8a" />
  <link rel="stylesheet" href="styles.css" />
</head>
<body>

<header class="site-header">
  <div class="container header-inner">
    <a class="brand" href="#inicio" aria-label="JOCARSA">
      <img src="jocarsa logo.svg" alt="JOCARSA">
      <div class="texto">
        <span class="brand-name">JOCARSA</span>
        <span class="brand-tag">IA práctica para PYMES</span>
      </div>
    </a>

    <nav class="nav" aria-label="Navegación principal">
      <a href="#soluciones">Soluciones</a>
      <a href="#caso-exito">Caso de éxito</a>
      <a href="#video-demo">Vídeo</a>
      <a href="#metodo">Método</a>
      <a href="#faq">FAQ</a>
      <a class="btn btn-primary" href="#contacto">Solicitar diagnóstico</a>
    </nav>
  </div>
</header>

<main id="inicio">

  <!-- HERO -->
  <section class="hero">
    <div class="container hero-grid">
      <div class="hero-content">
        <p class="pill">Especialistas en implantación de IA · Comunidad Valenciana</p>
        <h1>Automatice procesos, mejore la atención al cliente y tome decisiones con datos.</h1>
        <p class="lead">
          Implantamos soluciones de Inteligencia Artificial orientadas a resultados: menos tareas manuales,
          menos errores operativos y más agilidad comercial, sin aumentar costes de personal.
        </p>

        <div class="cta-row">
          <a class="btn btn-primary" href="#contacto">Solicitar diagnóstico gratuito</a>
          <a class="btn btn-ghost" href="#caso-exito">Ver caso de éxito</a>
        </div>

        <div class="trust-row" role="list" aria-label="Beneficios rápidos">
          <div class="trust-item" role="listitem">
            <span class="trust-kpi">↓</span>
            <span class="trust-text">Reduce tiempo administrativo</span>
          </div>
          <div class="trust-item" role="listitem">
            <span class="trust-kpi">+</span>
            <span class="trust-text">Mejora respuesta a clientes</span>
          </div>
          <div class="trust-item" role="listitem">
            <span class="trust-kpi">✔</span>
            <span class="trust-text">Implantación modular y progresiva</span>
          </div>
        </div>
      </div>

      <div class="hero-card" aria-label="Resumen de soluciones">
        <div class="card">
          <h2 class="card-title">Soluciones destacadas</h2>
          <ul class="checklist">
            <li>Automatización inteligente del correo: clasificación, prioridad y borradores de respuesta.</li>
            <li>Extracción de datos desde PDF e imágenes para integrarlos en su software de gestión.</li>
            <li>Chatbots y respuesta automática 24/7 en web y mensajería.</li>
            <li>Dashboards e informes con tendencias comerciales y alertas.</li>
            <li>Copiloto interno entrenado con documentación de la empresa.</li>
          </ul>

          <div class="mini-callout">
            <p><strong>Orientado a PYMES.</strong> Soluciones accesibles, adaptadas y sin complejidad innecesaria.</p>
          </div>

          <a class="btn btn-secondary btn-block" href="#soluciones">Ver catálogo completo</a>
        </div>
      </div>
    </div>
  </section>

  <!-- PROBLEMA / OPORTUNIDAD -->
  <section class="section" aria-label="Contexto y necesidad del mercado">
    <div class="container">
      <div class="section-head">
        <h2>La oportunidad: IA accesible y útil para PYMES</h2>
        <p class="muted">
          Muchas empresas ya tienen herramientas informáticas básicas, pero siguen realizando procesos manuales
          por falta de tiempo, personal especializado o soluciones adaptadas.
        </p>
      </div>

      <div class="grid-4">
        <article class="feature">
          <h3>Automatización administrativa</h3>
          <p>Correos, presupuestos, introducción de datos y clasificación documental: menos repetición, menos errores.</p>
        </article>
        <article class="feature">
          <h3>Análisis y uso de datos</h3>
          <p>Transformamos datos existentes en información útil para la dirección: informes, tendencias y alertas.</p>
        </article>
        <article class="feature">
          <h3>Atención al cliente</h3>
          <p>Respuestas rápidas y consistentes con chatbots y automatización 24/7 sin incrementar plantilla.</p>
        </article>
        <article class="feature">
          <h3>Competitividad</h3>
          <p>Acercamos tecnologías avanzadas de forma progresiva y realista, alineadas con su madurez digital.</p>
        </article>
      </div>
    </div>
  </section>

  <!-- SOLUCIONES -->
  <section id="soluciones" class="section section-alt" aria-label="Catálogo de soluciones">
    <div class="container">
      <div class="section-head">
        <h2>Catálogo de soluciones</h2>
        <p class="muted">
          Seleccionamos e implantamos módulos según su necesidad: comunicaciones, documentos, ventas, operaciones,
          RR. HH. y formación. Integrables con sus herramientas actuales.
        </p>
      </div>

      <div class="solutions-grid">
        <div class="solution-card">
          <h3>Comunicaciones y atención</h3>
          <ul class="bullets">
            <li>Automatización de correos: clasificar, priorizar y generar respuestas básicas.</li>
            <li>Respuesta automática a consultas frecuentes 24/7.</li>
            <li>Chatbot de atención al cliente en web o mensajería.</li>
            <li>Automatización postventa y seguimiento.</li>
            <li>Organización automática de agendas y tareas.</li>
          </ul>
        </div>

        <div class="solution-card">
          <h3>Documentos y extracción de datos</h3>
          <ul class="bullets">
            <li>Clasificación documental: contratos, facturas, albaranes.</li>
            <li>Extracción de datos desde PDF e imágenes.</li>
            <li>Digitalización y organización centralizada de documentación.</li>
            <li>Implantación rápida y bajo coste para pequeñas empresas.</li>
          </ul>
        </div>

        <div class="solution-card">
          <h3>Ventas, BI y decisiones</h3>
          <ul class="bullets">
            <li>Análisis de ventas con informes automáticos y detección de tendencias.</li>
            <li>Paneles de indicadores (KPI) generados desde datos internos.</li>
            <li>Estimación de demanda / previsión básica.</li>
            <li>Segmentación automática de clientes por comportamiento.</li>
            <li>Apoyo comercial: sugerencias de acciones de seguimiento.</li>
          </ul>
        </div>

        <div class="solution-card">
          <h3>Operaciones, RR. HH. y productividad</h3>
          <ul class="bullets">
            <li>Automatización de procesos administrativos repetitivos (flujos digitales).</li>
            <li>Automatización RR. HH.: clasificación de currículos y solicitudes.</li>
            <li>Control y análisis de productividad interna.</li>
            <li>Generación automática de comunicaciones corporativas.</li>
          </ul>
        </div>

        <div class="solution-card">
          <h3>Copilotos e integración</h3>
          <ul class="bullets">
            <li>Copiloto empresarial entrenado con documentación interna.</li>
            <li>Asistente interno para procedimientos, normativa y consultas.</li>
            <li>Integración de datos de distintos programas existentes.</li>
            <li>Módulos escalables según crecimiento de la empresa.</li>
          </ul>
        </div>

        <div class="solution-card">
          <h3>Implantación y continuidad</h3>
          <ul class="bullets">
            <li>Auditoría tecnológica y diagnóstico de madurez digital.</li>
            <li>Implantación progresiva de IA (por fases).</li>
            <li>Formación asistida en IA para empleados.</li>
            <li>Mantenimiento y mejora continua de soluciones implantadas.</li>
          </ul>
        </div>
      </div>

      <div class="callout">
        <div>
          <h3>¿No tiene claro por dónde empezar?</h3>
          <p class="muted">Realizamos un diagnóstico y proponemos un plan por fases con impacto medible.</p>
        </div>
        <a class="btn btn-primary" href="#contacto">Pedir diagnóstico</a>
      </div>
    </div>
  </section>

  <!-- CASO DE ÉXITO -->
  <section id="caso-exito" class="section" aria-label="Caso de éxito destacado">
    <div class="container">
      <div class="section-head">
        <h2>Caso de éxito destacado</h2>
        <p class="muted">Sistema inteligente de automatización de comunicaciones empresariales</p>
      </div>

      <div class="case-grid">
        <div class="case-card">
          <h3>Qué resuelve</h3>
          <p>
            Automatiza la gestión del correo electrónico y la atención a consultas: clasifica mensajes,
            prioriza solicitudes y genera borradores de respuesta adaptados al negocio. Además integra
            respuestas automáticas a FAQs y chatbots conectados a web o mensajería.
          </p>

          <div class="case-badges" aria-label="Impacto esperado">
            <span class="badge">Menos tiempo en correo</span>
            <span class="badge">Respuestas más rápidas</span>
            <span class="badge">Sin aumentar plantilla</span>
          </div>
        </div>

        <div class="case-card">
          <h3>Bloque 1 · Flujo de trabajo</h3>

          <ol class="steps">
            <li>
              <strong>Recepción de correos</strong>
              <span>Integración por IMAP (y opciones equivalentes según proveedor).</span>
            </li>
            <li>
              <strong>Comprensión semántica</strong>
              <span>IA + base de conocimiento; clasificación por intención y tema.</span>
            </li>
            <li>
              <strong>Priorización</strong>
              <span>Valoración 0–10 según urgencia/impacto, con reglas y aprendizaje.</span>
            </li>
            <li>
              <strong>Respuestas automáticas</strong>
              <span>Borradores coherentes con la política y tono de la empresa; envío por SMTP si aplica.</span>
            </li>
          </ol>

          <div class="note">
            <p><strong>Enfoque:</strong> se implanta de forma modular para minimizar riesgo y medir resultados.</p>
          </div>
        </div>

        <div class="case-card case-wide">
          <h3>Necesidad de mercado (PYMES)</h3>
          <p class="muted">
            La digitalización está aumentando el volumen de comunicaciones y documentación. Sin automatización,
            se acumulan tareas repetitivas, aumentan los errores y se pierden oportunidades. Las PYMES necesitan
            soluciones accesibles, adaptadas y progresivas.
          </p>

          <div class="grid-3">
            <div class="mini">
              <h4>Automatización</h4>
              <p>Reduce tiempos y errores en tareas rutinarias (correo, datos, documentos).</p>
            </div>
            <div class="mini">
              <h4>Datos útiles</h4>
              <p>Informes e indicadores claros para dirección, sin complejidad técnica.</p>
            </div>
            <div class="mini">
              <h4>Atención al cliente</h4>
              <p>Respuesta rápida y consistente, evitando retrasos y pérdida de ventas.</p>
            </div>
          </div>

          <div class="cta-inline">
            <a class="btn btn-secondary" href="#contacto">Quiero este sistema</a>
            <a class="btn btn-ghost" href="#soluciones">Ver otras soluciones</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- VIDEO DEMO -->
  <section id="video-demo" class="section" aria-label="Vídeo demostración del sistema de comunicaciones">
    <div class="container">
      <div class="section-head">
        <h2>Vídeo demostración</h2>
        <p class="muted">
          Así funciona el sistema de automatización de comunicaciones: recepción de correos, comprensión semántica,
          priorización y generación de borradores de respuesta adaptados al negocio.
        </p>
      </div>

      <div class="video-grid">
        <div class="video-card card">
          <div class="video-wrap">
            <video controls preload="metadata" playsinline>
              <source src="video/clienteemail.mp4" type="video/mp4">
              Su navegador no soporta vídeo HTML5.
            </video>
          </div>

          <div class="video-meta">
            <span class="badge">Correo</span>
            <span class="badge">Prioridad 0–10</span>
            <span class="badge">Respuestas</span>
            <span class="badge">Integración</span>
          </div>
        </div>

        <div class="video-copy">
          <div class="card">
            <h3 class="card-title">Sistema inteligente de automatización de comunicaciones empresariales</h3>
            <p class="muted">
              Automatiza la gestión del correo electrónico: clasificación de mensajes, priorización de solicitudes
              y generación de respuestas automáticas básicas. Integra además sistemas de respuesta automática a consultas
              frecuentes y chatbots de atención al cliente conectados a web o canales de mensajería, permitiendo mejorar
              la comunicación interna y externa sin incrementar costes de personal.
            </p>

            <div class="mini-callout">
              <p><strong>Objetivo:</strong> reducir carga administrativa y asegurar respuestas rápidas y coherentes.</p>
            </div>

            <h4 class="subhead">Bloque 1 · Flujo de implantación</h4>
            <ol class="steps">
              <li>
                <strong>1) Recibir correos electrónicos</strong>
                <span>Integración IMAP (actualmente con Python), y alternativas según proveedor.</span>
              </li>
              <li>
                <strong>2) Procesar y clasificar el contenido</strong>
                <span>Comprensión semántica con IA y bases de datos vectoriales para interpretar intención y tema.</span>
              </li>
              <li>
                <strong>3) Priorización</strong>
                <span>Valoración 0–10 según urgencia e impacto, combinando reglas y aprendizaje.</span>
              </li>
              <li>
                <strong>4) Generación de respuestas automáticas</strong>
                <span>Borradores adaptados al negocio y a su política; envío mediante SMTP si aplica.</span>
              </li>
            </ol>

            <div class="cta-inline">
              <a class="btn btn-primary" href="#contacto">Quiero un diagnóstico</a>
              <a class="btn btn-ghost" href="#caso-exito">Volver al caso de éxito</a>
            </div>
          </div>
        </div>
      </div>

      <div class="callout">
        <div>
          <h3>Implantación modular y medible</h3>
          <p class="muted">Se puede empezar solo con correo y añadir después chatbot, FAQs y automatizaciones adicionales.</p>
        </div>
        <a class="btn btn-secondary" href="#contacto">Solicitar propuesta</a>
      </div>
    </div>
  </section>

  <!-- MÉTODO -->
  <section id="metodo" class="section section-alt" aria-label="Método de implantación">
    <div class="container">
      <div class="section-head">
        <h2>Método de implantación</h2>
        <p class="muted">Un proceso simple y controlado, orientado a impacto real y continuidad.</p>
      </div>

      <div class="timeline">
        <div class="timeline-item">
          <div class="timeline-dot" aria-hidden="true"></div>
          <div>
            <h3>1) Diagnóstico y objetivos</h3>
            <p>Identificamos procesos repetitivos, fuentes de datos y oportunidades con retorno rápido.</p>
          </div>
        </div>

        <div class="timeline-item">
          <div class="timeline-dot" aria-hidden="true"></div>
          <div>
            <h3>2) Piloto controlado</h3>
            <p>Implementamos un módulo mínimo viable, con métricas claras y validación interna.</p>
          </div>
        </div>

        <div class="timeline-item">
          <div class="timeline-dot" aria-hidden="true"></div>
          <div>
            <h3>3) Implantación progresiva</h3>
            <p>Escalamos por fases: más automatización, más integraciones, más cobertura de procesos.</p>
          </div>
        </div>

        <div class="timeline-item">
          <div class="timeline-dot" aria-hidden="true"></div>
          <div>
            <h3>4) Formación y soporte</h3>
            <p>Capacitamos a usuarios clave y dejamos procedimientos claros para operación diaria.</p>
          </div>
        </div>

        <div class="timeline-item">
          <div class="timeline-dot" aria-hidden="true"></div>
          <div>
            <h3>5) Mejora continua</h3>
            <p>Mantenimiento, optimización y evolución según crecimiento y nuevas necesidades.</p>
          </div>
        </div>
      </div>

      <div class="callout">
        <div>
          <h3>Implantación modular, riesgo bajo</h3>
          <p class="muted">Empiece por un proceso (correo, documentos o atención al cliente) y amplíe después.</p>
        </div>
        <a class="btn btn-primary" href="#contacto">Empezar</a>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section id="faq" class="section" aria-label="Preguntas frecuentes">
    <div class="container">
      <div class="section-head">
        <h2>Preguntas frecuentes</h2>
        <p class="muted">Respuestas claras para decisiones rápidas.</p>
      </div>

      <div class="faq-grid">
        <details class="faq">
          <summary>¿Es necesario cambiar nuestro software actual?</summary>
          <p>No necesariamente. Siempre que sea posible, integramos y aprovechamos lo que ya existe para reducir coste y fricción.</p>
        </details>

        <details class="faq">
          <summary>¿Cuánto tarda una implantación típica?</summary>
          <p>Depende del módulo. Un piloto puede estar operativo en poco tiempo; la implantación completa se planifica por fases.</p>
        </details>

        <details class="faq">
          <summary>¿Cómo se garantiza que las respuestas se ajusten a nuestra empresa?</summary>
          <p>Se define un marco de conocimiento (documentación, políticas, estilo) y se valida con usuarios responsables antes de automatizar envíos.</p>
        </details>

        <details class="faq">
          <summary>¿Esto es solo para empresas grandes?</summary>
          <p>No. El enfoque está pensado para PYMES: accesible, modular, adaptado y con retorno medible.</p>
        </details>

        <details class="faq">
          <summary>¿Ofrecéis mantenimiento?</summary>
          <p>Sí. Incluye monitorización, ajustes, ampliaciones, mejora continua y soporte a usuarios.</p>
        </details>

        <details class="faq">
          <summary>¿Podemos empezar solo con el correo y luego ampliar?</summary>
          <p>Sí. De hecho es la vía recomendada: un primer módulo con impacto y luego ampliación progresiva.</p>
        </details>
      </div>
    </div>
  </section>

  <!-- CONTACTO -->
  <section id="contacto" class="section section-alt" aria-label="Contacto">
    <div class="container">
      <div class="contact-grid">
        <div>
          <h2>Solicite un diagnóstico</h2>
          <p class="muted">
            Envíe un breve resumen de su situación y le proponemos un plan por fases.
            Si lo desea, podemos empezar por el sistema de comunicaciones (correo + chatbot + priorización).
          </p>

          <?php if ($sentOk): ?>
            <div class="note" role="status" aria-live="polite">
              <p><strong>Enviado correctamente.</strong> Hemos recibido su solicitud y le responderemos lo antes posible.</p>
            </div>
          <?php elseif ($errorMsg !== ''): ?>
            <div class="note" role="alert" aria-live="assertive" style="border-color: rgba(255,122,26,.35); background: rgba(255,122,26,.10);">
              <p><strong>Error:</strong> <?= h($errorMsg) ?></p>
              <p class="muted fine" style="margin-top:8px;">
                Verifique que ha definido <code>SMTP_PASS</code> y que el servidor permite STARTTLS en el puerto 587.
              </p>
            </div>
          <?php endif; ?>

          <div class="contact-points">
            <div class="contact-point">
              <span class="icon" aria-hidden="true">⦿</span>
              <div>
                <strong>Enfoque local</strong>
                <p class="muted">PYMES de la Comunidad Valenciana.</p>
              </div>
            </div>
            <div class="contact-point">
              <span class="icon" aria-hidden="true">⦿</span>
              <div>
                <strong>Implantación progresiva</strong>
                <p class="muted">De piloto a despliegue, con métricas.</p>
              </div>
            </div>
            <div class="contact-point">
              <span class="icon" aria-hidden="true">⦿</span>
              <div>
                <strong>Soporte y continuidad</strong>
                <p class="muted">Formación + mantenimiento.</p>
              </div>
            </div>
          </div>
        </div>

        <form class="form card" action="<?= $jumpToContacto ? '#contacto' : '' ?>" method="post">
          <h3 class="card-title">Contacto</h3>

          <label>
            Empresa
            <input type="text" name="empresa" placeholder="Nombre de la empresa" required value="<?= h($empresa) ?>" />
          </label>

          <label>
            Persona de contacto
            <input type="text" name="contacto" placeholder="Nombre y apellidos" required value="<?= h($contacto) ?>" />
          </label>

          <label>
            Email
            <input type="email" name="email" placeholder="correo@empresa.com" required value="<?= h($email) ?>" />
          </label>

          <label>
            ¿Qué necesita automatizar primero?
            <select name="interes" required>
              <option value="" <?= $interes===''?'selected':'' ?> disabled>Seleccione una opción</option>
              <option <?= $interes==='Correo: clasificación, prioridad y respuestas'?'selected':'' ?>>Correo: clasificación, prioridad y respuestas</option>
              <option <?= $interes==='Documentos: clasificación y extracción desde PDF'?'selected':'' ?>>Documentos: clasificación y extracción desde PDF</option>
              <option <?= $interes==='Atención al cliente: chatbot y FAQs'?'selected':'' ?>>Atención al cliente: chatbot y FAQs</option>
              <option <?= $interes==='Ventas y BI: dashboards e informes'?'selected':'' ?>>Ventas y BI: dashboards e informes</option>
              <option <?= $interes==='Copiloto interno: documentación y consultas'?'selected':'' ?>>Copiloto interno: documentación y consultas</option>
              <option <?= $interes==='Otro / no lo tengo claro'?'selected':'' ?>>Otro / no lo tengo claro</option>
            </select>
          </label>

          <label>
            Mensaje
            <textarea name="mensaje" rows="5" placeholder="Describa brevemente el proceso actual y el volumen aproximado (correos, documentos, etc.)." required><?= h($mensaje) ?></textarea>
          </label>

          <button class="btn btn-primary btn-block" type="submit">Enviar</button>
          <p class="fine muted">Al enviar, acepta que usemos sus datos únicamente para responder a su solicitud.</p>
        </form>
      </div>
    </div>
  </section>

</main>

<footer class="footer">
  <div class="container footer-inner">
    <div>
      <div class="footer-brand">
        <span class="brand-mark" aria-hidden="true"></span>
        <strong>JOCARSA</strong>
      </div>
      <p class="muted">Implantación de soluciones de IA para PYMES · Automatización · Datos · Atención al cliente</p>
    </div>

    <div class="footer-links">
      <a href="#soluciones">Soluciones</a>
      <a href="#caso-exito">Caso de éxito</a>
      <a href="#video-demo">Vídeo</a>
      <a href="#metodo">Método</a>
      <a href="#contacto">Contacto</a>
    </div>
  </div>
</footer>

</body>
</html>
