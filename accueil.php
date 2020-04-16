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
require_once('bd.php');

$conn = getConnection('localhost', "p1926029", "ef5d0c", "p1926029");
$dir = "assets/images/";

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
	</nav><br>
<form action="function.php" method="post">
<div>
	<h5> Selection de la catégorie d'image à afficher : </h5>
    <!-- here start the dropdown list -->
	<div>
    <select name="dowpdown" >
        <option value="0">Toutes les photos</option>
        <option value="1">Animaux</option>
        <option value="2">Sport</option>
        <option value="3">Internet</option>
        <option value="4">Gens</option>
    </select>
    <input type="submit" name="show_dowpdown_value" value="Valider"/>
	</div>
	</div><br><br><br>
</form>
<?php include("function.php"); ?>

</body>
</html>

<?php
/**
if (isset($_GET['catId'])) {
    $Id = htmlspecialchars($_GET["catId"]);
    include("function.php");
}**/

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
closeConnexion($conn);
?>