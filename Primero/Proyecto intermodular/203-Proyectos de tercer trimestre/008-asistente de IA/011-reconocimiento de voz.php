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
    max-width:720px;
    margin:auto;
    height:100vh;
    padding:16px;
    display:flex;
    flex-direction:column;
    gap:12px;
}
section{
    flex:1;
    background:white;
    border:1px solid #ddd;
    border-radius:10px;
    padding:12px;
    overflow-y:auto;
    text-align:justify;
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

/* --- speech button (minimal) --- */
button.mic{
    padding:10px 12px;
    border:1px solid #ccc;
    border-radius:10px;
    background:#fff;
    cursor:pointer;
}
button.mic[aria-pressed="true"]{
    border-color:#d33;
}
small#srstatus{
    display:block;
    color:#666;
    padding:0 2px;
}
</style>
</head>
<body>

<?php
$respuesta = "";

if(isset($_GET["mensaje"]) && $_GET["mensaje"] != ""){

    $mensaje = $_GET["mensaje"];
    $sistema = "
        -No devuelvas markdown. Devuelve HTML.
        -Reduce tu respuesta a dos o tres párrafos.
        -No pongas fences markdown en tu respuesta
        -Atiende a la siguiente petición por parte del usuario:
        
    ";
    $datos = [
        "model" => "ministral-3:3b",
        "prompt" => $sistema.$mensaje,
        "stream" => false
    ];

    $ch = curl_init("http://localhost:11434/api/generate");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($datos));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);

    $resultado = curl_exec($ch);
    curl_close($ch);

    $json = json_decode($resultado,true);

    $respuesta = $json["response"] ?? "Sin respuesta";
}
?>

<main>
    <section><?php echo $respuesta; ?></section>

    <small id="srstatus"></small>

    <form action="?" method="GET">
        <input id="mensaje" type="text" name="mensaje" placeholder="Escribe tu mensaje..." autocomplete="off">
        <button id="mic" class="mic" type="button" aria-pressed="false" title="Dictar">🎤</button>
    </form>
</main>

<script>
(() => {
  const input = document.getElementById("mensaje");
  const btn   = document.getElementById("mic");
  const st    = document.getElementById("srstatus");

  const SR = window.SpeechRecognition || window.webkitSpeechRecognition;
  if (!SR) { st.textContent = "Dictado no soportado en este navegador (usa Chrome/Edge)."; return; }

  const rec = new SR();
  rec.lang = "es-ES";
  rec.interimResults = true;
  rec.continuous = true;

  let finalText = "";

  rec.onstart = () => { btn.setAttribute("aria-pressed","true"); st.textContent = "Escuchando..."; };
  rec.onend   = () => { btn.setAttribute("aria-pressed","false"); st.textContent = ""; };
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

  btn.addEventListener("click", () => {
    const pressed = btn.getAttribute("aria-pressed") === "true";
    if (pressed) { rec.stop(); return; }
    finalText = input.value ? (input.value.trim() + " ") : "";
    rec.start();
  });
})();
</script>

</body>
</html>
