<?php
// Database connection
$db = new SQLite3('jocarsa.db');
$db->exec('PRAGMA foreign_keys = ON;');

// Helper function to sanitize input
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Helper function to redirect
function redirect($url) {
    header("Location: $url");
    exit;
}

// Helper function to get table columns
function getTableColumns($db, $table) {
    $result = $db->query("PRAGMA table_info($table)");
    $columns = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $columns[] = $row['name'];
    }
    return $columns;
}

// Helper function to get foreign key options (fixed)
function getForeignKeyOptions($db, $table, $key) {
    $fk_table = str_replace('_id', '', $key);
    if (!in_array($fk_table, ['clientes', 'productos', 'pedidos'])) {
        return [];
    }
    $result = $db->query("SELECT id, nombre FROM $fk_table");
    $options = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $options[$row['id']] = $row['nombre'];
    }
    return $options;
}

// Helper function to get table primary key
function getPrimaryKey($db, $table) {
    $result = $db->query("PRAGMA table_info($table)");
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        if ($row['pk'] == 1) {
            return $row['name'];
        }
    }
    return 'id';
}

// Pagination and search
$table = isset($_GET['table']) ? $_GET['table'] : 'clientes';
$pk = getPrimaryKey($db, $table);
$search = isset($_GET['search']) ? sanitize($_GET['search']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 10;
$offset = ($page - 1) * $per_page;

// Main routing
$action = isset($_GET['action']) ? $_GET['action'] : 'list';

// Handle actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $columns = getTableColumns($db, $table);
        $cols = [];
        $placeholders = [];
        $values = [];
        foreach ($columns as $col) {
            if ($col != $pk && $col != 'activo' && $col != 'total' && $col != 'total_linea') {
                if (isset($_POST[$col])) {
                    $cols[] = $col;
                    $placeholders[] = ":$col";
                    $values[":$col"] = sanitize($_POST[$col]);
                }
            }
        }
        $sql = "INSERT INTO $table (" . implode(', ', $cols) . ")
                VALUES (" . implode(', ', $placeholders) . ")";
        $stmt = $db->prepare($sql);
        foreach ($values as $key => $value) {
            $stmt->bindValue($key, $value, SQLITE3_TEXT);
        }
        $stmt->execute();
        redirect("admin.php?table=$table");
    }
    elseif (isset($_POST['update'])) {
        $id = (int)$_POST[$pk];
        $columns = getTableColumns($db, $table);
        $set = [];
        $values = [];
        foreach ($columns as $col) {
            if ($col != $pk && isset($_POST[$col])) {
                $set[] = "$col = :$col";
                $values[":$col"] = sanitize($_POST[$col]);
            }
        }
        $sql = "UPDATE $table SET " . implode(', ', $set) . " WHERE $pk = :$pk";
        $stmt = $db->prepare($sql);
        foreach ($values as $key => $value) {
            $stmt->bindValue($key, $value, SQLITE3_TEXT);
        }
        $stmt->bindValue(":$pk", $id, SQLITE3_INTEGER);
        $stmt->execute();
        redirect("admin.php?table=$table");
    }
    elseif (isset($_POST['delete'])) {
        $id = (int)$_POST[$pk];
        $db->exec("DELETE FROM $table WHERE $pk = $id");
        redirect("admin.php?table=$table");
    }
}

// HTML Header
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .admin-sidebar { background: #222; color: #fff; padding: 20px; min-height: 100vh; }
        .admin-sidebar a { color: #fff; text-decoration: none; display: block; padding: 10px; }
        .admin-sidebar a:hover { background: #333; }
        .admin-content { padding: 20px; }
        .table { margin-top: 20px; }
        .form-group { margin-bottom: 15px; }
        .pagination { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 admin-sidebar">
                <h4>Admin Panel</h4>
                <a href="?table=clientes"><i class="fas fa-users"></i> Clientes</a>
                <a href="?table=productos"><i class="fas fa-boxes"></i> Productos</a>
                <a href="?table=pedidos"><i class="fas fa-shopping-cart"></i> Pedidos</a>
                <a href="?table=lineas_pedido"><i class="fas fa-list"></i> Líneas Pedido</a>
            </div>
            <div class="col-md-10 admin-content">
                <?php
                // List view with search and pagination
                if ($action == 'list') {
                    $where = '';
                    if ($search) {
                        $columns = getTableColumns($db, $table);
                        $ors = [];
                        foreach ($columns as $col) {
                            if (strpos($col, 'id') === false && strpos($col, 'precio') === false && strpos($col, 'stock') === false) {
                                $ors[] = "$col LIKE '%$search%'";
                            }
                        }
                        if ($ors) $where = 'WHERE ' . implode(' OR ', $ors);
                    }
                    $result = $db->query("SELECT COUNT(*) as total FROM $table $where");
                    $total = $result->fetchArray(SQLITE3_ASSOC)['total'];
                    $pages = ceil($total / $per_page);
                    $result = $db->query("SELECT * FROM $table $where LIMIT $per_page OFFSET $offset");
                    echo "<h2>" . ucfirst($table) . "</h2>";
                    echo "<form method='get' class='mb-3'>
                        <input type='hidden' name='table' value='$table'>
                        <div class='input-group'>
                            <input type='text' name='search' class='form-control' placeholder='Buscar...' value='$search'>
                            <button class='btn btn-primary' type='submit'><i class='fas fa-search'></i></button>
                        </div>
                    </form>";
                    echo "<a href='?table=$table&action=add' class='btn btn-primary mb-3'><i class='fas fa-plus'></i> Añadir</a>";
                    echo "<table class='table table-striped'>";
                    $columns = getTableColumns($db, $table);
                    echo "<thead><tr>";
                    foreach ($columns as $col) {
                        echo "<th>$col</th>";
                    }
                    echo "<th>Acciones</th></tr></thead><tbody>";
                    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                        echo "<tr>";
                        foreach ($columns as $col) {
                            echo "<td>" . ($row[$col] ?? '') . "</td>";
                        }
                        echo "<td>
                            <a href='?table=$table&action=edit&$pk=" . $row[$pk] . "' class='btn btn-sm btn-warning'><i class='fas fa-edit'></i></a>
                            <form method='post' style='display:inline;'>
                                <input type='hidden' name='$pk' value='" . $row[$pk] . "'>
                                <button type='submit' name='delete' class='btn btn-sm btn-danger' onclick='return confirm(\"¿Seguro?\")'><i class='fas fa-trash'></i></button>
                            </form>
                        </td>";
                        echo "</tr>";
                    }
                    echo "</tbody></table>";
                    echo "<nav><ul class='pagination'>";
                    for ($i = 1; $i <= $pages; $i++) {
                        echo "<li class='page-item " . ($i == $page ? 'active' : '') . "'>
                            <a class='page-link' href='?table=$table&search=$search&page=$i'>$i</a>
                        </li>";
                    }
                    echo "</ul></nav>";
                }
                // Add/Edit form
                elseif ($action == 'add' || $action == 'edit') {
                    $row = [];
                    if ($action == 'edit' && isset($_GET[$pk])) {
                        $id = (int)$_GET[$pk];
                        $result = $db->query("SELECT * FROM $table WHERE $pk = $id");
                        $row = $result->fetchArray(SQLITE3_ASSOC);
                    }
                    echo "<h2>" . ($action == 'add' ? 'Añadir' : 'Editar') . " " . ucfirst($table) . "</h2>";
                    echo "<form method='post'>";
                    $columns = getTableColumns($db, $table);
                    foreach ($columns as $col) {
                        if ($col == $pk && $action == 'add') continue;
                        echo "<div class='form-group'>";
                        echo "<label>$col</label>";
                        if (strpos($col, '_id') !== false) {
                            $fk_table = str_replace('_id', '', $col);
                            $options = getForeignKeyOptions($db, $fk_table, $col);
                            echo "<select name='$col' class='form-control' required>";
                            foreach ($options as $id => $name) {
                                $selected = (isset($row[$col]) && $row[$col] == $id) ? 'selected' : '';
                                echo "<option value='$id' $selected>$name</option>";
                            }
                            echo "</select>";
                        } else {
                            $type = 'text';
                            if (strpos($col, 'precio') !== false || strpos($col, 'total') !== false) $type = 'number';
                            if (strpos($col, 'fecha') !== false) $type = 'date';
                            if (strpos($col, 'descripcion') !== false) echo "<textarea name='$col' class='form-control' required>" . ($row[$col] ?? '') . "</textarea>";
                            else echo "<input type='$type' name='$col' class='form-control' value='" . ($row[$col] ?? '') . "' required>";
                        }
                        echo "</div>";
                    }
                    echo "<button type='submit' name='" . ($action == 'add' ? 'add' : 'update') . "' class='btn btn-primary'>Guardar</button>";
                    echo "</form>";
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
