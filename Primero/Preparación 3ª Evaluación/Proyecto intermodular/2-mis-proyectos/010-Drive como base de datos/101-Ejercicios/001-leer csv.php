<?php

$url = "https://docs.google.com/spreadsheets/d/e/2PACX-1vSnPzzPFyDT1mMvKU9XWdUZdI68tw65egXqAAABRsESkZ5nu7pZUorkf-NLq9y-Yx3A6XVUF0hcw-fW/pub?output=csv";

if (($handle = fopen($url, "r")) !== false) {

    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
        print_r($data);
        echo "<br>";
    }

    fclose($handle);
}
?>
