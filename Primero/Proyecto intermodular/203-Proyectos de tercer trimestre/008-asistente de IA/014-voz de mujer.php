<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Chatbot</title>
<style>
*{box-sizing:border-box;}
body{margin:0;font-family:Arial;background:#f5f5f5;}
main{
  max-width:960px;
  margin:auto;
  height:100vh;
  padding:16px;
  display:flex;
  flex-direction:column;
  gap:12px;
}
.split{
  flex:1;
  display:flex;
  gap:12px;
  min-height:0;
}
section{
  flex:1;
  background:white;
  border:1px solid #ddd;
  border-radius:10px;
  padding:12px;
  overflow-y:auto;
  text-align:justify;
  min-height:0;
}
aside.avatar{
  width:320px;
  max-width:40%;
  background:white;
  border:1px solid #ddd;
  border-radius:10px;
  padding:12px;
  display:flex;
  align-items:center;
  justify-content:center;
}
aside.avatar img{
  width:100%;
  height:auto;
  display:block;
  border-radius:10px;
}
form{
  display:flex;
  gap:8px;
}
input[type=text]{
  flex:1;
  padding:10px;
  border:1px solid #ccc;
  border-radius:10px;
}
button.mic, button.spk{
  padding:10px 12px;
  border:1px solid #ccc;
  border-radius:10px;
  background:#fff;
  cursor:pointer;
}
button.mic[aria-pressed="true"]{ border-color:#d33; }
button.spk[aria-pressed="true"]{ border-color:#36c; }

small#srstatus{
  display:block;
  color:#666;
  padding:0 2px;
}

@media (max-width: 780px){
  .split{ flex-direction:column; }
  aside.avatar{ width:auto; max-width:none; }
}
</style>
</head>
<body>

<?php

/**
 * Escapa para texto/atributos HTML (cuando NO quieres permitir etiquetas).
 */
function h(string $s): string {
  return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Limpieza mínima para la salida del LLM cuando pedimos HTML:
 * - quita fences markdown
 * - elimina <script>...</script>
 * - elimina inline handlers on*="..."
 * - elimina javascript: en href/src
 *
 * Nota: Esto NO es un sanitizador perfecto, pero evita lo más típico
 * sin romper <p>, <ul>, <li>, <br>, etc.
 */
function sanitize_llm_html(string $html): string {
  // Quitar fences típicos
  $html = preg_replace('/```(?:html)?/i', '', $html);
  $html = str_replace('```', '', $html);

  // Quitar scripts
  $html = preg_replace('~<\s*script\b[^>]*>.*?<\s*/\s*script\s*>~is', '', $html);

  // Quitar onClick/onLoad/etc (inline event handlers)
  $html = preg_replace('/\son\w+\s*=\s*(?:"[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $html);

  // Quitar javascript: en href/src
  $html = preg_replace('/\s(href|src)\s*=\s*(["\'])\s*javascript:[^"\']*\2/i', ' $1="#"', $html);

  // Si viene vacío, al menos algo
  $html = trim($html);
  if ($html === '') $html = '<p>Sin respuesta</p>';

  return $html;
}

$respuesta = "";

if (isset($_GET["mensaje"]) && trim((string)$_GET["mensaje"]) !== "") {

  // Mensaje del usuario: aquí SÍ escapamos, porque se usa como texto en el prompt
  $mensaje = trim((string)$_GET["mensaje"]);
  $mensaje_prompt = $mensaje; // no hace falta HTML escaping para el prompt

  $sistema = "
-No devuelvas markdown. Devuelve HTML.
-Reduce tu respuesta a dos o tres párrafos.
-No pongas fences markdown en tu respuesta.
-No uses <script> ni atributos on*.
-Atiende a la siguiente petición por parte del usuario:
";

  $datos = [
    "model" => "ministral-3:3b",
    "prompt" => $sistema . $mensaje_prompt,
    "stream" => false
  ];

  $ch = curl_init("http://localhost:11434/api/generate");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($datos, JSON_UNESCAPED_UNICODE));
  curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);

  $resultado = curl_exec($ch);
  if ($resultado === false) {
    $respuesta = "<p>Error cURL: " . h(curl_error($ch)) . "</p>";
    curl_close($ch);
  } else {
    curl_close($ch);

    $json = json_decode($resultado, true);
    $raw = $json["response"] ?? "";

    // Sanitizar HTML del modelo (permitimos etiquetas básicas)
    $respuesta = sanitize_llm_html((string)$raw);
  }
}
?>

<main>
  <div class="split">
    <section id="respuesta"><?php echo $respuesta; ?></section>

    <aside class="avatar" aria-label="Avatar">
      <img src="avatar.png" alt="Avatar">
    </aside>
  </div>

  <small id="srstatus"></small>

  <form action="?" method="GET">
    <input id="mensaje" type="text" name="mensaje" placeholder="Escribe tu mensaje..." autocomplete="off"
           value="<?php echo isset($_GET['mensaje']) ? h((string)$_GET['mensaje']) : ''; ?>">
    <button id="mic" class="mic" type="button" aria-pressed="false" title="Dictar">🎤</button>
    <button id="spk" class="spk" type="button" aria-pressed="false" title="Leer respuesta">🔊</button>
  </form>
</main>

<script>
(() => {
  // ---------- Speech recognition ----------
  const input = document.getElementById("mensaje");
  const btnMic = document.getElementById("mic");
  const st = document.getElementById("srstatus");

  const SR = window.SpeechRecognition || window.webkitSpeechRecognition;
  let rec = null;

  if (!SR) {
    st.textContent = "Dictado no soportado en este navegador (usa Chrome/Edge).";
  } else {
    rec = new SR();
    rec.lang = "es-ES";
    rec.interimResults = true;
    rec.continuous = true;

    let finalText = "";

    rec.onstart = () => { btnMic.setAttribute("aria-pressed","true"); st.textContent = "Escuchando..."; };
    rec.onend   = () => { btnMic.setAttribute("aria-pressed","false"); st.textContent = ""; };
    rec.onerror = (e) => { st.textContent = "Error dictado: " + e.error; };

    rec.onresult = (e) => {
      let interim = "";
      for (let i = e.resultIndex; i < e.results.length; i++) {
        const t = e.results[i][0].transcript;
        if (e.results[i].isFinal) finalText += t + " ";
        else interim += t;
      }
      input.value = (finalText + interim).trim();
    };

    btnMic.addEventListener("click", () => {
      const pressed = btnMic.getAttribute("aria-pressed") === "true";
      if (pressed) { rec.stop(); return; }
      finalText = input.value ? (input.value.trim() + " ") : "";
      rec.start();
    });
  }

  // ---------- Speech synthesis (female Spanish voice) ----------
  const btnSpk = document.getElementById("spk");
  const respuestaEl = document.getElementById("respuesta");

  function stripHtmlToText(html) {
    const div = document.createElement("div");
    div.innerHTML = html;
    return (div.textContent || div.innerText || "").trim();
  }

  const norm = s => (s || "").toLowerCase();

  function pickFemaleSpanishVoice() {
    const voices = (window.speechSynthesis && speechSynthesis.getVoices()) ? speechSynthesis.getVoices() : [];

    // 1) Spanish + pistas de femenino en el nombre
    const femaleHints = ["female","mujer","femen","woman","chica","girl"];
    let v = voices.find(v =>
      norm(v.lang).startsWith("es") &&
      femaleHints.some(h => norm(v.name).includes(h))
    );
    if (v) return v;

    // 2) Preferir voces es-ES
    v = voices.find(v => norm(v.lang) === "es-es");
    if (v) return v;

    // 3) Cualquier voz española
    v = voices.find(v => norm(v.lang).startsWith("es"));
    if (v) return v;

    return null;
  }

  function speakAnswer() {
    if (!("speechSynthesis" in window)) return;

    speechSynthesis.cancel();

    const text = stripHtmlToText(respuestaEl.innerHTML);
    if (!text) return;

    const u = new SpeechSynthesisUtterance(text);
    u.lang = "es-ES";
    u.rate = 1;
    u.pitch = 1;

    const v = pickFemaleSpanishVoice();
    if (v) u.voice = v;

    u.onstart = () => btnSpk.setAttribute("aria-pressed","true");
    u.onend   = () => btnSpk.setAttribute("aria-pressed","false");
    u.onerror = () => btnSpk.setAttribute("aria-pressed","false");

    speechSynthesis.speak(u);
  }

  // Cargar voces (asíncrono en algunos navegadores)
  function initVoices() {
    if (!("speechSynthesis" in window)) return;
    speechSynthesis.getVoices();
  }
  if ("speechSynthesis" in window) {
    speechSynthesis.onvoiceschanged = initVoices;
    initVoices();
  }

  btnSpk.addEventListener("click", () => {
    const pressed = btnSpk.getAttribute("aria-pressed") === "true";
    if (pressed) {
      speechSynthesis.cancel();
      btnSpk.setAttribute("aria-pressed","false");
      return;
    }
    speakAnswer();
  });

  // Autoleer si hay respuesta
  const hasAnswer = stripHtmlToText(respuestaEl.innerHTML).length > 0;
  if (hasAnswer && ("speechSynthesis" in window)) {
    setTimeout(speakAnswer, 200);
  }
})();
</script>

</body>
</html>
