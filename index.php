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
require_once('bd.php');
$conn = getConnection('localhost', "p1926029", "ef5d0c", "p1926029");

$dir = "assets/images/";
$catId=5;

?>
<div style="background-image:url(img/accueil_bis.jpg);" ><B><h1>PhotoCat</h1></B><br> </div>
	<nav class="crumbs">
	<form name="accueil" action="index.php" method="POST">
	   <button style="float: left;" type="submit" name="accueil" class="btn btn-success">
		Accueil
		</button>
		<div class='connexion'>
		<button style="float: right;" type="submit" name="connexion_ad" class="btn btn-success">
		Connexion Admin
		</button>
		<button style="float: right;" type="submit" name="connexion_util" class="btn btn-success">
		Connexion utilisateur
		</button>
		</div>
	</nav>
    <h1>Toutes les photos</h1>
    <!--$dirname = "assets/images/";
    $images = glob("{$dirname}*.png, {$dirname}*.jpg, {$dirname}*.gif");
    foreach($images as $image) {
        <img src=echo $image alt ="hello">
    }-->

<div class="dropdown">
    <button class="dropbtn">Categories</button>
    <div class="dropdown-content">
        <a href="#animaux">Animaux</a>
        <a href="#sport">Sport</a>
        <a href="#internet">Internet</a>
        <a href="#gens">Gens</a>
    </div>
</div>
<a id="animaux">
    <?php category("Animaux", $conn); ?>
</a>

<a id="sport">
    <?php category("Sport", $conn); ?>
</a>

<a id="internet">
    <?php category("Internet", $conn); ?>
</a>

<a id="gens">
    <?php category("Gens", $conn); ?>
</a>

</body>
</html>

<?php

session_start();

if (isset($_POST['accueil'])) {
    header('Location: https://bdw1.univ-lyon1.fr/p1501149/Projet/src/index.php');
    exit();
}
if (isset($_POST['connexion_ad'])) {
    header('Location: https://bdw1.univ-lyon1.fr/p1501149/Projet/src/connexion_admin.php');
    exit();
}
if (isset($_POST['connexion_util'])) {
    header('Location: https://bdw1.univ-lyon1.fr/p1501149/Projet/src/connexion_utilisateur.php');
    exit();
}

function category(string $cat, $link) {
    $catId = executeQuery($link,"SELECT catId FROM Categorie WHERE nomCat = '$cat'");
    echo $catId;
    /*
    $sql = "SELECT nomFich FROM Photo WHERE catId = $catId";
    $resultat = $link->query($sql);
    while($row = $resultat->fetch_assoc()) {
        echo "nomFich: " . $row["nomFich"] . " ";
        //$im = glob($GLOBALS['dir'] . $nomFich, GLOB_BRACE);
        //echo "<img src='" . $im . "' />";
    }*/
}
if ($catId = 5) {
    $images = glob($dir. '*.{png,jpg,gif}', GLOB_BRACE);
    foreach ($images as $image):
        echo "<img src='" . $image . "' />";

    endforeach;
}
closeConnexion($conn);
?>