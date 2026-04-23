<?php
declare(strict_types=1);
require_once __DIR__ . '/functions.php';

function admin_header(string $title): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $user = $_SESSION['user'] ?? null;

    echo '<!doctype html><html lang="es"><head><meta charset="utf-8">';
    echo '<meta name="viewport" content="width=device-width,initial-scale=1">';
    echo '<title>' . h($title) . '</title>';
    echo '<style>
    :root{
        --wp-bg:#f0f0f1;
        --wp-surface:#ffffff;
        --wp-border:#dcdcde;
        --wp-text:#1d2327;
        --wp-muted:#646970;
        --wp-primary:#2271b1;
        --wp-primary-hover:#135e96;
        --wp-sidebar:#1d2327;
        --wp-sidebar-hover:#2c3338;
        --wp-sidebar-text:#f0f0f1;
        --wp-sidebar-muted:#a7aaad;
        --wp-success-bg:#edfaef;
        --wp-success-border:#72aee6;
        --wp-shadow:0 1px 1px rgba(0,0,0,.04);
        --sidebar-width:240px;
        --topbar-height:46px;
        --radius:10px;
    }

    *{box-sizing:border-box}

    html,body{
        margin:0;
        padding:0;
        min-height:100%;
        font-family:Arial,sans-serif;
        background:var(--wp-bg);
        color:var(--wp-text);
    }

    a{
        color:var(--wp-primary);
        text-decoration:none;
    }
    a:hover{
        color:var(--wp-primary-hover);
    }

    .admin-app{
        min-height:100vh;
        display:grid;
        grid-template-columns:var(--sidebar-width) 1fr;
    }

    .admin-sidebar{
        background:var(--wp-sidebar);
        color:var(--wp-sidebar-text);
        min-height:100vh;
        padding:0;
    }

    .admin-brand{
        height:var(--topbar-height);
        display:flex;
        align-items:center;
        padding:0 18px;
        font-weight:bold;
        font-size:14px;
        border-bottom:1px solid rgba(255,255,255,.08);
        letter-spacing:.3px;
    }

    .admin-user{
        padding:14px 18px;
        border-bottom:1px solid rgba(255,255,255,.08);
        font-size:13px;
        color:var(--wp-sidebar-muted);
        line-height:1.5;
    }

    .admin-menu{
        padding:10px 0;
    }

    .admin-menu a{
        display:block;
        color:var(--wp-sidebar-text);
        padding:12px 18px;
        font-size:14px;
        border-left:3px solid transparent;
    }

    .admin-menu a:hover{
        background:var(--wp-sidebar-hover);
        color:#fff;
        border-left-color:var(--wp-primary);
    }

    .admin-main{
        min-width:0;
        display:flex;
        flex-direction:column;
        min-height:100vh;
    }

    .admin-topbar{
        height:var(--topbar-height);
        background:#fff;
        border-bottom:1px solid var(--wp-border);
        display:flex;
        align-items:center;
        justify-content:space-between;
        padding:0 22px;
    }

    .admin-topbar h1{
        font-size:20px;
        margin:0;
        font-weight:600;
        line-height:1;
    }

    .admin-topbar .top-meta{
        color:var(--wp-muted);
        font-size:13px;
    }

    .admin-content{
        padding:24px;
    }

    .wrap{
        max-width:1200px;
    }

    .card{
        background:var(--wp-surface);
        border:1px solid var(--wp-border);
        border-radius:var(--radius);
        padding:20px;
        box-shadow:var(--wp-shadow);
        margin-bottom:20px;
    }

    input[type=text],input[type=password],input[type=email],input[type=number],input[type=date],textarea,select{
        width:100%;
        padding:10px 12px;
        box-sizing:border-box;
        border:1px solid #8c8f94;
        border-radius:6px;
        background:#fff;
        color:var(--wp-text);
        font-size:14px;
    }

    input[type=text]:focus,
    input[type=password]:focus,
    input[type=email]:focus,
    input[type=number]:focus,
    input[type=date]:focus,
    textarea:focus,
    select:focus{
        outline:none;
        border-color:var(--wp-primary);
        box-shadow:0 0 0 1px var(--wp-primary);
    }

    textarea{
        min-height:220px;
        font-family:Consolas, monospace;
        resize:vertical;
    }

    label{
        display:block;
        font-weight:600;
        margin-bottom:8px;
        font-size:14px;
    }

    .row{
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:18px;
    }

    .btn,
    .actions a,
    button{
        display:inline-block;
        padding:9px 14px;
        border-radius:6px;
        border:1px solid var(--wp-primary);
        background:var(--wp-primary);
        color:#fff !important;
        text-decoration:none;
        cursor:pointer;
        font-size:13px;
        line-height:1.4;
    }

    .btn:hover,
    .actions a:hover,
    button:hover{
        background:var(--wp-primary-hover);
        border-color:var(--wp-primary-hover);
    }

    .btn.secondary{
        background:#f6f7f7;
        color:var(--wp-text) !important;
        border-color:var(--wp-border);
    }

    .btn.secondary:hover{
        background:#edeff1;
        border-color:#c3c4c7;
    }

    table{
        width:100%;
        border-collapse:collapse;
        background:#fff;
    }

    th,td{
        padding:12px;
        border-bottom:1px solid var(--wp-border);
        text-align:left;
        vertical-align:top;
        font-size:14px;
    }

    th{
        background:#f6f7f7;
        font-weight:600;
    }

    .flash{
        background:var(--wp-success-bg);
        border-left:4px solid var(--wp-success-border);
        padding:14px 16px;
        border-radius:8px;
        margin-bottom:18px;
    }

    .muted{
        color:var(--wp-muted);
    }

    code{
        background:#f6f7f7;
        border:1px solid var(--wp-border);
        padding:2px 6px;
        border-radius:4px;
        font-size:13px;
    }

    @media (max-width: 960px){
        .admin-app{
            grid-template-columns:1fr;
        }
        .admin-sidebar{
            min-height:auto;
        }
        .admin-content{
            padding:16px;
        }
        .row{
            grid-template-columns:1fr;
        }
    }
    </style></head><body>';

    echo '<div class="admin-app">';

    echo '<aside class="admin-sidebar">';
    echo '<div class="admin-brand">Formularios PRO</div>';

    if ($user) {
        echo '<div class="admin-user">';
        echo '<div><strong>' . h($user['username']) . '</strong></div>';
        echo '<div>' . h($user['role']) . '</div>';
        echo '</div>';

        echo '<nav class="admin-menu">';
        echo '<a href="index.php">Escritorio</a>';
        echo '<a href="formularios.php">Formularios</a>';
        if ($user['role'] === 'superadmin') {
            echo '<a href="usuarios.php">Usuarios</a>';
        }
        echo '<a href="logout.php">Salir</a>';
        echo '</nav>';
    }

    echo '</aside>';

    echo '<main class="admin-main">';
    echo '<div class="admin-topbar">';
    echo '<h1>' . h($title) . '</h1>';
    echo '<div class="top-meta">Panel de administración</div>';
    echo '</div>';

    echo '<div class="admin-content">';
    echo '<div class="wrap">';

    $flash = flash_get();
    if ($flash) {
        echo '<div class="flash">' . h($flash) . '</div>';
    }
}

function admin_footer(): void {
    echo '</div>';
    echo '</div>';
    echo '</main>';
    echo '</div>';
    echo '</body></html>';
}
