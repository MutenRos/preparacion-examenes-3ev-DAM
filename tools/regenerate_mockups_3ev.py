#!/usr/bin/env python3
"""
Regenera los 32 mockups restantes del Proyecto intermodular (3ª evaluación)
para que cada uno refleje fielmente el contenido real de su proyecto.

Excluye 004, 005, 009, 010 y 021 (regenerados previamente, ya correctos).
"""
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1] / "Primero" / "Preparación 3ª Evaluación" / "Proyecto intermodular" / "3-mockups-pages"

def shell(slug, title, palette, h1, subtitle, stack, body):
    p = palette
    return f"""<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>{title} · mockup</title>
<style>
  :root {{
    --bg:{p['bg']}; --fg:{p['fg']}; --muted:{p['muted']};
    --primary:{p['primary']}; --accent:{p['accent']}; --card:{p['card']};
    --line:{p['line']};
  }}
  *{{box-sizing:border-box}}
  body{{margin:0;font-family:-apple-system,Segoe UI,Roboto,sans-serif;background:var(--bg);color:var(--fg)}}
  .mock-banner{{background:#111;color:#ffe066;padding:6px 14px;font-size:12px;text-align:center}}
  .top{{display:flex;align-items:center;justify-content:space-between;padding:14px 22px;background:var(--primary);color:#fff;border-bottom:3px solid var(--accent)}}
  .top .brand{{font-weight:800;letter-spacing:.3px}}
  .top nav a{{color:#fff;text-decoration:none;margin-left:18px;opacity:.85;font-size:14px}}
  .top nav a:hover{{opacity:1}}
  main{{max-width:1100px;margin:0 auto;padding:26px 22px 60px}}
  h1{{margin:6px 0 4px;font-size:30px}}
  .sub{{color:var(--muted);margin:0 0 22px}}
  .grid{{display:grid;gap:14px}}
  .grid-2{{grid-template-columns:repeat(2,1fr)}}
  .grid-3{{grid-template-columns:repeat(3,1fr)}}
  .card{{background:var(--card);border:1px solid var(--line);border-radius:10px;padding:14px}}
  .card h3{{margin:0 0 6px;font-size:15px;color:var(--primary)}}
  .pill{{display:inline-block;background:var(--accent);color:#fff;padding:2px 8px;border-radius:99px;font-size:11px;margin-right:4px}}
  pre{{background:#0d1117;color:#c9d1d9;padding:12px;border-radius:8px;overflow:auto;font-size:12px;margin:8px 0}}
  table{{width:100%;border-collapse:collapse;font-size:13px}}
  th,td{{padding:6px 8px;border-bottom:1px solid var(--line);text-align:left}}
  th{{background:var(--bg);color:var(--muted);font-weight:600}}
  .foot{{margin-top:30px;padding:14px 22px;background:#111;color:#aaa;font-size:12px;text-align:center}}
  .foot b{{color:var(--accent)}}
  .kpi{{display:flex;gap:10px;flex-wrap:wrap}}
  .kpi .k{{flex:1;min-width:130px;background:var(--card);border:1px solid var(--line);padding:10px;border-radius:10px}}
  .kpi .k b{{display:block;color:var(--primary);font-size:22px}}
  .kpi .k span{{color:var(--muted);font-size:11px}}
  .row{{display:flex;gap:12px}}
  .row>*{{flex:1}}
  .tag{{font-size:11px;background:var(--bg);border:1px solid var(--line);padding:2px 7px;border-radius:4px;color:var(--muted)}}
  ul.files{{list-style:none;padding:0;margin:6px 0;font-family:ui-monospace,monospace;font-size:12px}}
  ul.files li{{padding:3px 0;color:var(--muted)}}
  ul.files li::before{{content:"📄 ";margin-right:4px}}
</style>
</head>
<body>
<div class="mock-banner">⚠️ Mockup ilustrativo · proyecto: <b>{title}</b></div>
<header class="top">
  <div class="brand">{h1}</div>
  <nav><a href="#">Inicio</a><a href="#">Demo</a><a href="#">Código</a><a href="../index.html">← Volver</a></nav>
</header>
<main>
  <h1>{h1}</h1>
  <p class="sub">{subtitle}</p>
  {body}
</main>
<footer class="foot">Stack: <b>{stack}</b> · slug <code>{slug}</code></footer>
</body>
</html>
"""

# Paletas reutilizables (cada proyecto recibe una distinta)
def pal(primary, accent, bg="#f5f7fb", card="#fff", fg="#1d2330", muted="#6a7388", line="#e3e7ee"):
    return dict(primary=primary, accent=accent, bg=bg, card=card, fg=fg, muted=muted, line=line)

MOCKS = {}

# ---------- 001 Sistema inteligente de comunicaciones ----------
MOCKS["dam-001-sistema-comunicaciones"] = dict(
    title="Sistema inteligente de comunicaciones",
    h1="📬 Bandeja IA",
    palette=pal("#1f3a5f", "#ff8a3d"),
    subtitle="IMAP + Ollama (qwen2.5) clasificando correos en tiempo real",
    stack="Python · Flask · Ollama · IMAP · dotenv",
    body="""
    <div class="kpi">
      <div class="k"><b>147</b><span>Correos hoy</span></div>
      <div class="k"><b>12</b><span>🔴 Urgentes</span></div>
      <div class="k"><b>89</b><span>🟢 Normales</span></div>
      <div class="k"><b>46</b><span>🗑️ Spam</span></div>
    </div>
    <h3 style="margin-top:18px;color:var(--primary)">Bandeja clasificada</h3>
    <div class="grid">
      <div class="card" style="border-left:4px solid #d83b3b"><span class="pill" style="background:#d83b3b">URGENTE</span> <b>cliente@bigcorp.com</b> — Servidor caído en producción
        <div style="color:var(--muted);font-size:12px;margin-top:4px">🤖 Resumen: cliente reporta caída total desde las 8:14. Pide call de emergencia. Sugerida respuesta: confirmar incidencia y dar ETA.</div>
      </div>
      <div class="card" style="border-left:4px solid #2a9d4a"><span class="pill" style="background:#2a9d4a">NORMAL</span> <b>rrhh@empresa.es</b> — Nóminas de octubre disponibles
        <div style="color:var(--muted);font-size:12px;margin-top:4px">🤖 Resumen: notificación informativa; revisar antes del día 5. No requiere respuesta.</div>
      </div>
      <div class="card" style="border-left:4px solid #888"><span class="pill" style="background:#888">SPAM</span> <b>promo@xn--ofertas.tk</b> — ¡GANA un iPhone gratis!
        <div style="color:var(--muted);font-size:12px;margin-top:4px">🤖 Confianza spam: 98% · archivado automáticamente.</div>
      </div>
    </div>
    <h3 style="margin-top:18px;color:var(--primary)">Pipeline IA</h3>
    <pre># 006-resumen con ia.py
respuesta = ollama.chat(model="qwen2.5", messages=[
  {"role":"system","content":"Resume el correo en 2 líneas y clasifica."},
  {"role":"user","content": cuerpo_correo}
])</pre>
    <ul class="files"><li>002-recibir correo.py</li><li>006-resumen con ia.py</li><li>007-clasificación de correos.py</li><li>009-interfaz flask/</li></ul>
    """,
)

# ---------- 002 Nueva web jocarsa ----------
MOCKS["dam-002-nueva-web-jocarsa"] = dict(
    title="Nueva web jocarsa",
    h1="jocarsa",
    palette=pal("#ee6b1a", "#222", bg="#fff", card="#fff8f1", line="#f1d6b8"),
    subtitle="Web corporativa con jerarquía visual moderna",
    stack="PHP · HTML5 · CSS moderno · SVG inline",
    body="""
    <div class="card" style="background:linear-gradient(135deg,#ee6b1a,#ffb066);color:#fff;border:none;padding:40px 24px;text-align:center">
      <div style="font-size:36px;font-weight:900">Construimos software a medida</div>
      <div style="opacity:.9;margin-top:6px">PHP, IA local y servidores en Linux para clientes de toda la vida</div>
      <button style="margin-top:14px;background:#222;color:#fff;border:0;padding:10px 22px;border-radius:6px;font-weight:700">Contactar</button>
    </div>
    <h3 style="margin-top:22px;color:var(--primary)">Servicios</h3>
    <div class="grid grid-3">
      <div class="card"><h3>🌐 Web a medida</h3><p style="font-size:13px;color:var(--muted);margin:0">Sitios PHP rápidos y mantenibles.</p></div>
      <div class="card"><h3>🤖 IA local</h3><p style="font-size:13px;color:var(--muted);margin:0">Asistentes con Ollama on-premise.</p></div>
      <div class="card"><h3>🛠️ Soporte</h3><p style="font-size:13px;color:var(--muted);margin:0">Servidor + actualizaciones.</p></div>
    </div>
    <h3 style="margin-top:18px;color:var(--primary)">Casos de éxito</h3>
    <div class="row">
      <div class="card">Centro FP — LMS completo</div>
      <div class="card">PYME — automatización emails</div>
      <div class="card">Comercio — panel de ventas</div>
    </div>
    <ul class="files"><li>index.php</li><li>styles.css</li><li>jocarsa logo.svg</li><li>index.html</li></ul>
    """,
)

# ---------- 003 Repaso deploy ----------
MOCKS["dam-003-repaso-deploy"] = dict(
    title="Repaso deploy",
    h1="🚀 De localhost a producción",
    palette=pal("#2c3e50", "#3ddc97", bg="#1a1f29", card="#252b38", fg="#e5ecf2", muted="#94a0b3", line="#34404f"),
    subtitle="Guía técnica navegable con pasos reproducibles",
    stack="Apache · Flask · Gunicorn · systemd · Let's Encrypt",
    body="""
    <div class="row">
      <aside class="card" style="max-width:230px">
        <h3>Índice</h3>
        <ol style="padding-left:18px;font-size:13px;line-height:1.9">
          <li>Dev vs Prod</li>
          <li>Apache + VirtualHost</li>
          <li>Proxy inverso a Flask</li>
          <li>Gunicorn como servicio</li>
          <li>HTTPS con certbot</li>
          <li>systemd unit</li>
        </ol>
      </aside>
      <div class="card">
        <h3>2. Apache + VirtualHost</h3>
        <pre>&lt;VirtualHost *:80&gt;
  ServerName jocarsa.com
  ProxyPass / http://127.0.0.1:8000/
  ProxyPassReverse / http://127.0.0.1:8000/
&lt;/VirtualHost&gt;</pre>
        <h3 style="margin-top:14px">3. Gunicorn</h3>
        <pre>gunicorn -w 4 -b 127.0.0.1:8000 app:app</pre>
        <h3 style="margin-top:14px">5. HTTPS</h3>
        <pre>sudo certbot --apache -d jocarsa.com</pre>
      </div>
    </div>
    <ul class="files"><li>001-introduccion.md</li><li>002-Tarea a realizar.md</li><li>post.md</li></ul>
    """,
)

# ---------- 006 Enlaces sociales ----------
MOCKS["dam-006-enlaces-sociales"] = dict(
    title="Añado enlaces sociales a la web",
    h1="🔗 Iconos sociales jocarsa",
    palette=pal("#0a66c2", "#e1306c", bg="#fff"),
    subtitle="Integración responsive en header y footer con SVG optimizado",
    stack="HTML · CSS · SVG · flexbox",
    body="""
    <div class="card">
      <h3>Header (vista previa)</h3>
      <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 14px;background:#222;color:#fff;border-radius:6px">
        <b>jocarsa</b>
        <div style="display:flex;gap:10px;font-size:20px">
          <span style="color:#1877f2">📘</span>
          <span style="color:#0a66c2">💼</span>
          <span style="color:#e1306c">📷</span>
          <span style="color:#000">🐙</span>
          <span style="color:#25d366">💬</span>
          <span style="color:#ff0000">▶️</span>
        </div>
      </div>
    </div>
    <h3 style="margin-top:14px;color:var(--primary)">Snippet CSS</h3>
    <pre>.social a { display:inline-flex; width:32px; height:32px;
  align-items:center; justify-content:center; border-radius:50%;
  transition:transform .15s; }
.social a:hover { transform:translateY(-2px); }</pre>
    <h3 style="margin-top:10px;color:var(--primary)">Buenas prácticas</h3>
    <ul style="font-size:13px;color:var(--muted)">
      <li><code>rel="noopener noreferrer"</code> en cada enlace externo</li>
      <li>SVG inline para que herede <code>currentColor</code></li>
      <li><code>aria-label</code> por red social para accesibilidad</li>
    </ul>
    <ul class="files"><li>index.html</li><li>index.php</li><li>styles.css</li><li>logos/</li></ul>
    """,
)

# ---------- 007 documentos a bases de datos ----------
MOCKS["dam-007-documentos-bd"] = dict(
    title="Documentos a bases de datos",
    h1="📚 Pipeline doc → SQLite",
    palette=pal("#7a5d18", "#d4af37", bg="#f9f5e8", card="#fff", line="#e0d6b5"),
    subtitle="Extracción normalizada de PDF/Word/Markdown a BD con metadatos",
    stack="Python · pypdf · python-docx · markdown-it · SQLite",
    body="""
    <div class="row">
      <div class="card"><h3>📥 Entrada</h3>
        <ul class="files"><li>pdf/boe-2024.pdf</li><li>pdf/manual.pdf</li><li>txt/notas.txt</li><li>md/apuntes.md</li></ul>
      </div>
      <div class="card" style="background:#0d1117;color:#c9d1d9"><h3 style="color:#d4af37">⚙️ Proceso</h3>
        <pre style="background:transparent;padding:0">[INFO] leyendo pdf/boe-2024.pdf
[INFO] 142 secciones detectadas
[INFO] insertando en sqlite...
[OK]   pdf/boe-2024.pdf → 142 filas</pre>
      </div>
      <div class="card"><h3>📤 BD final</h3>
        <table>
          <tr><th>tabla</th><th>filas</th></tr>
          <tr><td>documentos</td><td>14</td></tr>
          <tr><td>secciones</td><td>1.024</td></tr>
          <tr><td>tags</td><td>87</td></tr>
        </table>
      </div>
    </div>
    <ul class="files"><li>001-leer boe.py</li><li>006-proceso integral.py</li><li>out/ pdf/ txt/</li></ul>
    """,
)

# ---------- 008 Asistente de IA ----------
MOCKS["dam-008-asistente-ia"] = dict(
    title="Asistente de IA",
    h1="🧑‍🚀 Avatar 3D conversacional",
    palette=pal("#00bcd4", "#9c27b0", bg="#0e1422", card="#16213a", fg="#eaf1ff", muted="#9fb0cf", line="#283556"),
    subtitle="Habla en vivo con voz sintetizada y boca animada por visemas",
    stack="A-Frame · PHP · Ollama qwen2.5 · SpeechSynthesis · viseme",
    body="""
    <div class="row">
      <div class="card" style="background:linear-gradient(160deg,#16213a,#1e2c4d);min-height:300px;display:flex;align-items:center;justify-content:center;flex-direction:column">
        <div style="font-size:72px">🧑‍🚀</div>
        <div style="color:#9c27b0;font-weight:700;margin-top:8px">avatar.glb · hablando…</div>
        <div style="margin-top:10px;background:#00bcd4;color:#000;padding:4px 14px;border-radius:99px;font-size:12px">🎙️ síntesis activa</div>
      </div>
      <div class="card">
        <h3 style="color:#00bcd4">Conversación</h3>
        <div style="background:#0e1422;border-radius:6px;padding:8px 10px;margin:6px 0"><b style="color:#9c27b0">tú:</b> ¿Qué es una API REST?</div>
        <div style="background:#0e1422;border-radius:6px;padding:8px 10px;margin:6px 0"><b style="color:#00bcd4">avatar:</b> Es una interfaz que expone recursos sobre HTTP usando verbos GET/POST/PUT/DELETE…</div>
        <pre>// 024-animar solo al hablar.php
synth.onboundary = e =&gt; setViseme(letterToViseme(e.charIndex));</pre>
      </div>
    </div>
    <ul class="files"><li>018-cargamos avatar.php</li><li>024-animar solo al hablar.php</li><li>avatar.glb</li><li>avatar.png</li></ul>
    """,
)

# ---------- 011 Consumo energético ----------
MOCKS["dam-011-consumo-energetico"] = dict(
    title="Consumo energético",
    h1="⚡ Python vs C",
    palette=pal("#c0392b", "#2980b9", bg="#fdf6f5"),
    subtitle="Mismo algoritmo, benchmarks reales de tiempo y energía",
    stack="Python · C · perf · powerstat · matplotlib",
    body="""
    <div class="kpi">
      <div class="k"><b>12,3×</b><span>C más rápido</span></div>
      <div class="k"><b>8,9×</b><span>C menos energía</span></div>
      <div class="k"><b>1.000.000</b><span>iteraciones</span></div>
    </div>
    <div class="row" style="margin-top:14px">
      <div class="card" style="border-top:4px solid #c0392b"><h3>🐍 Python</h3>
        <div style="font-size:13px;color:var(--muted)">tiempo: <b>4,82 s</b><br>energía: <b>32,1 J</b><br>RAM pico: 84 MB</div>
        <div style="background:#c0392b;height:32px;width:100%;margin-top:8px;border-radius:4px"></div>
      </div>
      <div class="card" style="border-top:4px solid #2980b9"><h3>⚙️ C</h3>
        <div style="font-size:13px;color:var(--muted)">tiempo: <b>0,39 s</b><br>energía: <b>3,6 J</b><br>RAM pico: 2 MB</div>
        <div style="background:#2980b9;height:32px;width:8%;margin-top:8px;border-radius:4px"></div>
      </div>
    </div>
    <p style="color:var(--muted);font-size:13px;margin-top:10px">Conclusión: para tareas intensivas, C ahorra ~90% de energía. Trade-off: tiempo de desarrollo mucho mayor.</p>
    <ul class="files"><li>post.md</li><li>101-Ejercicios/</li></ul>
    """,
)

# ---------- 012 Informática gráfica ----------
MOCKS["dam-012-informatica-grafica"] = dict(
    title="Informática gráfica",
    h1="🎨 Galería Canvas",
    palette=pal("#6f42c1", "#fd7e14"),
    subtitle="8+ ejercicios HTML5 Canvas con preview en vivo",
    stack="HTML5 Canvas · JavaScript · CSS",
    body="""
    <div class="grid grid-3">
      <div class="card"><div style="background:#6f42c1;height:90px;border-radius:6px;display:flex;align-items:center;justify-content:center;color:#fff">━━━</div><h3>01 · Líneas</h3></div>
      <div class="card"><div style="background:linear-gradient(45deg,#6f42c1,#fd7e14);height:90px;border-radius:6px;display:flex;align-items:center;justify-content:center;color:#fff">▰</div><h3>02 · Formas</h3></div>
      <div class="card"><div style="background:radial-gradient(circle,#fd7e14,#6f42c1);height:90px;border-radius:6px"></div><h3>03 · Gradientes</h3></div>
      <div class="card"><div style="background:#6f42c1;height:90px;border-radius:6px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:38px">◆</div><h3>04 · Transformaciones</h3></div>
      <div class="card"><div style="background:#fd7e14;height:90px;border-radius:6px;display:flex;align-items:center;justify-content:center;color:#fff">⏯ anim</div><h3>05 · Animación</h3></div>
      <div class="card"><div style="background:#23272f;height:90px;border-radius:6px;display:flex;align-items:center;justify-content:center;color:#fd7e14">🖱️</div><h3>06 · Interacción</h3></div>
    </div>
    <p style="color:var(--muted);font-size:13px;margin-top:10px">Click en una tarjeta abre el ejercicio fullscreen con editor en vivo.</p>
    <ul class="files"><li>index.html</li><li>101-Ejercicios/</li></ul>
    """,
)

# ---------- 013 Motivando a Darío ----------
MOCKS["dam-013-motivando-dario"] = dict(
    title="Motivando a Darío",
    h1="✏️ Lienzo para dibujar",
    palette=pal("#e67e22", "#f1c40f", bg="#fffaf0"),
    subtitle="Ejercicios Canvas progresivos comentados en español",
    stack="HTML5 Canvas · JavaScript · CSS",
    body="""
    <div class="row">
      <aside class="card" style="max-width:120px">
        <h3>🖌️</h3>
        <div style="font-size:13px;line-height:2;color:var(--muted)">
          🖍 Pincel<br>🧽 Goma<br>🎨 Paleta<br>⬛ Relleno<br>↩ Deshacer<br>💾 PNG
        </div>
      </aside>
      <div class="card" style="background:#fff;min-height:280px;border:2px dashed #e67e22;display:flex;align-items:center;justify-content:center">
        <div style="font-size:60px">🦖✨</div>
      </div>
      <aside class="card" style="max-width:140px">
        <h3>Niveles</h3>
        <ol style="padding-left:18px;font-size:12px;line-height:1.8">
          <li>Trazo libre</li>
          <li>Formas básicas</li>
          <li>Color y relleno</li>
          <li>Capas</li>
          <li>Animar puntos</li>
          <li>Exportar PNG</li>
        </ol>
      </aside>
    </div>
    <ul class="files"><li>101-Ejercicios/ (HTML comentados)</li></ul>
    """,
)

# ---------- 014 Fundamentos de Blender ----------
MOCKS["dam-014-fundamentos-blender"] = dict(
    title="Fundamentos de Blender",
    h1="🪑 Galería 3D GLB",
    palette=pal("#3a3a3a", "#ff7f00", bg="#1f1f1f", card="#2a2a2a", fg="#f5f5f5", muted="#a0a0a0", line="#3a3a3a"),
    subtitle="Modelos exportados a glTF/GLB y visibles en navegador con orbit",
    stack="Blender 4.x · glTF 2.0 · model-viewer · WebGL",
    body="""
    <div class="grid grid-3">
      <div class="card"><div style="background:#3a3a3a;height:120px;border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:54px">🟧</div><h3 style="color:#ff7f00">001 · Primer objeto</h3><span class="tag">.glb</span></div>
      <div class="card"><div style="background:#3a3a3a;height:120px;border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:54px">🪑</div><h3 style="color:#ff7f00">002 · Silla</h3><span class="tag">.glb</span></div>
      <div class="card"><div style="background:#3a3a3a;height:120px;border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:54px">💡</div><h3 style="color:#ff7f00">004 · Lámpara</h3><span class="tag">.glb</span></div>
      <div class="card"><div style="background:#3a3a3a;height:120px;border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:54px">☕</div><h3 style="color:#ff7f00">005 · Taza</h3><span class="tag">.glb</span></div>
      <div class="card"><div style="background:#3a3a3a;height:120px;border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:54px">🏠</div><h3 style="color:#ff7f00">006 · Casa texturizada</h3><span class="tag">.glb + jpg</span></div>
      <div class="card"><div style="background:#3a3a3a;height:120px;border-radius:6px;display:flex;align-items:center;justify-content:center;color:#ff7f00">+ ver más</div><h3 style="color:#ff7f00">Más modelos</h3></div>
    </div>
    <p style="color:var(--muted);font-size:13px;margin-top:10px">Click abre visor 3D fullscreen con controles orbit, zoom e iluminación ambiental.</p>
    <ul class="files"><li>001-Primer objeto.glb</li><li>006-casa con textura.glb</li><li>index.html</li><li>fondo.jpg</li></ul>
    """,
)

# ---------- 015 Cliente de correo ----------
MOCKS["dam-015-cliente-correo"] = dict(
    title="Cliente de correo electrónico",
    h1="✉️ jocarsa-email",
    palette=pal("#1e88e5", "#ffa726"),
    subtitle="Cliente tipo Gmail conectado por IMAP en PHP",
    stack="PHP · IMAP · HTML+CSS+JS · Python",
    body="""
    <div class="card" style="padding:0;overflow:hidden">
      <div style="display:grid;grid-template-columns:160px 280px 1fr;min-height:340px">
        <aside style="background:#1e88e5;color:#fff;padding:10px">
          <button style="width:100%;background:#ffa726;border:0;padding:7px;border-radius:4px;color:#000;font-weight:700;margin-bottom:10px">+ Redactar</button>
          <div style="font-size:13px;line-height:2">📥 Recibidos (12)<br>⭐ Destacados<br>📤 Enviados<br>📝 Borradores<br>🗑️ Papelera</div>
        </aside>
        <div style="background:#f5faff;padding:6px;border-right:1px solid var(--line)">
          <div style="padding:8px;border-bottom:1px solid var(--line);font-size:12px"><b>cliente@a.com</b><br><span style="color:var(--muted)">Pedido confirmado…</span></div>
          <div style="padding:8px;border-bottom:1px solid var(--line);background:#fff3e0;font-size:12px"><b>rrhh@empresa.es</b><br><span style="color:var(--muted)">Nóminas listas</span></div>
          <div style="padding:8px;font-size:12px"><b>info@boletin.es</b><br><span style="color:var(--muted)">Newsletter octubre</span></div>
        </div>
        <div style="padding:12px;background:#fff">
          <h3 style="margin:0">Nóminas listas</h3>
          <div style="color:var(--muted);font-size:12px">rrhh@empresa.es · hoy 09:14</div>
          <hr style="margin:10px 0;border:0;border-top:1px solid var(--line)">
          <p style="font-size:13px">Adjuntamos PDF con la nómina de octubre. Cualquier duda, contactar con RRHH.</p>
          <div style="margin-top:8px"><span class="tag">📎 nomina-oct.pdf</span></div>
        </div>
      </div>
    </div>
    <ul class="files"><li>001-planteamiento.md</li><li>008-empezamos con php.php</li><li>010-mejoras.php</li><li>jocarsa-email/</li></ul>
    """,
)

# ---------- 016 WYSIWYG ----------
MOCKS["dam-016-wysiwyg"] = dict(
    title="WYSIWYG",
    h1="📝 jocarsa-wysiwyg",
    palette=pal("#444", "#1abc9c", bg="#fafafa"),
    subtitle="Editor de texto enriquecido tipo Google Docs",
    stack="HTML · JavaScript · contentEditable · execCommand",
    body="""
    <div class="card" style="padding:0">
      <div style="display:flex;gap:4px;padding:8px;border-bottom:1px solid var(--line);background:#fff">
        <button style="padding:4px 10px;border:1px solid #ccc;border-radius:4px;font-weight:700;background:#fff">B</button>
        <button style="padding:4px 10px;border:1px solid #ccc;border-radius:4px;font-style:italic;background:#fff">I</button>
        <button style="padding:4px 10px;border:1px solid #ccc;border-radius:4px;text-decoration:underline;background:#fff">U</button>
        <span style="border-left:1px solid #ccc;margin:0 4px"></span>
        <button style="padding:4px 10px;border:1px solid #ccc;border-radius:4px;background:#fff">• Lista</button>
        <button style="padding:4px 10px;border:1px solid #ccc;border-radius:4px;background:#fff">1. Num</button>
        <span style="border-left:1px solid #ccc;margin:0 4px"></span>
        <button style="padding:4px 10px;border:1px solid #ccc;border-radius:4px;background:#1abc9c;color:#fff">A̲</button>
        <button style="padding:4px 10px;border:1px solid #ccc;border-radius:4px;background:#fff">↩</button>
        <button style="padding:4px 10px;border:1px solid #ccc;border-radius:4px;background:#fff">↪</button>
      </div>
      <div contenteditable="true" style="min-height:200px;padding:18px;background:#fff;font-size:14px">
        <h2 style="margin:0 0 6px">Documento de ejemplo</h2>
        <p>Este editor permite aplicar <b>negrita</b>, <i>cursiva</i> y <span style="color:#1abc9c">color</span>.</p>
        <ul><li>Listas con viñetas</li><li>Listas numeradas</li><li>Vista en vivo del HTML</li></ul>
      </div>
    </div>
    <ul class="files"><li>index.html</li><li>jocarsa-wysiwyg.js</li><li>jocarsa-wysiwyg.css</li><li>001-inicio.html</li></ul>
    """,
)

# ---------- 017 Minibot ----------
MOCKS["dam-017-minibot"] = dict(
    title="Minibot",
    h1="🕷️ Crawler",
    palette=pal("#000", "#3ddc97", bg="#0d1117", card="#161b22", fg="#c9d1d9", muted="#8b949e", line="#21262d"),
    subtitle="Web crawler BFS con respeto a robots.txt y exporta JSON/CSV",
    stack="Python · requests · BeautifulSoup · SQLite",
    body="""
    <div class="card" style="background:#000">
      <pre style="background:transparent;color:#3ddc97;margin:0">$ python "004-sencillo bot.py" https://jocarsa.com
[INFO] respetando robots.txt
[OK]   /                     200  18 enlaces
[OK]   /servicios            200  12 enlaces
[OK]   /contacto             200   4 enlaces
[SKIP] /admin                blocked by robots.txt
[OK]   /casos                200   8 enlaces
[DONE] 42 URLs · 1.2s · sqlite=crawler.sqlite</pre>
    </div>
    <div class="row" style="margin-top:14px">
      <div class="card"><h3>📦 crawler.sqlite</h3>
        <table>
          <tr><th>url</th><th>status</th><th>tiempo</th></tr>
          <tr><td>/</td><td>200</td><td>120ms</td></tr>
          <tr><td>/servicios</td><td>200</td><td>98ms</td></tr>
          <tr><td>/casos</td><td>200</td><td>112ms</td></tr>
        </table>
      </div>
      <div class="card"><h3>📈 Estadísticas</h3>
        <div style="color:var(--muted);font-size:13px;line-height:1.9">URLs descubiertas: <b style="color:#3ddc97">42</b><br>Profundidad media: <b style="color:#3ddc97">3</b><br>Errores 4xx/5xx: <b style="color:#3ddc97">0</b></div>
      </div>
    </div>
    <ul class="files"><li>001-libreria requests.py</li><li>004-sencillo bot.py</li><li>crawler.sqlite</li><li>index.html</li></ul>
    """,
)

# ---------- 018 Estadísticas Apache ----------
MOCKS["dam-018-estadisticas-apache"] = dict(
    title="Estadísticas Apache",
    h1="📊 Apache access.log Dashboard",
    palette=pal("#0b6e6e", "#f39c12", bg="#f3f8f8"),
    subtitle="Parsea access.log y muestra KPIs y top rutas en vivo",
    stack="Python · regex · SQLite/MySQL · Flask · SVG",
    body="""
    <div class="kpi">
      <div class="k"><b>1.842</b><span>req/h</span></div>
      <div class="k"><b>94,2%</b><span>2xx OK</span></div>
      <div class="k"><b>3,1%</b><span>4xx</span></div>
      <div class="k"><b>0,2%</b><span>5xx</span></div>
      <div class="k"><b>187 ms</b><span>latencia media</span></div>
    </div>
    <div class="row" style="margin-top:14px">
      <div class="card"><h3>🏆 Top rutas</h3>
        <table>
          <tr><th>ruta</th><th>hits</th></tr>
          <tr><td>/index.php</td><td>4.124</td></tr>
          <tr><td>/casos</td><td>1.876</td></tr>
          <tr><td>/contacto</td><td>938</td></tr>
          <tr><td>/static/logo.svg</td><td>612</td></tr>
        </table>
      </div>
      <div class="card"><h3>🌐 Top user-agents</h3>
        <table>
          <tr><th>UA</th><th>%</th></tr>
          <tr><td>Chrome</td><td>54%</td></tr>
          <tr><td>Safari</td><td>22%</td></tr>
          <tr><td>Bots SEO</td><td>14%</td></tr>
          <tr><td>Otros</td><td>10%</td></tr>
        </table>
      </div>
    </div>
    <div class="card" style="margin-top:12px"><h3>📜 Log en vivo</h3>
      <pre>192.168.1.10 - - [04/Nov/2025:12:14:22] "GET /index.php HTTP/1.1" 200 4821
192.168.1.42 - - [04/Nov/2025:12:14:23] "GET /casos HTTP/1.1" 200 2103
192.168.1.10 - - [04/Nov/2025:12:14:24] "POST /contacto HTTP/1.1" 200 38</pre>
    </div>
    <ul class="files"><li>README.md</li><li>index.html</li><li>post.md</li></ul>
    """,
)

# ---------- 019 Cuestionario inglés ----------
MOCKS["dam-019-cuestionario-ingles"] = dict(
    title="Cuestionario online inglés",
    h1="🇬🇧 CEFR Adaptive Test",
    palette=pal("#012169", "#c8102e", bg="#f5f6fa"),
    subtitle="Test A1-C2 adaptativo con desglose por destreza",
    stack="PHP · SQLite · CSV banco de preguntas",
    body="""
    <div class="card">
      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px">
        <span class="tag">Pregunta 12/30</span>
        <span class="tag">Nivel estimado: B2</span>
      </div>
      <div style="height:6px;background:#eee;border-radius:99px;overflow:hidden;margin-bottom:14px">
        <div style="width:40%;height:100%;background:linear-gradient(90deg,#012169,#c8102e)"></div>
      </div>
      <h3 style="color:var(--primary)">Choose the correct option</h3>
      <p>If I _____ more time, I would learn another language.</p>
      <div style="display:flex;flex-direction:column;gap:6px">
        <label class="card" style="padding:8px;cursor:pointer"><input type="radio" name="q"> have</label>
        <label class="card" style="padding:8px;cursor:pointer;border-color:#012169"><input type="radio" name="q" checked> had</label>
        <label class="card" style="padding:8px;cursor:pointer"><input type="radio" name="q"> would have</label>
        <label class="card" style="padding:8px;cursor:pointer"><input type="radio" name="q"> have had</label>
      </div>
      <button style="margin-top:10px;background:#012169;color:#fff;border:0;padding:8px 18px;border-radius:4px">Siguiente →</button>
    </div>
    <div class="row" style="margin-top:14px">
      <div class="card"><h3>Resultado final (preview)</h3>
        <div style="font-size:13px;color:var(--muted);line-height:1.9">Listening: <b>B2</b><br>Reading: <b>C1</b><br>Grammar: <b>B2</b><br>Vocabulary: <b>B1+</b></div>
      </div>
      <div class="card"><h3>Admin</h3>
        <span class="tag">test_nivel.sqlite</span>
        <span class="tag">banco_preguntas.csv</span>
      </div>
    </div>
    <ul class="files"><li>001-leer csv.php</li><li>006-guardar y evaluar.php</li><li>admin.php</li><li>test_nivel.sqlite</li></ul>
    """,
)

# ---------- 020 Correos de cumpleaños ----------
MOCKS["dam-020-correos-cumpleanos"] = dict(
    title="Correos de cumpleaños",
    h1="🎂 Felicitador automático",
    palette=pal("#d62828", "#f77f00", bg="#fff7f0"),
    subtitle="Lee Google Sheets a las 9:00 y manda email a los que cumplen hoy",
    stack="Python · gspread · smtplib · Google Sheets · cron",
    body="""
    <div class="row">
      <div class="card"><h3>📋 Hoja de cálculo</h3>
        <table>
          <tr><th>nombre</th><th>email</th><th>fecha</th></tr>
          <tr style="background:#fff3c4"><td>Ana López</td><td>ana@x.com</td><td><b>04/11</b> 🎉</td></tr>
          <tr><td>Luis Pérez</td><td>luis@x.com</td><td>15/12</td></tr>
          <tr><td>Marta Gil</td><td>marta@x.com</td><td>22/03</td></tr>
          <tr style="background:#fff3c4"><td>Pablo Ruiz</td><td>pablo@x.com</td><td><b>04/11</b> 🎉</td></tr>
        </table>
      </div>
      <div class="card"><h3>📨 Email enviado (preview)</h3>
        <div style="background:#fff;border:1px solid var(--line);padding:10px;font-size:13px;border-radius:6px">
          <b>Para:</b> ana@x.com<br>
          <b>Asunto:</b> 🎂 ¡Feliz cumpleaños, Ana!<br><hr style="border:0;border-top:1px solid var(--line);margin:8px 0">
          Querida Ana, te deseamos un día estupendo lleno de risas y tarta. 🎈🎁<br>— El equipo
        </div>
      </div>
    </div>
    <div class="card" style="margin-top:12px;background:#0d1117;color:#c9d1d9"><h3 style="color:#f77f00">⏰ cron</h3>
      <pre style="background:transparent;color:#c9d1d9">0 9 * * *  /usr/bin/python3 /home/jose/cumple/004-enviar correo.py</pre>
    </div>
    <ul class="files"><li>001-direccion de la hoja de calculo.py</li><li>004-enviar correo.py</li><li>post.md</li></ul>
    """,
)

# ---------- 022 Me gustan los PDF ----------
MOCKS["dam-022-me-gustan-pdf"] = dict(
    title="Me gustan los PDF",
    h1="📄 PDF Studio",
    palette=pal("#d32f2f", "#ff9800", bg="#fff8f6"),
    subtitle="Suite SaaS de utilidades sobre documentos",
    stack="Python · pypdf · Pillow · python-docx · PHP",
    body="""
    <div class="grid grid-3">
      <div class="card"><h3>✂️ Dividir PDF</h3><p style="font-size:12px;color:var(--muted)">001-dividir.py</p></div>
      <div class="card"><h3>🔗 Unir PDFs</h3><p style="font-size:12px;color:var(--muted)">Drag&amp;drop multi-archivo</p></div>
      <div class="card"><h3>🖼️ PDF → IMG</h3><p style="font-size:12px;color:var(--muted)">PNG/JPG por página</p></div>
      <div class="card"><h3>📷 IMG → PDF</h3><p style="font-size:12px;color:var(--muted)">Pillow</p></div>
      <div class="card"><h3>📝 DOCX → PDF</h3><p style="font-size:12px;color:var(--muted)">python-docx + libreoffice</p></div>
      <div class="card"><h3>🔄 JSON ↔ CSV</h3><p style="font-size:12px;color:var(--muted)">conversor bidireccional</p></div>
    </div>
    <div class="card" style="margin-top:14px;text-align:center;border:2px dashed #d32f2f;padding:30px">
      ⬇️ Arrastra aquí tu archivo o haz click<br>
      <span style="color:var(--muted);font-size:12px">soportado: .pdf .docx .jpg .png .json .csv</span>
    </div>
    <ul class="files"><li>001-dividir.py</li><li>005-php llama a python.php</li><li>aplicacion/</li><li>index.html</li></ul>
    """,
)

# ---------- 023 Varias IA ----------
MOCKS["dam-023-varias-ia"] = dict(
    title="Varias IA en un mismo proyecto",
    h1="🧠 Orquestador multi-IA",
    palette=pal("#2e8b57", "#a8e6cf", bg="#f0faf4"),
    subtitle="Pipeline en paralelo: generador, revisor y resumen",
    stack="Ollama qwen2.5 · codellama · gemma · Python",
    body="""
    <div class="row">
      <div class="card"><h3>1️⃣ qwen2.5</h3>
        <span class="tag">generador</span>
        <pre>"Escribe un fizzbuzz en Python"</pre>
        <div style="color:var(--muted);font-size:12px">→ produce código inicial</div>
      </div>
      <div class="card"><h3>2️⃣ codellama</h3>
        <span class="tag">revisor</span>
        <pre>"Revisa este código y mejora estilo"</pre>
        <div style="color:var(--muted);font-size:12px">→ refactoriza, añade tipos</div>
      </div>
      <div class="card"><h3>3️⃣ gemma</h3>
        <span class="tag">resumen</span>
        <pre>"Resume en 3 bullets para README"</pre>
        <div style="color:var(--muted);font-size:12px">→ documentación final</div>
      </div>
    </div>
    <div class="card" style="margin-top:14px">
      <h3>📦 resultado.md (preview)</h3>
      <pre># FizzBuzz
- Implementación lineal O(n)
- Tipado con int y str
- Tests en /tests</pre>
    </div>
    <ul class="files"><li>001-repaso.md</li><li>008-fusion de proyectos.py</li><li>programacion.txt</li><li>resultado.md</li></ul>
    """,
)

# ---------- 024 Formularios condicionales ----------
MOCKS["dam-024-formularios-condicionales"] = dict(
    title="Formularios condicionales",
    h1="🧩 DSL de formularios",
    palette=pal("#1d3557", "#e63946", bg="#f1faee"),
    subtitle="Sintaxis propia [type][required][case] que se compila a HTML",
    stack="PHP · HTML · JS · DSL custom",
    body="""
    <div class="row">
      <div class="card"><h3>📝 DSL fuente</h3>
        <pre>nombre: [text][req]
edad: [num][req][min=0]
es_socio: [bool]
  if es_socio==true:
    fecha_alta: [date][req]
    descuento: [select=10,20,30]
comentarios: [textarea]</pre>
      </div>
      <div class="card"><h3>👀 Preview formulario</h3>
        <label style="display:block;font-size:12px;margin-top:6px">Nombre*<input style="width:100%;padding:5px;border:1px solid var(--line);border-radius:4px"></label>
        <label style="display:block;font-size:12px;margin-top:6px">Edad*<input type="number" style="width:100%;padding:5px;border:1px solid var(--line);border-radius:4px"></label>
        <label style="display:block;font-size:12px;margin-top:6px"><input type="checkbox" checked> ¿Es socio?</label>
        <div style="background:#fff;border-left:3px solid #e63946;padding:6px 10px;margin-top:6px">
          <label style="display:block;font-size:12px">Fecha de alta*<input type="date" style="width:100%;padding:5px;border:1px solid var(--line);border-radius:4px"></label>
          <label style="display:block;font-size:12px;margin-top:6px">Descuento<select style="width:100%;padding:5px;border:1px solid var(--line);border-radius:4px"><option>10%</option><option>20%</option><option>30%</option></select></label>
        </div>
      </div>
    </div>
    <ul class="files"><li>001-formulario basico.html</li><li>004-carga sintaxis.php</li><li>003-me invento sintaxis.md</li></ul>
    """,
)

# ---------- 025 Multiformularios ----------
MOCKS["dam-025-multiformularios"] = dict(
    title="Multiformularios condicionales",
    h1="📋 Plataforma de formularios",
    palette=pal("#345995", "#fb8b24", bg="#f5f7fb"),
    subtitle="Login + admin CRUD + vista pública multitenant",
    stack="PHP · SQLite · sesiones · roles admin/editor",
    body="""
    <div class="row">
      <div class="card" style="max-width:240px">
        <h3>🔐 Login</h3>
        <input placeholder="usuario" style="width:100%;padding:5px;margin:4px 0;border:1px solid var(--line);border-radius:4px">
        <input placeholder="contraseña" type="password" style="width:100%;padding:5px;margin:4px 0;border:1px solid var(--line);border-radius:4px">
        <button style="width:100%;background:#345995;color:#fff;border:0;padding:6px;border-radius:4px">Entrar</button>
      </div>
      <div class="card"><h3>👑 Admin · Tabs</h3>
        <div style="display:flex;gap:6px;margin-bottom:8px">
          <span class="pill" style="background:#345995">Usuarios</span>
          <span class="pill" style="background:#fb8b24">Formularios</span>
          <span class="pill" style="background:#888">Respuestas</span>
        </div>
        <table>
          <tr><th>usuario</th><th>rol</th><th>forms</th></tr>
          <tr><td>jose</td><td>admin</td><td>14</td></tr>
          <tr><td>cliente1</td><td>editor</td><td>3</td></tr>
          <tr><td>cliente2</td><td>editor</td><td>7</td></tr>
        </table>
      </div>
      <div class="card"><h3>🌐 Vista pública</h3>
        <div style="font-size:13px;color:var(--muted)">El cliente entra y rellena el formulario que ha creado el editor. No ve el panel admin.</div>
      </div>
    </div>
    <ul class="files"><li>admin/</li><li>data/</li><li>inc/</li><li>index.php · init.php</li></ul>
    """,
)

# ---------- 026 Resumen publicación ----------
MOCKS["dam-026-resumen-publicacion"] = dict(
    title="Resumen de publicación en servidores",
    h1="📖 Guía de despliegue",
    palette=pal("#2c3e50", "#16a085", bg="#1c2229", card="#262d36", fg="#e8edf2", muted="#9aa6b3", line="#36404c"),
    subtitle="8 documentos markdown unificados en guía con TOC + scroll-spy",
    stack="HTML · CSS scroll-spy · Markdown",
    body="""
    <div class="row">
      <aside class="card" style="max-width:230px">
        <h3>TOC</h3>
        <ol style="padding-left:18px;font-size:13px;line-height:1.9;color:var(--muted)">
          <li>Servidor</li>
          <li style="color:#16a085;font-weight:700">VirtualHost de jocarsa ◄</li>
          <li>Apache mod_rewrite</li>
          <li>Flask + gunicorn</li>
          <li>Proxy inverso</li>
          <li>HTTPS Let's Encrypt</li>
          <li>Resumen contrataciones</li>
        </ol>
      </aside>
      <div class="card">
        <h3>2 · VirtualHost de jocarsa</h3>
        <pre>&lt;VirtualHost *:80&gt;
  ServerName jocarsa.com
  DocumentRoot /var/www/jocarsa
  ErrorLog ${APACHE_LOG_DIR}/jocarsa-error.log
&lt;/VirtualHost&gt;</pre>
        <p style="font-size:13px;color:var(--muted)">Habilitar con <code>a2ensite jocarsa</code> y recargar Apache.</p>
      </div>
    </div>
    <ul class="files"><li>001-Servidor.md</li><li>002-virtualhost de jocarsa.md</li><li>007-resumen de contrataciones.md</li></ul>
    """,
)

# ---------- 027 Panel de ventas ----------
MOCKS["dam-027-panel-ventas"] = dict(
    title="Panel de control de ventas",
    h1="💼 Panel de ventas",
    palette=pal("#27ae60", "#2c3e50", bg="#f6fbf8"),
    subtitle="CRUD de pagos + KPIs + resumen diario generado por IA",
    stack="PHP · SQLite · Ollama · SVG",
    body="""
    <div class="kpi">
      <div class="k"><b>14.820 €</b><span>Facturado mes</span></div>
      <div class="k"><b>87</b><span>Pagados</span></div>
      <div class="k"><b>14</b><span>Pendientes</span></div>
      <div class="k"><b>3</b><span>Cancelados</span></div>
    </div>
    <div class="row" style="margin-top:14px">
      <div class="card"><h3>📋 Transacciones</h3>
        <table>
          <tr><th>cliente</th><th>importe</th><th>estado</th></tr>
          <tr><td>BigCorp SL</td><td>2.400 €</td><td><span class="pill" style="background:#27ae60">pagado</span></td></tr>
          <tr><td>StartupY</td><td>820 €</td><td><span class="pill" style="background:#f39c12">pendiente</span></td></tr>
          <tr><td>WebShop</td><td>1.250 €</td><td><span class="pill" style="background:#27ae60">pagado</span></td></tr>
          <tr><td>OldClient</td><td>340 €</td><td><span class="pill" style="background:#c0392b">cancelado</span></td></tr>
        </table>
      </div>
      <div class="card"><h3>🤖 Resumen del día</h3>
        <button style="background:#27ae60;color:#fff;border:0;padding:6px 12px;border-radius:4px">Generar con IA</button>
        <p style="font-size:13px;color:var(--muted);margin-top:8px">"Hoy se han facturado 3.470 €, con 4 transacciones nuevas y 1 incidencia en StartupY pendiente desde hace 7 días. Sugerencia: enviar recordatorio."</p>
      </div>
    </div>
    <ul class="files"><li>post.md</li><li>panel/</li></ul>
    """,
)

# ---------- 028 Geolocalización ----------
MOCKS["dam-028-geolocalizacion"] = dict(
    title="Geolocalización",
    h1="🗺️ Mapa + ubicación",
    palette=pal("#1d8348", "#3388ff", bg="#f0f8f4"),
    subtitle="Geolocation API + Leaflet + OpenStreetMap (sin Google)",
    stack="JS · Geolocation API · Leaflet · OSM",
    body="""
    <div class="card" style="padding:0;overflow:hidden;height:340px;background:linear-gradient(135deg,#a8d5ba,#cfe8d8);position:relative">
      <div style="position:absolute;top:30%;left:48%;font-size:36px">📍</div>
      <div style="position:absolute;bottom:14px;left:14px;background:rgba(255,255,255,.95);padding:8px 12px;border-radius:6px;font-size:13px">
        <b>Tu ubicación</b><br>
        lat: 40.4168<br>
        lon: -3.7038<br>
        precisión: ±20 m
      </div>
      <div style="position:absolute;top:14px;right:14px;background:rgba(255,255,255,.95);padding:6px 10px;border-radius:4px;font-size:12px">🌍 © OpenStreetMap</div>
    </div>
    <div class="card" style="margin-top:12px">
      <pre>navigator.geolocation.getCurrentPosition(pos =&gt; {
  const map = L.map('map').setView([pos.coords.latitude, pos.coords.longitude], 15);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
  L.marker([pos.coords.latitude, pos.coords.longitude]).addTo(map);
});</pre>
    </div>
    <ul class="files"><li>001-geoloc.html</li><li>002-openstreetmapapi.html</li><li>003-geolocalizacion y mapa.html</li><li>aplicacion/</li></ul>
    """,
)

# ---------- 030 Scrapear con IA ----------
MOCKS["dam-030-scrapear-web-ia"] = dict(
    title="Scrapear web con IA",
    h1="🕸️ Scraper semántico",
    palette=pal("#e85d04", "#03071e", bg="#fff8f0"),
    subtitle="HTML → LLM con esquema JSON → datos estructurados sin selectores",
    stack="Python · requests · readability · Ollama · pydantic",
    body="""
    <div class="row">
      <div class="card"><h3>1 · HTML crudo</h3>
        <pre>&lt;h1&gt;iPhone 15 Pro&lt;/h1&gt;
&lt;span&gt;1.299 €&lt;/span&gt;
&lt;p&gt;Cámara de 48 Mpx,
chip A17 Pro&lt;/p&gt;</pre>
      </div>
      <div class="card"><h3>2 · Prompt + schema</h3>
        <pre>schema = {
  "producto": str,
  "precio_eur": float,
  "specs": list[str]
}</pre>
      </div>
      <div class="card"><h3>3 · JSON estructurado</h3>
        <pre>{
  "producto":"iPhone 15 Pro",
  "precio_eur":1299.0,
  "specs":[
    "Cámara 48 Mpx",
    "Chip A17 Pro"
  ]
}</pre>
      </div>
    </div>
    <p style="color:var(--muted);font-size:13px;margin-top:10px">Sin escribir selectores CSS: el LLM entiende el contenido y lo encaja en pydantic.</p>
    <ul class="files"><li>001-libreria requests.py</li><li>003-peticion ollama.py</li><li>004-todo junto.py</li></ul>
    """,
)

# ---------- 031 Multimodales ----------
MOCKS["dam-031-modelos-multimodales"] = dict(
    title="Modelos multimodales",
    h1="🎭 Suite multimodal",
    palette=pal("#6a1b9a", "#ec407a", bg="#faf5fc"),
    subtitle="Texto, visión e imagen contra Ollama remoto",
    stack="Ollama qwen2.5 · llava/qwen-vl · sdxl/flux · Python",
    body="""
    <div style="display:flex;gap:0;border-bottom:2px solid var(--line);margin-bottom:14px">
      <div style="padding:8px 16px;background:#6a1b9a;color:#fff;font-weight:700">📝 Texto</div>
      <div style="padding:8px 16px;color:var(--muted)">👁️ Visión</div>
      <div style="padding:8px 16px;color:var(--muted)">🎨 Imagen</div>
    </div>
    <div class="row">
      <div class="card"><h3>📝 Tab Texto</h3>
        <textarea style="width:100%;padding:6px;border:1px solid var(--line);border-radius:4px" rows="3">Explícame qué es un grafo dirigido.</textarea>
        <button style="margin-top:6px;background:#6a1b9a;color:#fff;border:0;padding:6px 14px;border-radius:4px">Preguntar</button>
        <p style="font-size:13px;color:var(--muted);margin-top:6px">→ qwen2.5 responde con definición y ejemplo.</p>
      </div>
      <div class="card"><h3>👁️ Tab Visión</h3>
        <div style="background:#ec407a;height:80px;border-radius:6px;display:flex;align-items:center;justify-content:center;color:#fff">📷 imagen subida</div>
        <p style="font-size:13px;color:var(--muted);margin-top:6px">→ llava describe la escena.</p>
      </div>
      <div class="card"><h3>🎨 Tab Imagen</h3>
        <input placeholder="cyberpunk dragon, neon" style="width:100%;padding:5px;border:1px solid var(--line);border-radius:4px">
        <div style="background:linear-gradient(135deg,#6a1b9a,#ec407a);height:80px;margin-top:6px;border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:30px">🐉</div>
      </div>
    </div>
    <ul class="files"><li>001-qwen multimodal.py</li><li>002-ollama vision con webcam.py</li><li>008-texto.html · 009-vision.html · 010-imagen.html</li></ul>
    """,
)

# ---------- 032 RAG ----------
MOCKS["dam-032-rag"] = dict(
    title="RAG",
    h1="📚 Buscador RAG sobre apuntes",
    palette=pal("#0288d1", "#03a9f4", bg="#f0f9ff"),
    subtitle="ChromaDB + embeddings + LLM con citas verificables",
    stack="ChromaDB · nomic-embed-text · Ollama qwen2.5 · Flask",
    body="""
    <div class="card">
      <input value="¿qué es una restricción FOREIGN KEY?" style="width:100%;padding:8px;border:1px solid var(--line);border-radius:4px;font-size:14px">
      <button style="margin-top:8px;background:#0288d1;color:#fff;border:0;padding:6px 14px;border-radius:4px">Buscar</button>
    </div>
    <div class="card" style="margin-top:12px;border-left:4px solid #0288d1">
      <h3>🤖 Respuesta</h3>
      <p style="font-size:14px">Una <b>FOREIGN KEY</b> es una restricción de integridad referencial que obliga a que el valor de una columna exista como clave primaria en otra tabla [1][2].</p>
      <div style="background:#e3f2fd;padding:8px;border-radius:4px;font-size:12px;color:var(--muted)">
        ⏱ 1.4s · embeddings: 0.3s · LLM: 1.1s · 0 alucinaciones
      </div>
    </div>
    <h3 style="margin-top:14px;color:var(--primary)">Fuentes</h3>
    <div class="row">
      <div class="card" style="background:#e1f5fe"><h3>[1] sql-bd.md</h3><p style="font-size:12px">"La cláusula FOREIGN KEY referencia la PK de otra tabla…"</p></div>
      <div class="card" style="background:#e1f5fe"><h3>[2] integridad.md</h3><p style="font-size:12px">"…garantiza que no exista una huérfana en la tabla hija."</p></div>
    </div>
    <ul class="files"><li>001-ollama perro.md</li><li>009-guardo en chromadb.py</li><li>012-RAG e IA.py</li><li>chroma_db/</li></ul>
    """,
)

# ---------- 033 LMS ----------
MOCKS["dam-033-nan"] = dict(
    title="LMS centro FP",
    h1="🎓 LMS DAM",
    palette=pal("#003566", "#ffc300", bg="#f5f8fc"),
    subtitle="LMS con módulos, usuarios, matrículas y calificaciones (3NF)",
    stack="PHP · SQLite · SQL 3NF",
    body="""
    <div class="kpi">
      <div class="k"><b>147</b><span>Alumnos</span></div>
      <div class="k"><b>12</b><span>Profesores</span></div>
      <div class="k"><b>24</b><span>Módulos</span></div>
      <div class="k"><b>1.842</b><span>Calificaciones</span></div>
    </div>
    <div class="row" style="margin-top:14px">
      <div class="card"><h3>📊 Matrículas por curso</h3>
        <table>
          <tr><th>módulo</th><th>matriculados</th></tr>
          <tr><td>Bases de datos</td><td>47</td></tr>
          <tr><td>Programación</td><td>52</td></tr>
          <tr><td>Sist. informáticos</td><td>38</td></tr>
          <tr><td>Entornos de desarrollo</td><td>41</td></tr>
        </table>
      </div>
      <div class="card"><h3>🧱 Esquema</h3>
        <pre>usuarios(id, nombre, rol)
modulos(id, nombre, ects)
matriculas(id_user, id_mod, curso)
calificaciones(id_mat, nota, fecha)</pre>
      </div>
    </div>
    <ul class="files"><li>003-esquema.sql</li><li>004-dam_datos_muestra_sqlite.sql</li><li>006-lmsv1/</li></ul>
    """,
)

# ---------- 034 Mini PowerPoint ----------
MOCKS["dam-034-mini-powerpoint"] = dict(
    title="Mini PowerPoint",
    h1="🎞️ Slide deck en HTML",
    palette=pal("#000", "#ffd60a", bg="#fff", card="#fafafa"),
    subtitle="Cada slide es un <article>, navegación scroll-snap + teclado",
    stack="HTML · CSS scroll-snap · JS · localStorage",
    body="""
    <div class="row">
      <div class="card" style="background:#000;color:#fff;min-height:200px;display:flex;flex-direction:column;justify-content:center;align-items:center;text-align:center">
        <div style="font-size:34px;font-weight:900">Bienvenidos</div>
        <div style="opacity:.7;margin-top:6px">a la presentación interactiva</div>
        <div style="margin-top:14px;background:#ffd60a;color:#000;padding:2px 10px;border-radius:99px;font-size:11px">slide 1/10</div>
      </div>
      <div class="card" style="background:#fff;border:2px dashed #000;min-height:200px;display:flex;flex-direction:column;justify-content:center;align-items:center;text-align:center">
        <div style="font-size:30px;font-weight:900">¿Cómo navegar?</div>
        <ul style="text-align:left;margin-top:8px">
          <li>⌨️ <b>↑/↓</b> entre slides</li>
          <li>🖱️ Scroll con rueda</li>
          <li>💾 Estado en localStorage</li>
        </ul>
      </div>
    </div>
    <ul class="files"><li>001-inicio.html</li><li>002-estilo.html</li><li>009-ajustes visuales.html</li><li>presentacion.txt</li></ul>
    """,
)

# ---------- 035 Bullets ----------
MOCKS["dam-035-bullets"] = dict(
    title="Bullets",
    h1="• Texto → bullets",
    palette=pal("#2e7d32", "#66bb6a", bg="#f5fbf6"),
    subtitle="Convierte texto desordenado en lista jerárquica limpia",
    stack="HTML · JavaScript",
    body="""
    <div class="row">
      <div class="card"><h3>📥 Entrada (libre)</h3>
        <textarea style="width:100%;padding:8px;border:1px solid var(--line);border-radius:4px;font-family:ui-monospace,monospace" rows="9">comprar pan
comprar leche
   tareas casa
      barrer
      fregar
   pasear perro
llamar madre</textarea>
      </div>
      <div class="card"><h3>📤 Salida bullets</h3>
        <ul style="font-size:14px;line-height:1.8">
          <li>comprar pan</li>
          <li>comprar leche</li>
          <li>tareas casa
            <ul><li>barrer</li><li>fregar</li><li>pasear perro</li></ul>
          </li>
          <li>llamar madre</li>
        </ul>
        <div style="margin-top:10px;display:flex;gap:6px">
          <span class="pill">disco</span>
          <span class="pill" style="background:#66bb6a">guion</span>
          <span class="pill" style="background:#888">numerado</span>
        </div>
      </div>
    </div>
    <ul class="files"><li>001-inicio.html</li><li>002-estilo.html</li><li>post.md</li></ul>
    """,
)

# ---------- 037 Creador de esquemas ----------
MOCKS["dam-037-creador-esquemas"] = dict(
    title="Creador de esquemas",
    h1="✏️ Editor SVG de diagramas",
    palette=pal("#e76f51", "#264653", bg="#fdfaf6"),
    subtitle="Nodos, texto y flechas exportables a SVG",
    stack="SVG · JavaScript · HTML+CSS",
    body="""
    <div class="row">
      <aside class="card" style="max-width:130px">
        <h3>🎨 Paleta</h3>
        <div style="display:flex;flex-direction:column;gap:6px;font-size:13px">
          <div style="background:#264653;color:#fff;padding:6px;border-radius:4px;text-align:center">▭ Rect</div>
          <div style="background:#e76f51;color:#fff;padding:6px;border-radius:50%;text-align:center">● Círculo</div>
          <div style="background:#f4a261;color:#fff;padding:6px;text-align:center;clip-path:polygon(50% 0,100% 100%,0 100%)">▲ Triáng.</div>
          <div style="background:#fff;border:1px dashed #ccc;padding:6px;text-align:center">→ Flecha</div>
          <div style="background:#fff;border:1px solid var(--line);padding:6px;text-align:center">T Texto</div>
        </div>
      </aside>
      <div class="card" style="background:#fff;min-height:280px;position:relative">
        <div style="position:absolute;top:30px;left:30px;background:#264653;color:#fff;padding:10px 22px;border-radius:6px">Inicio</div>
        <div style="position:absolute;top:140px;left:200px;background:#e76f51;color:#fff;padding:14px;border-radius:50%;width:80px;height:80px;text-align:center;display:flex;align-items:center;justify-content:center">¿Login?</div>
        <div style="position:absolute;top:30px;right:30px;background:#264653;color:#fff;padding:10px 22px;border-radius:6px">Panel</div>
        <div style="position:absolute;bottom:20px;right:30px;background:#264653;color:#fff;padding:10px 22px;border-radius:6px">Fin</div>
      </div>
    </div>
    <ul class="files"><li>001-svg.html</li><li>004-esquema svg.html</li><li>009-formas basicas.html</li></ul>
    """,
)

# ---------- 029 + 036 placeholders ----------
PENDIENTE_BODY = """
    <div class="card" style="border:2px dashed #888;text-align:center;padding:40px">
      <div style="font-size:42px">⚠️</div>
      <h3 style="margin-top:8px;color:var(--primary)">Proyecto pendiente de desarrollo</h3>
      <p style="color:var(--muted)">Esta tarjeta queda reservada. El proyecto se documentará e implementará durante el resto de la 3ª evaluación.</p>
    </div>
"""

MOCKS["dam-029-api-rotation"] = dict(
    title="API rotation",
    h1="🔄 API rotation",
    palette=pal("#555", "#aaa", bg="#f4f4f4"),
    subtitle="Pendiente · rotación segura de claves de API",
    stack="por definir",
    body=PENDIENTE_BODY,
)
MOCKS["dam-036-mcp-ollama-blender"] = dict(
    title="MCP Ollama + Blender",
    h1="🧩 MCP Ollama Blender",
    palette=pal("#555", "#aaa", bg="#f4f4f4"),
    subtitle="Pendiente · puente MCP para que un LLM controle Blender",
    stack="MCP · Ollama · Blender (por integrar)",
    body=PENDIENTE_BODY,
)

# ---------- Escritura ----------
def main():
    written = []
    for slug, spec in MOCKS.items():
        target = ROOT / slug / "index.html"
        if not target.parent.exists():
            print(f"⚠️  no existe carpeta: {target.parent}")
            continue
        html = shell(
            slug=slug,
            title=spec["title"],
            palette=spec["palette"],
            h1=spec["h1"],
            subtitle=spec["subtitle"],
            stack=spec["stack"],
            body=spec["body"],
        )
        target.write_text(html, encoding="utf-8")
        written.append(slug)
    print(f"✅ regenerados {len(written)} mockups")
    for s in written:
        print(f"   · {s}")

if __name__ == "__main__":
    main()
