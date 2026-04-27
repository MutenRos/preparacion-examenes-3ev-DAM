const chat = document.getElementById("chat");
const form = document.getElementById("form");
const promptInput = document.getElementById("prompt");
const sendBtn = document.getElementById("send");
const resetBtn = document.getElementById("reset");

function addMsg(text, who="bot"){
  const div = document.createElement("div");
  div.className = "msg " + (who === "me" ? "me" : "bot");
  div.textContent = text;
  chat.appendChild(div);
  chat.scrollTop = chat.scrollHeight;
  return div;
}

function setBusy(b){
  sendBtn.disabled = b;
  promptInput.disabled = b;
}

async function ask(prompt){
  const r = await fetch("/api/chat", {
    method: "POST",
    headers: {"Content-Type":"application/json"},
    body: JSON.stringify({prompt})
  });
  const data = await r.json().catch(()=>null);
  if(!r.ok || !data) throw new Error((data && data.error) ? data.error : "Error");
  return data.answer || "";
}

function reset(){
  chat.innerHTML = "";
  addMsg("Hola. Pregúntame sobre los cursos de inglés (según el material entrenado).", "bot");
  promptInput.focus();
}

form.addEventListener("submit", async (e)=>{
  e.preventDefault();
  const q = (promptInput.value || "").trim();
  if(!q) return;

  promptInput.value = "";
  addMsg(q, "me");

  setBusy(true);
  const placeholder = addMsg("Pensando…", "bot");

  try{
    const a = await ask(q);
    placeholder.textContent = a || "No he podido generar respuesta.";
  }catch(err){
    placeholder.textContent = "Error: " + (err.message || "fallo");
  }finally{
    setBusy(false);
    promptInput.focus();
  }
});

resetBtn.addEventListener("click", reset);

reset();

