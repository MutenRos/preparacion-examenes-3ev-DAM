<?php
chdir(__DIR__); // ensure same folder as this PHP file

$output = [];
$return_var = 0;

exec("python3 004-holamundo.py 2>&1", $output, $return_var);
echo '<p>Esto te lo da PHP</p><br>';
echo "<pre>";
print_r($output[0]);
echo "</pre>";

echo "Return code: $return_var";
?>
