<?php
	require_once('fonctions/bd.php');
	require_once('fonctions/utilisateur.php');
/*bdw1.univ-lyon1.fr/p1501149/tp4*/
$dbHost = "localhost";// à compléter
$dbUser = "p1501149";// à compléter
$dbPwd = "49afdf";// à compléter
$dbName = "p1501149";
?>

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
  <title>Bienvenue sur le Chat de BDW1</title>
  <link rel="stylesheet" href="bootstrap.css">
  <link rel="stylesheet" href="index.css">
</head>
<body>
<div style="background-image:url(data/accueil_bis.jpg);" ><B><h1>PhotouCat</h1></B><br> </div>
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
<?php

/*Cette fonction doit être définie hors d'une condition (if/else), donc on la définie avant de l'utiliser dans une boucle*/
function test_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (isset($_POST['submit'])) {

	$pseudo = $_POST["pseudo"];
	$pwd = $_POST["motdepasse"];
	

  if (empty($_POST["pseudo"])){
    $pseudoErr = "Il vous faut un pseudo";
  }
	else {
		$pseudo = test_input($_POST["pseudo"]);
		$pseudoErr = "";
	}
	if (empty($_POST["motdepasse"])) {
		$pwdErr = "le mot de passe est requis";
	}
	else {
		$pwd = test_input($_POST["motdepasse"]);
	}
	
	$link=getConnection($dbHost, $dbUser, $dbPwd, $dbName);
	
	if(isset($_POST["pseudo"])){
	if ((isset($pseudo)) &&( isset($pwd))){
		if(getUser($pseudo, $pwd, $link) == 1) { 
			setConnected($pseudo, $link);
			$_SESSION["pseudo"]= $pseudo;
			
			header('Location: https://bdw1.univ-lyon1.fr/p1501149/TP4/chat.php');
			exit();
			
		}
		else{
			$pwdErr = "le pseudo/mot de passe sont erroné ou l'utilisateur n'existe pas";
		}
	}
	}
	
}
 
?>
	<div class="row justify-content-center">
	<div class="block container p-3 m-5 border rounded border-dark" name='block'>
		<form name="index" action="connexion_utilisateur.php" method="POST">

		<div class="row justify-content-start">
			<div class="col-4">
				<p>* champs requis</p>
			</div>
		</div>
		<div class="row justify-content-start p-2">
			<div class="col-5 ">
				Pseudo*
			</div>
			<div class="col-6 ">
			  <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo">
			</div>
				<small class="col-10">
					<?php
						if(isset($pseudoErr) && $pseudoErr){
							echo $pseudoErr;}
					?>
			  </small>
			<div class="row justify-content-start p-2">
				<div class="col-5 ">
					Mot de passe*
				</div>
				<div class="col-6 ">
				  <input type="password" name="motdepasse" id="motdepasse">
				</div>
					<small class="col-10">
						<?php
							if(isset($pwdErr) && $pwdErr){
								echo $pwdErr;
							}
						?>
				  </small class="col-10">
				<div class="row justify-content-center pt-5 col-5">
						<button type="submit" name="submit" class="btn btn-success">
						Se connecter
						</button>
				</div>
				<div class="row justify-content-center pt-5 col-5 m-2">
				<a href="https://bdw1.univ-lyon1.fr/p1501149/TP4/inscription.php"> Pas encore Inscrit ? </a></div>
				</div>
</body>
</html>