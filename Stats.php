<?php
	require_once('bd.php');
	require_once('utilisateur.php');
	require_once('administrateur.php');
/*bdw1.univ-lyon1.fr/p1501149/tp4*/

session_start();
$conn = getConnection('localhost', "p1926029", "ef5d0c", "p1926029");
?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Bienvenue sur PhotouCat</title>
  <link rel="stylesheet" href="bootstrap.css">
  <link rel="stylesheet" href="accueil.css">
</head>
<body>
<div style="background-image:url(img/accueil_bis.jpg);" ><B><h1>PhotouCat_Admin</h1></B><br> </div>
<nav class="crumbs">
	<form name="accueil" action="accueil.php" method="POST">
	   <button style="float: left;" type="submit" name="accueil" class="btn btn-success">
		Accueil
		</button>
		<div class='connexion'>
		<button style="float: right;" type="submit" name="deconnexion" class="btn btn-success">
		Deconnexion
		</button>
		</div>
	</nav></br>
</body>
</html>
<?php
/**
if (isset($_GET['catId'])) {
    $Id = htmlspecialchars($_GET["catId"]);
    include("function.php");
}**/


if (isset($_POST['accueil'])) {
    header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/accueil.php');
    exit();
}
if (isset($_POST['deconnexion'])) {
    header('Location:https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/accueil.php');
    exit();
}


closeConnexion($conn);
?>