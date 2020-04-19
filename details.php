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
session_start();
require_once ('bd.php');
require_once ('administrateur.php');
require_once ('utilisateur.php');
require_once ('function.php');
$photoId = $_GET['photoId'];
$pseudo= $_SESSION['pseudo'];
$pwd= $_SESSION['motdepasse'];

$conn = getConnection('localhost', "p1501149", "49afdf", "p1501149");
$dir = "assets/images/";

details($photoId, $conn);

function details($ImageId, $link) {?>
    <h1>Les détails sur cette photo</h1><br><br><p> <p><br><br>
    <?php
    $resultat_imNom = executeQuery($link, "SELECT nomFich FROM Photo WHERE photoId = $ImageId");
    $row_imNom = $resultat_imNom->fetch_assoc();
    $images = glob($GLOBALS['dir'] . $row_imNom["nomFich"], GLOB_BRACE);
    foreach ($images as $image):
        echo "<img src='" . $image . "' hspace = '10' border = '5'/>";
    endforeach;

    $resultat_description = executeQuery($link, "SELECT description FROM Photo WHERE photoId = $ImageId");
    $row_description = $resultat_description->fetch_assoc();

    $resultat_cat = executeQuery($link, "SELECT nomCat FROM Categorie WHERE catId = (SELECT catId FROM Photo WHERE photoId = $ImageId)");
    $row_cat = $resultat_cat->fetch_assoc();

    $resultat_cat_Id = executeQuery($link, "SELECT catId FROM Photo WHERE photoId = $ImageId");
    $row_cat_id = $resultat_cat_Id->fetch_assoc();
    ?>


    <table>
        <tr>
            <th>Description</th>
            <td>
                <?php
                echo $row_description['description'];
                ?>
            </td>
        </tr>
        <tr>
        <th>Nom du fichier</th>
        <td>
            <?php
            echo $row_imNom['nomFich'];
            ?>
        </td>
        </tr>
        <tr>
            <th>Catégorie</th>
            <td>
                <?php
                echo "<a href='accueil.php?catId=" . $row_cat_id['catId']. "'>" . $row_cat['nomCat'] . "</a>";
                ?>
            </td>
        </tr>
    </table>
	</br></br>
		<form method="POST">
			<input name="supression" id="sup" type="submit" value="supprimer la photo">
			
		</form>
		
		
			

		
    <?php
}	
//$url = htmlspecialchars($_SERVER['HTTP_REFERER']);?><script>
			var btn = document.querySelector('input');
			var aff = document.querySelector('p');
		</script>	<?php
			echo "p";
			 if (isset($_POST['supression'])) {
				 include("sup.php");
			 }
			?>



</body>
</html>
