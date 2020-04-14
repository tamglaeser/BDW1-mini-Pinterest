<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>PhotouCat</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="index.css">
</head>
<body>

<?php

if (isset($_POST['show_dowpdown_value'])) {

    $catId = $_POST['dowpdown']; // this will print the value if downbox out
    //$dir = "assets/images/";
    if ($catId != 0) {
        category($catId, $conn);
    }
    else {

        ?>
        <h1>Toutes les photos</h1><?php
        $images = glob($dir. '*.{png,jpg,gif}', GLOB_BRACE);
        foreach ($images as $image):
            echo "<img src='" . $image . "' hspace='10' border='5' />";
        endforeach;
    }
}


require_once('bd.php');
$conn = getConnection('localhost', "p1926029", "ef5d0c", "p1926029");



function category(int $cat, $link) {
    if ($cat == 1){
        ?><h1>Les photos de la catégorie Animaux</h1><?php
    }

    else if ($cat == 2){
        ?><h1>Les photos de la catégorie Sport</h1><?php
    }

    else if ($cat == 3){
        ?><h1>Les photos de la catégorie Internet</h1><?php
    }

    else if ($cat == 4){
        ?><h1>Les photos de la catégorie Gens</h1><?php
    }

    $resultat = executeQuery($link, "SELECT nomFich FROM Photo WHERE catId = $cat");
    while($row = $resultat->fetch_assoc()) {
        $images = glob($GLOBALS['dir'] . $row["nomFich"], GLOB_BRACE);
        foreach ($images as $image):
            echo "<a href='details.php?name=" . $row["nomFich"] . "'><img src='" . $image . "' hspace = '10' border = '5'/></a>";
        endforeach;
    }
}

?>
</body>
</html>
