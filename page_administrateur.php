<?php
require_once('bd.php');
require_once ('administrateur.php');
session_start();
$pseudo = $_SESSION['pseudo'];


$temp=$_SESSION['expire'] - time(); //MARINE

$conn = getConnection('localhost', "p1926029", "ef5d0c", "p1926029");
$dir = "assets/images/";



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

<table class="head" ><tr><td><h1>PhotoCat Admin</h1>
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
            ?></h6></td>

            <?php
        }
    }

    ?><td><img src="img/accueil.jpg"/></td></tr></table>

<nav class="crumbs">
	<form name="accueil_admin" action="page_administrateur.php?pseudo=<?php echo $pseudo?>" method="post">
	   <button style="float: left;" type="submit" name="accueil" class="btn btn-success">
		Accueil
		</button>
        <!--MARINE-->
        <button style="float: left;" type="submit" name="compte" class="btn btn-success">
            Mon Compte
        </button>
        <button style="float: left;" type="submit" name="cat" class="btn btn-success">
            Ajouter Catégorie
        </button>
        <!--MARINE-->
        <div class='deconnexion'>
		<button style="float: right;" type="submit" name="deconnexion" class="btn btn-success">
		Deconnexion 
		</button>
		</div>
        <div class='ajouter'>
            <button style="float: right;" type="submit" name="ajouter" class="btn btn-success">
                Ajouter une Photo
            </button>
	</div>

<div class="Stats">
                <button style="float: left;" type="submit" name="Stats" class="btn btn-success">
                Statistique
                </button>
                </div>

    </form>
</nav>
    <?php
/**
if (isset($_GET['catId'])) {
    $Id = htmlspecialchars($_GET["catId"]);
    include("function.php");
}**/

if (isset($_POST['accueil'])) {
    header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/page_administrateur.php?pseudo='.$pseudo);
    exit();
}
if (isset($_POST['deconnexion'])) {
    unset($_SESSION["pseudo"]);
    unset($_SESSION["motdepasse"]);
    session_destroy();
    header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/accueil.php');
    exit();
}

/*MARINE*/
if (isset($_POST['compte'])) {
    header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/compte.php');
    exit();
}
if (isset($_POST['cat'])) {
    header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/cat.php');
    exit();
}
/*MARINE*/

if (isset($_POST['ajouter'])) {
    header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/ajouter.php');
    exit();
}

if (isset($_POST['Stats'])) {
    header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/Stats.php?pseudo='.$pseudo);
    exit();
}
 ?>
	
<form action="page_administrateur.php?pseudo=<?php $pseudo?>" method="post">
<table class="menu">
<tr>
	<td> Selection de la catégorie d'image à afficher : </td>
    <!-- here start the dropdown list -->
	<td>
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
        </select>
    <input type="submit" name="show_dowpdown_value" value="Valider"/>
	</td>
	</tr>
</table>
</form>
<?php if ((isset($_POST['show_dowpdown_value']) and $_POST['dowpdown'] !=0) or (isset($_GET['catId']))) {
    include("function.php");}
else {?>
	<h1>Toutes les photos</h1>
<div class="gallery"><?php
        $resultat_photoId = executeQuery($GLOBALS['conn'], "SELECT photoId FROM Photo");
        while ($row_photoId = $resultat_photoId->fetch_assoc()) {
            $resultat_imNom = executeQuery($GLOBALS['conn'], "SELECT nomFich FROM Photo WHERE photoId = " . $row_photoId["photoId"] );
            $row_imNom = $resultat_imNom->fetch_assoc();
            $images = glob($GLOBALS['dir'] . $row_imNom["nomFich"], GLOB_BRACE);
            foreach ($images as $image):
                echo "<a href='details.php?photoId=" . $row_photoId["photoId"] . "'><img src='" . $image . "' class = 'assets'/></a>";
            endforeach;
	}
	echo "</div>";
    }
?>
</body>
</html>



<?php
closeConnexion($conn);
?>
