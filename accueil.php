
<?php
session_start();
 if (isset($_POST['submit'])) {
	header('Location: https://bdw1.univ-lyon1.fr/p1501149/Projet/src/index.php');
	exit();
								
								}
						
?>

<!doctype html>
<html lang="fr" style="background-image:url(data/accueil.jpg);">
<head>
  <meta charset="utf-8">
  <title>Accueil</title>
  <link rel="stylesheet" href="bootstrap.css">
  <link rel="stylesheet" href="accueil.css">
</head>
<body>
	 <section>
	 <form name="accueil" action="accueil.php" method="POST">
		<h1>Bienvenue sur PhotouCat</h1><br>
			<div> 
				Pour entrer sur le site cliqué ici
			</div><br>
						<button type="submit" name="submit" class="btn btn-success">
							Entrer
						</button>	
		</section>
</body>
</html>