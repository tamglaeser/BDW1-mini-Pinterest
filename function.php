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
    $resultat = executeQuery($link, "SELECT nomCat FROM Categorie WHERE catId = $cat");
    $row = $resultat->fetch_assoc();
    echo "<h1>Les photos de la catégorie " . $row["nomCat"] . "</h1>";

    $resultat0 = executeQuery($link, "SELECT photoId FROM Photo WHERE catId = $cat");
    while ($row0 = $resultat0->fetch_assoc()) {
        $resultat1 = executeQuery($link, "SELECT nomFich FROM Photo WHERE catId = $row0");
        $row1 = $resultat1->fetch_assoc();
        $images = glob($GLOBALS['dir'] . $row1["nomFich"], GLOB_BRACE);
        foreach ($images as $image):
            echo "<a href='details.php?name=" . $row1["nomFich"] . "'><img src='" . $image . "' hspace = '10' border = '5'/></a>";
        endforeach;
        /*
                $resultat1 = executeQuery($link, "SELECT nomFich FROM Photo WHERE catId = $cat");
            while($row1 = $resultat1->fetch_assoc()) {
                $images = glob($GLOBALS['dir'] . $row1["nomFich"], GLOB_BRACE);
                foreach ($images as $image):
                    echo "<a href='details.php?name=" . $row1["nomFich"] . "'><img src='" . $image . "' hspace = '10' border = '5'/></a>";
                endforeach;
            }
        */
    }
}

?>
</body>
</html>
