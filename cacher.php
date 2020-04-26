<?php

session_start();
require_once ('bd.php');
require_once ('utilisateur.php');
require_once ('function.php');

$pId = $_SESSION['photoId'];
$ps = $_SESSION['pseudo'];

?>
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
$conn = getConnection('localhost', "p1926029", "ef5d0c", "p1926029");
cach($pId,$ps);

?>
</body>
</html>
<?php
function cach($photoId,$pseudo) {

    if(getUserUtil($pseudo,$_SESSION['motdepasse'],$GLOBALS['conn']) ==1){
        $resultat= executeQuery($GLOBALS['conn'], "UPDATE Photo p SET p.statut='cache' WHERE p.photoId = " . $photoId . " AND p.utilId IN (SELECT u.utilId FROM utilisateur u WHERE utilPseudo = '" . $pseudo . "')");
        header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/page_utilisateur.php?pseudo='.$pseudo);

        exit();
    }
    else{
        echo "vous ne pouvez pas la cacher ";
        header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/page_utilisateur.php?pseudo='.$pseudo);
    }
}


?>
