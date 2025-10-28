<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    if ($_SERVER["RESQUEST_METHOD"] == "POST")

 {
    echo "<h2>HTML űrlap</h2>";

// Űrlapadatok beolvasása
$nev = htmlspecialchars(trim($_POST["nev"] ?? "" ));
$pin = htmlspecialchars(trim($_POST["pin"] ?? "" ));
$fav_fruit = htmlspecialchars(trim($_POST["fav_fruit"] ?? "Nincs megadva" ));
$age = htmlspecialchars(trim($_POST["age"] ?? "Nincs megadva" ));
$feet_size = htmlspecialchars(trim($_POST["feet_size"] ?? "Nincs megadva" ));
$confidence = htmlspecialchars(trim($_POST["confidence"] ?? "Nincs megadva" ));

// Egyszerű validűció szerveroldalon
$hibak = [];
if (!preg_match("/^[A-ZÁÉÍÓÖŐÚÜŰ]a-záéíóöőüúű ] {4,}$/u", $nev)) {
    $hibak[] = "A név formátuma hibás";
}
if (!preg_match("/^[0-9]{4}$/", $pin)) {
    $hibak[] = "A PIN kód 4 számjegyből kell álljon"
}

// Hibák megjelenítésére vagy adatok kiírására
if (count($hibak) > 0 ) {
    echo "<div class= 'error'><p><strong>Hiba történt:</strong></p><ul>";
    foreach ($hibak as $hiba) {
        echo "<li>$hiba</li>";
    }
    echo "</ul></div>";
} else {
    // Adatok táblázatos megjelenítése
        echo "<table>";
            echo "<tr><td>Név:</td><td>$nev</td></tr>";
            echo "<tr><td>PIN Kód:</td><td>$pin</td></tr>";
            echo "<tr><td>Kedvenc gyümölcs:</td><td>$fav_fruit</td></tr>";
            echo "<tr><td>Életkor:</td><td>$age</td></tr>";
            echo "<tr><td>Lábméret:</td><td>$feet_size</td></tr>";
            echo "<tr><td>Önbizalom:</td><td>$confidence</td></tr>";
        echo "</table>";

        // --- Fáljba mentés ---

        $sor = date("Y-n-d H:i:s") . " ⎮ "
            "Név" $nev ⎮ " .
            "PIN" $pin ⎮ " .
            "Kedvenc gyümölcs" $fav_fruit ⎮ " .
            "Életkor" $age ⎮ " .
            "lábméret" $feet_size ⎮ " .
            "önbizalom" $confidence ⎮ " .PHP_EOL;

        $fajl = "BL_adatok.txt";

        if (file_put_contents($fajl, $sor, FILE_APPEND ⎮ LOCK_EX)) {
            echo "<p class='success'>✅ Az adatok sikeresen elmentve a <strong>$fajl</strong> fájlba.</p>";
        } else {
             echo "<p class='error'>❌ Hiba történt az adatok mentésekor!</p>";
        }
}


 } else {
    echo "<p class='error'>nem POST metódussal érkezett az űrlap.</p>";
 }




</body>
</html>