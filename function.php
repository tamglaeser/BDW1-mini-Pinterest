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
require_once ('utilisateur.php');
$conn = getConnection('localhost', "p1926029", "ef5d0c", "p1926029");
$dir = "assets/images/";

//if ($GLOBALS['qui'] != 'personne') {
  //  $qui = $GLOBALS['qui'];
    //$pseudo = $_SESSION['pseudo']; // seulement affiche quand on est connecte
//}

if (isset($_POST['show_dowpdown_cache_value']) and $_POST['dowpdown_cache'] !=0) {


    $catId = $_POST['dowpdown_cache']; // this will print the value if downbox out
    category($catId, $GLOBALS['conn'], 'cache');
}

if (isset($_POST['show_dowpdown_value']) and $_POST['dowpdown'] !=0) {

    $catId = $_POST['dowpdown']; // this will print the value if downbox out
    category($catId, $GLOBALS['conn'], 'montre');
}

if (isset($_GET['catId'])) {
    $Id = htmlspecialchars($_GET["catId"]);
    category($Id, $conn, 'montre');
}




function category(int $cat, $link, $statut)
{
    $resultat_catNoms = executeQuery($link, "SELECT nomCat FROM Categorie WHERE catId = $cat");
    $row_catNom = $resultat_catNoms->fetch_assoc();
    if ($statut == 'cache') {
        echo "<h1>Les photos caches de la catégorie " . $row_catNom["nomCat"] . "</h1>";
    }

    else if ($statut == 'montre') {
        echo "<h1>Les photos de la catégorie " . $row_catNom["nomCat"] . "</h1>";
    }

    if (!empty($_SESSION['pseudo']) && !empty($_SESSION['motdepasse']) && getUserUtil($_SESSION['pseudo'], $_SESSION['motdepasse'], $link) == 1) { //seulement afficher ses photos de la categorie choisi
        $resultat_photoId = executeQuery($link, "SELECT p.photoId FROM Photo p WHERE p.catId = $cat AND p.utilId IN (SELECT u.utilId FROM utilisateur u WHERE u.utilPseudo = '" . $_SESSION['pseudo'] . "') AND p.statut = '" . $statut . "'");
    }
    else {
        $resultat_photoId = executeQuery($link, "SELECT photoId FROM Photo WHERE catId = $cat");
    }
    echo "<div class='gallery'>";
    while ($row_photoId = $resultat_photoId->fetch_assoc()) {
        $resultat_imNom = executeQuery($link, "SELECT nomFich FROM Photo WHERE photoId = " . $row_photoId["photoId"] );
        $row_imNom = $resultat_imNom->fetch_assoc();
        $images = glob($GLOBALS['dir'] . $row_imNom["nomFich"], GLOB_BRACE);
        foreach ($images as $image):
            echo "<a href='details.php?photoId=" . $row_photoId["photoId"] . "'><img src='" . $image . "' class = 'assets'/></a>";
        endforeach;
    }
    echo "</div>";
}

?>
</body>
</html>
