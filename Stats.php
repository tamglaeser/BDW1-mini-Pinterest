<?php
	require_once('bd.php');
	require_once('utilisateur.php');
	require_once('administrateur.php');
/*bdw1.univ-lyon1.fr/p1501149/tp4*/

session_start();
$temp=$_SESSION['expire'] - time(); //MARINE
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
<div style="background-image:url(img/accueil_bis.jpg);" ><B><h1>PhotouCat_Admin</h1></B><br>

<?php if (!isset($_SESSION['pseudo'])) {
    echo "Please Login again";
    header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/connexion.php');
}
else {
$now = time(); // Checking the time now when home page starts.

if ($now > $_SESSION['expire']) {
    session_destroy();
    header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/connexion.php');
}
else { //Starting this else one [else1]
?>
<!-- From here all HTML coding can be done -->
<h5>Welcome
    <?php
    echo $_SESSION['pseudo'];
    ?></h5>
        <h6> votre temps de connexion restant :  <?php
            echo $temp;
            ?></h6>

                <?php
                }
                }

                ?>
</div>

<nav class="crumbs">
	<form name="accueil_stats" action="Stats.php" method="POST">
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
    header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/page_administrateur.php');
    exit();
}
if (isset($_POST['deconnexion'])) {
    header('Location:https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/accueil.php');
    exit();
}


closeConnexion($conn);
?>