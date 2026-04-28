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
  position:relative;
}
#aframebox{width:100%;height:100%;}
#aframebox a-scene{width:100%;height:100%;}
/* hide A-Frame VR/UI buttons */
.a-enter-vr-button, .a-fullscreen-button { display:none !important; }

#debug3d{
  position:absolute;
  left:8px; right:8px; bottom:8px;
  background:rgba(255,255,255,.92);
  border:1px solid #ddd;
  border-radius:10px;
  padding:8px 10px;
  font-size:12px;
  line-height:1.35;
  color:#222;
  max-height:38%;
  overflow:auto;
  pointer-events:none;
  white-space:pre-wrap;
  display:none;
}

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
p{
	font-size:20px;
	font-family:ui-system,ubuntu;
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

      <div id="debug3d">3D debug: cargando…</div>
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

<!-- =========================================================
     A-FRAME: rotation always + mouth only while TTS speaks
========================================================= -->
<script>
(() => {

  AFRAME.registerComponent("auto-avatar-anim", {
    schema: {
      morphName: { type: "string", default: "A" },
      rotAmpDeg: { type: "number", default: 6 },
      rotSpeed:  { type: "number", default: 1.0 },

      // base “dinámica” (antes era seno puro)
      morphSpeed:{ type: "number", default: 7.0 },   // ahora controla el ritmo medio
      jitter:    { type: "number", default: 0.10 },  // micro ruido (0..0.25 aprox)
      smooth:    { type: "number", default: 0.18 },  // suavizado (0..1) más alto = más rápido
      syllableMs:{ type: "number", default: 90 }     // “cambios” tipo sílaba (ms)
    },

    init: function () {
      this.dbg = document.getElementById("debug3d");

      this.root = null;
      this.targetMesh = null;
      this.morphIndex = -1;

      this.mouthActive = false;
      this.mouthBoost  = 1;

      // --- NEW: state for noisy lipsync ---
      this.mouthVal = 0;        // valor actual (suavizado)
      this.mouthTarget = 0;     // objetivo “por sílaba”
      this.lastStepMs = 0;      // último cambio de target
      this.randA = Math.random() * 1000;
      this.randB = Math.random() * 1000;

      // --- NEW: small deterministic-ish noise helpers ---
      const fract = (x) => x - Math.floor(x);
      const hash1 = (x) => fract(Math.sin(x) * 43758.5453123); // 0..1
      const noise1 = (t, seed) => hash1(t * 12.9898 + seed * 78.233); // 0..1

      this._noise1 = noise1;

      const log = (msg) => { if (this.dbg) this.dbg.textContent = msg; };

      this._onTtsStart = () => {
        this.mouthActive = true;
        this.mouthBoost  = 2;
        // reset a bit so it doesn’t start from a weird phase
        this.lastStepMs = 0;
      };

      this._onTtsEnd = () => {
        this.mouthActive = false;
        this.mouthBoost  = 1;
        this.mouthVal = 0;
        this.mouthTarget = 0;
        this._setMouth(0);
      };

      window.addEventListener("tts-start", this._onTtsStart);
      window.addEventListener("tts-end",   this._onTtsEnd);

      window.addEventListener("error", (e) => log("JS error: " + (e.message || e.type)));

      this.el.addEventListener("model-error", (e) => {
        log("model-error: " + (e && e.detail ? JSON.stringify(e.detail) : "unknown"));
      });

      this.el.addEventListener("model-loaded", () => {
        const root = this.el.getObject3D("mesh");
        if (!root) { log("model-loaded but no root mesh"); return; }
        this.root = root;

        const meshes = [];
        root.traverse((obj) => { if (obj.isMesh) meshes.push(obj); });
        if (meshes.length === 0) { log("No meshes found inside GLB"); return; }

        let chosen = null;
        let chosenMorphIndex = -1;

        for (const m of meshes) {
          const dict = m.morphTargetDictionary;
          if (dict && typeof dict[this.data.morphName] === "number") {
            chosen = m;
            chosenMorphIndex = dict[this.data.morphName];
            break;
          }
        }
        if (!chosen) {
          for (const m of meshes) {
            if (m.morphTargetInfluences && m.morphTargetInfluences.length > 0) {
              chosen = m;
              chosenMorphIndex = -1;
              break;
            }
          }
        }
        if (!chosen) chosen = meshes[0];

        this.targetMesh = chosen;
        this.morphIndex = chosenMorphIndex;

        this._setMouth(0);

        const meshNames = meshes.map(m => m.name || "(no-name)").slice(0, 80);
        const dictKeys = chosen.morphTargetDictionary ? Object.keys(chosen.morphTargetDictionary).slice(0, 80) : [];

        let info = "";
        info += "GLB loaded ✅\n";
        info += "Meshes found: " + meshes.length + "\n";
        info += "Mesh names:\n - " + meshNames.join("\n - ") + "\n\n";
        info += "Rotation target: ROOT (all meshes)\n";
        info += "Morph target mesh: " + (chosen.name || "(no-name)") + "\n";
        info += "Morph targets on chosen:\n";
        info += dictKeys.length ? (" - " + dictKeys.join("\n - ")) : " (none)\n";
        info += "\nLooking for morph: " + this.data.morphName + "\n";
        info += "Morph index: " + this.morphIndex + "\n";
        info += "\nMouth anim: pseudo-lipsync (syllable steps + smooth + jitter).";
        log(info);

        if (chosen.material) {
          if (Array.isArray(chosen.material)) chosen.material.forEach(mat => mat && (mat.needsUpdate = true));
          else chosen.material.needsUpdate = true;
        }
      });
    },

    remove: function () {
      window.removeEventListener("tts-start", this._onTtsStart);
      window.removeEventListener("tts-end",   this._onTtsEnd);
    },

    _setMouth: function (value) {
      if (!this.targetMesh) return;
      if (this.morphIndex < 0) return;
      const inf = this.targetMesh.morphTargetInfluences;
      if (!inf || inf.length <= this.morphIndex) return;
      inf[this.morphIndex] = value;
    },

    tick: function (timeMs) {
      if (!this.root) return;

      const t = (timeMs || 0) / 1000;
      const deg2rad = Math.PI / 180;
      const a = this.data.rotAmpDeg * deg2rad;

      // ALWAYS rotate WHOLE model
      this.root.rotation.x = Math.sin(t * 0.8 * this.data.rotSpeed) * a*0.2;
      this.root.rotation.y = Math.sin(t * 1.1 * this.data.rotSpeed) * a*0.2;
      this.root.rotation.z = Math.sin(t * 0.6 * this.data.rotSpeed) * a*0.2;

      // Mouth only while speaking; otherwise force 0
      if (!this.mouthActive) {
        this._setMouth(0);
        return;
      }

      // --- NEW: pseudo lipsync ---
      // “syllable step”: every N ms, pick a new random target (0..1) with bias
      const stepEvery = this.data.syllableMs / this.mouthBoost;
      if (!this.lastStepMs) this.lastStepMs = timeMs || 0;

      if ((timeMs - this.lastStepMs) >= stepEvery) {
        this.lastStepMs = timeMs;

        // base energy driven by morphSpeed (faster -> slightly higher average openness)
        const speed = this.data.morphSpeed * this.mouthBoost;
        const energy = Math.min(1, 0.35 + 0.08 * speed); // clamp-ish

        // random with a bias toward smaller openings (natural)
        // u^2 -> more small values, fewer big ones
        const u = Math.random();
        let target = (u * u) * (0.85 * energy + 0.15);

        // sometimes close mouth briefly (like consonants)
        if (Math.random() < 0.18) target *= 0.15;

        // sometimes open a bit more (like vowels)
        if (Math.random() < 0.20) target = Math.min(1, target + 0.35 * Math.random());

        this.mouthTarget = target;
      }

      // smooth follow (1st order low-pass)
      const s = this.data.smooth; // 0..1
      this.mouthVal += (this.mouthTarget - this.mouthVal) * s;

      // add micro-jitter noise (small, fast, not periodic)
      // combine two cheap noises so it doesn’t “loop”
      const n1 = this._noise1(t * 18.0, this.randA); // 0..1
      const n2 = this._noise1(t * 27.0, this.randB); // 0..1
      const jitter = ((n1 * 0.6 + n2 * 0.4) - 0.5) * 2; // -1..1

      const out = Math.max(0, Math.min(1, this.mouthVal + jitter * this.data.jitter));
      this._setMouth(out);
    }
  });

  window.addEventListener("DOMContentLoaded", () => {
    const avatarEntity = document.querySelector("#avatarModel");
    if (avatarEntity) {
      avatarEntity.setAttribute(
        "auto-avatar-anim",
        "morphName: A; rotAmpDeg: 6; rotSpeed: 1; morphSpeed: 4; jitter: 0.12; smooth: 0.22; syllableMs: 85;"
      );
    } else {
      const dbg = document.getElementById("debug3d");
      if (dbg) dbg.textContent = "No #avatarModel found in DOM";
    }
  });

})();
</script>

<!-- =========================================================
     Speech recognition + synthesis (dispatch TTS events)
========================================================= -->
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

  // NEW: dispatch TTS events to A-Frame component
  function ttsStartSignal() { window.dispatchEvent(new Event("tts-start")); }
  function ttsEndSignal()   { window.dispatchEvent(new Event("tts-end")); }

  function stopSpeaking() {
    if (!("speechSynthesis" in window)) return;
    speechSynthesis.cancel();
    ttsEndSignal(); // ensure mouth stops and resets to 0
    btnSpk.setAttribute("aria-pressed","false");
  }

  function speakAnswer() {
    if (!("speechSynthesis" in window)) return;

    // stop previous speech (also resets mouth)
    stopSpeaking();

    const text = stripHtmlToText(respuestaEl.innerHTML);
    if (!text) return;

    const u = new SpeechSynthesisUtterance(text);
    u.lang = "es-ES";
    u.rate = 1;
    u.pitch = 1;

    const v = resolveSelectedVoice();
    if (v) u.voice = v;

    u.onstart = () => {
      btnSpk.setAttribute("aria-pressed","true");
      ttsStartSignal(); // start mouth anim (x2 speed)
    };

    u.onend = () => {
      btnSpk.setAttribute("aria-pressed","false");
      ttsEndSignal(); // stop + force to 0
    };

    u.onerror = () => {
      btnSpk.setAttribute("aria-pressed","false");
      ttsEndSignal(); // stop + force to 0
    };

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
    if (pressed) { stopSpeaking(); return; }
    speakAnswer();
  });

  // Auto-read if there is an answer
  const hasAnswer = stripHtmlToText(respuestaEl.innerHTML).length > 0;
  if (hasAnswer && ("speechSynthesis" in window)) {
    setTimeout(speakAnswer, 200);
  }

})();
</script>

</body>
</html>
