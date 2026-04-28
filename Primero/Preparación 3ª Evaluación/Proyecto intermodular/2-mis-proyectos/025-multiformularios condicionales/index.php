<?php
declare(strict_types=1);
?><!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Formulario no especificado</title>
<style>
:root{
    --bg:#f0f2f5;
    --card:#ffffff;
    --text:#1f2937;
    --muted:#6b7280;
    --border:#d1d5db;
    --accent:#2271b1;
}
*{box-sizing:border-box}
body{
    margin:0;
    font-family:Arial, sans-serif;
    background:var(--bg);
    color:var(--text);
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:24px;
}
.card{
    width:100%;
    max-width:720px;
    background:var(--card);
    border:1px solid var(--border);
    border-radius:12px;
    padding:32px;
    box-shadow:0 8px 24px rgba(0,0,0,.08);
}
h1{
    margin:0 0 16px 0;
    font-size:28px;
}
p{
    margin:0 0 14px 0;
    line-height:1.6;
}
code{
    background:#f6f7f7;
    border:1px solid #dcdcde;
    border-radius:6px;
    padding:3px 8px;
}
.example{
    margin-top:20px;
    padding:16px;
    border-left:4px solid var(--accent);
    background:#f6f7f7;
    border-radius:8px;
}
.small{
    color:var(--muted);
    font-size:14px;
    margin-top:18px;
}
a{
    color:var(--accent);
    text-decoration:none;
}
a:hover{
    text-decoration:underline;
}
</style>
</head>
<body>
    <div class="card">
        <h1>Se necesita un hash de formulario</h1>
        <p>Esta URL no puede abrir un formulario directamente porque falta el identificador único.</p>
        <p>Para acceder a un formulario público debes usar una dirección con hash, por ejemplo:</p>

        <div class="example">
            <code>/public/form.php?h=HASH_UNICO_DEL_FORMULARIO</code>
        </div>

        <p class="small">
            Si eres administrador, entra al panel y abre el formulario desde su enlace público.
        </p>
    </div>
</body>
</html>
