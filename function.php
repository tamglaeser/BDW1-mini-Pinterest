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



function category(int $cat, $link)
{
    $resultat_catNoms = executeQuery($link, "SELECT nomCat FROM Categorie WHERE catId = $cat");
    $row_catNom = $resultat_catNoms->fetch_assoc();
    echo "<h1>Les photos de la catégorie " . $row_catNom["nomCat"] . "</h1>";

    $resultat_photId = executeQuery($link, "SELECT photoId FROM Photo WHERE catId = $cat");
    while ($row_photoId = $resultat_photId->fetch_assoc()) {
        $resultat_imNom = executeQuery($link, "SELECT nomFich FROM Photo WHERE photoId = " . $row_photoId["photoId"] );
        $row_imNom = $resultat_imNom->fetch_assoc();
        $images = glob($GLOBALS['dir'] . $row_imNom["nomFich"], GLOB_BRACE);
        foreach ($images as $image):
            echo "<a href='details.php?name=" . $row_imNom["nomFich"] . "'><img src='" . $image . "' hspace = '10' border = '5'/></a>";
        endforeach;
    }
}

?>
</body>
</html>
