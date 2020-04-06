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

						
?>


<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>PhotouCat</title>
  <link rel="stylesheet" href="bootstrap.css">
  <link rel="stylesheet" href="index.css">
</head>
<body>
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
</body>
</html>