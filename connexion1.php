<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Bienvenue sur PhotouCat</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="accueil.css">
</head>
<?php
require_once('bd.php');
require_once('utilisateur.php');
require_once('administrateur.php');
/*bdw1.univ-lyon1.fr/p1501149/tp4*/

?> <!--
session_start();
if (isset($_POST['accueil'])) {
    header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/accueil.php');
    exit();
}

?>

<div style="background-image:url(img/accueil_bis.jpg);" ><B><h1>PhotouCat</h1></B><br> </div>
<nav class="crumbs">
    <form name="accueil" action="accueil.php" method="POST">
        <button style="float: left;" type="submit" name="accueil" class="btn btn-success">
            Accueil
        </button>
</nav>
-->
<html>
<body>

<form action="welcome.php" method="post">
    Name: <input type="text" name="name"><br>
    E-mail: <input type="text" name="email"><br>
    <input type="submit" name="submit">
</form>


</body>
</html>


