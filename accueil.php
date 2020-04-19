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
	<form name="accueil" action="accueil.php" method="POST">
	   <button style="float: left;" type="submit" name="accueil" class="btn btn-success">
		Accueil
		</button>
		<div class='connexion'>
		<button style="float: right;" type="submit" name="connexion" class="btn btn-success">
		Connexion 
		</button>
		</div>
	</nav><br>
<form action="function.php" method="post">
<div style="display:flex; margin-left:16em;">
	<h5> Selection de la catégorie d'image à afficher : </h5>
    <!-- here start the dropdown list -->
	<div style='display:flex; margin-left:5em;'>
        <?php
        $resultat_cat = executeQuery($GLOBALS['conn'], "SELECT nomCat FROM Categorie");
        ?>
    <select name="dowpdown" >
        <option value="0">Toutes les photos</option>
        <?php
        $val = 0;
        while ($row_cat = $resultat_cat->fetch_assoc()){
            echo "<option value=" . ++$val . ">". $row_cat['nomCat'] . "</option>";
        }
        ?>
        <!--<option value="1">Animaux</option>
        <option value="2">Sport</option>
        <option value="3">Internet</option>
        <option value="4">Gens</option>-->
    </select>
    <input type="submit" name="show_dowpdown_value" value="Valider"/>
	</div>
	</div><br><br><br>
</form>
<?php if ((isset($_POST['show_dowpdown_value']) and $_POST['dowpdown'] !=0) or (isset($_GET['catId']))) {
    include("function.php");}
else {?>
    <h1>Toutes les photos</h1><?php
        $resultat_photoId = executeQuery($GLOBALS['conn'], "SELECT photoId FROM Photo");
        while ($row_photoId = $resultat_photoId->fetch_assoc()) {
            $resultat_imNom = executeQuery($GLOBALS['conn'], "SELECT nomFich FROM Photo WHERE photoId = " . $row_photoId["photoId"] );
            $row_imNom = $resultat_imNom->fetch_assoc();
            $images = glob($GLOBALS['dir'] . $row_imNom["nomFich"], GLOB_BRACE);
            foreach ($images as $image):
                echo "<a href='details.php?photoId=" . $row_photoId["photoId"] . "'><img src='" . $image . "' hspace = '10' border = '5'/></a>";
            endforeach;
        }
    }
?>
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
    header('Location:https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/accueil.php');
    exit();
}
if (isset($_POST['connexion'])) {
    header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/connexion.php');
    exit();
}

closeConnexion($conn);
?>