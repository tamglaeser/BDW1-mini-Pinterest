<?php
	require_once('bd.php');
	require_once('utilisateur.php');
/*bdw1.univ-lyon1.fr/p1501149/tp4*/

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
  <title>Bienvenue sur PhotouCat</title>
  <link rel="stylesheet" href="bootstrap.css">
  <link rel="stylesheet" href="accueil.css">
</head>
<body>
<div style="background-image:url(img/accueil_bis.jpg);" ><B><h1>PhotouCat_Util</h1></B><br>
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

    ?></div>



    <nav class="crumbs">
	<form name="accueil_util" action="page_utilisateur.php?pseudo=<?php echo $pseudo?>" method="post">
	    <button style="float: left;" type="submit" name="accueil" class="btn btn-success">
		Accueil
		</button>
        <button style="float: left;" type="submit" name="compte" class="btn btn-success">
            Mon Compte
        </button>
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
	</nav></br>
<form action="page_utilisateur.php?pseudo=<?php echo $pseudo?>" method="post">
<div style="display:flex; margin-left:16em;">
	<h5> Selection de la catégorie d'image à afficher : </h5>
    <!-- here start the dropdown list -->
	<div style='display:flex; margin-left:5em;'>
        <?php
        // seulement afficher ses categories
        $resultat_cat = executeQuery($GLOBALS['conn'], "SELECT DISTINCT c.nomCat FROM Categorie c JOIN Photo p ON p.catId=c.catId WHERE p.utilId IN (SELECT utilId FROM utilisateur WHERE utilPseudo='" . $pseudo . "')");
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
	</div>
	</div><br><br><br>
</form>
<?php if ((isset($_POST['show_dowpdown_value']) and $_POST['dowpdown'] !=0) or (isset($_GET['catId']))) {
    include("function.php?util");}
else {?>
    <h1>Toutes les photos</h1><?php
        // seulement afficher ses photos
        echo "PSEUDO :" . $pseudo;
        $resultat_photoId = executeQuery($GLOBALS['conn'], "SELECT DISTINCT p.photoId FROM Photo p WHERE p.utilId IN (SELECT u.utilId FROM utilisateur u WHERE u.utilPseudo = '" . $pseudo . "')");
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



if (isset($_POST['accueil'])) {
    header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/page_utilisateur.php?pseudo='.$pseudo);
    exit();
}
//MARINE
if (isset($_POST['compte'])) {
    header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/compte.php');
    exit();
}
//MARINE

if (isset($_POST['deconnexion'])) {
    setDisconnectedUtil($pseudo, $conn);
    //MARINE
    unset($_SESSION["pseudo"]);
    unset($_SESSION["motdepasse"]);
    session_destroy();
    //MARINE
    header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/accueil.php');
    exit();
}

if (isset($_POST['ajouter'])) {
    header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/ajouter.php?qui=util&pseudo='.$pseudo);
}


closeConnexion($conn);
?>