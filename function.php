<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>PhotouCat</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="accueil.css">
</head>
<body>

<?php
require_once ('bd.php');
$conn = getConnection('localhost', "p1926029", "ef5d0c", "p1926029");
$dir = "assets/images/";
$qui = $_GET['qui'];
if ($qui != 'personne') {
    $pseudo = $_SESSION['pseudo']; // seulement affiche quand on est connecte
}

if (isset($_POST['show_dowpdown_value']) and $_POST['dowpdown'] !=0) {

    $catId = $_POST['dowpdown']; // this will print the value if downbox out
    category($catId, $GLOBALS['conn']);
}

if (isset($_GET['catId'])) {
    $Id = htmlspecialchars($_GET["catId"]);
    category($Id, $conn);
}




function category(int $cat, $link)
{
    $resultat_catNoms = executeQuery($link, "SELECT nomCat FROM Categorie WHERE catId = $cat");
    $row_catNom = $resultat_catNoms->fetch_assoc();
    echo "<h1>Les photos de la catégorie " . $row_catNom["nomCat"] . "</h1>";
    if ($GLOBALS['qui'] == 'util') { //seulement afficher ses photos de la categorie choisi
        $resultat_photoId = executeQuery($link, "SELECT p.photoId FROM Photo p WHERE p.catId = $cat AND p.utilId IN (SELECT u.utilId FROM utilisateur u WHERE u.utilPseudo = '" . $GLOBALS['pseudo'] . "')");
    }
    else {
        $resultat_photoId = executeQuery($link, "SELECT photoId FROM Photo WHERE catId = $cat");
    }
    while ($row_photoId = $resultat_photoId->fetch_assoc()) {
        $resultat_imNom = executeQuery($link, "SELECT nomFich FROM Photo WHERE photoId = " . $row_photoId["photoId"] );
        $row_imNom = $resultat_imNom->fetch_assoc();
        $images = glob($GLOBALS['dir'] . $row_imNom["nomFich"], GLOB_BRACE);
        foreach ($images as $image):
            echo "<a href='details.php?photoId=" . $row_photoId["photoId"] . "'><img src='" . $image . "' hspace = '10' border = '5'/></a>";
        endforeach;
    }
}

?>
</body>
</html>
