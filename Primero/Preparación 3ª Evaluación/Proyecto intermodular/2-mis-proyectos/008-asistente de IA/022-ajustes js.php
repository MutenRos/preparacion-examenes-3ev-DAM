<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Chatbot</title>

<!-- A-Frame -->
<script src="https://aframe.io/releases/1.6.0/aframe.min.js"></script>

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
  padding:0;
  display:flex;
  align-items:stretch;
  justify-content:stretch;
  overflow:hidden;
}
#aframebox{width:100%;height:100%;}
#aframebox a-scene{width:100%;height:100%;}
/* hide A-Frame VR/UI buttons */
.a-enter-vr-button, .a-fullscreen-button { display:none !important; }

form{
  display:flex;
  gap:8px;
  align-items:center;
}
input[type=text]{
  flex:1;
  padding:10px;
  border:1px solid #ccc;
  border-radius:10px;
}
select#voice{
  max-width:260px;
  padding:10px;
  border:1px solid #ccc;
  border-radius:10px;
  background:#fff;
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
  aside.avatar{ width:auto; max-width:none; min-height:260px; }
  select#voice{ max-width:none; width:100%; }
  form{ flex-wrap:wrap; }
}
</style>
</head>
<body>

<?php
function h(string $s): string {
  return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Limpieza mínima para HTML del LLM:
 * - quita fences
 * - elimina <script>
 * - elimina on*=
 * - elimina javascript: en href/src
 */
function sanitize_llm_html(string $html): string {
  $html = preg_replace('/```(?:html)?/i', '', $html);
  $html = str_replace('```', '', $html);

  $html = preg_replace('~<\s*script\b[^>]*>.*?<\s*/\s*script\s*>~is', '', $html);
  $html = preg_replace('/\son\w+\s*=\s*(?:"[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $html);
  $html = preg_replace('/\s(href|src)\s*=\s*(["\'])\s*javascript:[^"\']*\2/i', ' $1="#"', $html);

  $html = trim($html);
  if ($html === '') $html = '<p>Sin respuesta</p>';
  return $html;
}

$respuesta = "";

if (isset($_GET["mensaje"]) && trim((string)$_GET["mensaje"]) !== "") {

  $mensaje = trim((string)$_GET["mensaje"]);

  $sistema = "
-No devuelvas markdown. Devuelve HTML.
-Reduce tu respuesta a dos o tres párrafos.
-No pongas fences markdown en tu respuesta.
-No uses <script> ni atributos on*.
-Atiende a la siguiente petición por parte del usuario:
";

  $datos = [
    "model" => "ministral-3:3b",
    "prompt" => $sistema . $mensaje,
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
    $respuesta = sanitize_llm_html((string)$raw);
  }
}
?>

<main>
  <div class="split">
    <section id="respuesta"><?php echo $respuesta; ?></section>

    <aside class="avatar" aria-label="Avatar 3D">
      <div id="aframebox">
        <a-scene embedded background="color: #ffffff" renderer="antialias:true">
          <a-assets>
            <a-asset-item id="avatar" src="avatar.glb"></a-asset-item>
          </a-assets>

          <a-entity light="type: directional; intensity: 1" position="2 4 2"></a-entity>
          <a-entity light="type: ambient; intensity: 0.5"></a-entity>

          <a-plane rotation="-90 0 0" width="10" height="10" color="#cccccc"></a-plane>

          <a-entity
            id="avatarModel"
            gltf-model="#avatar"
            position="0 1 -2"
            scale="2 2 2">
          </a-entity>

          <a-entity position="0 0.5 0.5">
            <a-camera fov="45"></a-camera>
          </a-entity>
        </a-scene>
      </div>
    </aside>
  </div>

  <small id="srstatus"></small>

  <form action="?" method="GET">
    <input id="mensaje" type="text" name="mensaje" placeholder="Escribe tu mensaje..." autocomplete="off"
      value="<?php echo isset($_GET['mensaje']) ? h((string)$_GET['mensaje']) : ''; ?>">

    <select id="voice" title="Voz"></select>

    <button id="mic" class="mic" type="button" aria-pressed="false" title="Dictar">🎤</button>
    <button id="spk" class="spk" type="button" aria-pressed="false" title="Leer respuesta">🔊</button>
  </form>
</main>

<script>
(() => {

  // =========================================================
  // A-Frame: rotate ONLY internal mesh named "avatar"
  // and animate morph target "A" with a sine loop
  // =========================================================
  AFRAME.registerComponent("avatar-mesh-anim", {
    schema: {
      meshName: { type: "string", default: "avatar" }, // internal mesh name in the GLB
      morphName:{ type: "string", default: "A" },      // shape key / blendshape name
      rotAmpX:  { type: "number", default: 4 },        // degrees
      rotAmpY:  { type: "number", default: 5 },        // degrees
      rotAmpZ:  { type: "number", default: 3 },        // degrees
      rotSpeed: { type: "number", default: 1.0 },      // multiplier
      morphSpeed:{ type:"number", default: 2.0 }       // multiplier
    },

    init: function () {
      this.targetMesh = null;
      this.morphIndex = -1;

      // Wait until the GLB is actually loaded
      this.el.addEventListener("model-loaded", () => {
        const root = this.el.getObject3D("mesh");
        if (!root) return;

        // Find the mesh by exact name
        root.traverse((obj) => {
          if (!this.targetMesh && obj.isMesh && obj.name === this.data.meshName) {
            this.targetMesh = obj;

            // Find morph target index by name (if available)
            if (obj.morphTargetDictionary && typeof obj.morphTargetDictionary[this.data.morphName] === "number") {
              this.morphIndex = obj.morphTargetDictionary[this.data.morphName];
            }
          }
        });
      });
    },

    tick: function (timeMs) {
      if (!this.targetMesh) return;

      const t = (timeMs || 0) / 1000;

      // Rotate ONLY the internal mesh
      const deg2rad = Math.PI / 180;
      const rx = Math.sin(t * 0.8 * this.data.rotSpeed) * this.data.rotAmpX * deg2rad;
      const ry = Math.sin(t * 1.1 * this.data.rotSpeed) * this.data.rotAmpY * deg2rad;
      const rz = Math.sin(t * 0.6 * this.data.rotSpeed) * this.data.rotAmpZ * deg2rad;

      this.targetMesh.rotation.set(rx, ry, rz);

      // Animate morph target "A" with sine: 0..1..0..1...
      if (this.morphIndex >= 0 && this.targetMesh.morphTargetInfluences) {
        const w = (Math.sin(t * this.data.morphSpeed) + 1) * 0.5; // 0..1
        this.targetMesh.morphTargetInfluences[this.morphIndex] = w;
      }
    }
  });

  // Attach component to your entity that loads the GLB
  window.addEventListener("load", () => {
    const avatarEntity = document.querySelector("#avatarModel");
    if (avatarEntity) {
      avatarEntity.setAttribute("avatar-mesh-anim", "meshName: avatar; morphName: A;");
    }
  });

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

  // ---------- Speech synthesis ----------
  const btnSpk = document.getElementById("spk");
  const respuestaEl = document.getElementById("respuesta");
  const voiceSel = document.getElementById("voice");

  const norm = s => (s || "").toLowerCase();

  function stripHtmlToText(html) {
    const div = document.createElement("div");
    div.innerHTML = html;
    return (div.textContent || div.innerText || "").trim();
  }

  function getSpanishVoices() {
    const voices = (window.speechSynthesis && speechSynthesis.getVoices) ? speechSynthesis.getVoices() : [];
    return voices.filter(v => norm(v.lang).startsWith("es"));
  }

  function bestFemaleSpanishVoice(voices) {
    const femaleHints = ["female","mujer","femen","woman","chica","girl"];
    let v = voices.find(v => femaleHints.some(h => norm(v.name).includes(h)));
    if (v) return v;
    v = voices.find(v => norm(v.lang) === "es-es");
    if (v) return v;
    return voices[0] || null;
  }

  function populateVoiceSelect() {
    voiceSel.innerHTML = "";

    if (!("speechSynthesis" in window)) {
      const opt = document.createElement("option");
      opt.value = "";
      opt.textContent = "TTS no soportado";
      voiceSel.appendChild(opt);
      voiceSel.disabled = true;
      return;
    }

    const voices = getSpanishVoices();

    if (voices.length === 0) {
      const opt = document.createElement("option");
      opt.value = "";
      opt.textContent = "No hay voces es-*";
      voiceSel.appendChild(opt);
      voiceSel.disabled = true;
      return;
    }

    voiceSel.disabled = false;

    for (const v of voices) {
      const opt = document.createElement("option");
      opt.value = `${v.name}|||${v.lang}`;
      opt.textContent = `${v.name} (${v.lang})`;
      voiceSel.appendChild(opt);
    }

    const saved = localStorage.getItem("tts_voice");
    if (saved) {
      const found = [...voiceSel.options].some(o => o.value === saved);
      if (found) { voiceSel.value = saved; return; }
    }

    const best = bestFemaleSpanishVoice(voices);
    if (best) {
      const key = `${best.name}|||${best.lang}`;
      voiceSel.value = key;
      localStorage.setItem("tts_voice", key);
    }
  }

  function resolveSelectedVoice() {
    const key = voiceSel.value || "";
    const [name, lang] = key.split("|||");
    const voices = getSpanishVoices();
    return voices.find(v => v.name === name && v.lang === lang) || null;
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

    const v = resolveSelectedVoice();
    if (v) u.voice = v;

    u.onstart = () => btnSpk.setAttribute("aria-pressed","true");
    u.onend   = () => btnSpk.setAttribute("aria-pressed","false");
    u.onerror = () => btnSpk.setAttribute("aria-pressed","false");

    speechSynthesis.speak(u);
  }

  voiceSel.addEventListener("change", () => {
    localStorage.setItem("tts_voice", voiceSel.value);
  });

  function initVoices() {
    if (!("speechSynthesis" in window)) return;
    speechSynthesis.getVoices();
    populateVoiceSelect();
  }

  if ("speechSynthesis" in window) {
    speechSynthesis.onvoiceschanged = initVoices;
    initVoices();
  } else {
    populateVoiceSelect();
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
