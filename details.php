<?php session_start();
require_once ('bd.php');
require_once ('administrateur.php');
require_once ('utilisateur.php');
require_once ('function.php');

$photoId = $_GET['photoId'];
$_SESSION['photoId']=$photoId;
if(isset($_SESSION['pseudo'])){$pseudo = $_SESSION['pseudo'];}
if(isset($_SESSION['motdepasse'])){$pwd = $_SESSION['motdepasse'];}


$conn = getConnection('localhost', "p1501149", "49afdf", "p1501149");
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
<div style="background-image:url(img/accueil_bis.jpg);" ><B><h1>PhotoCat</h1></B><br> </div>
	<nav class="crumbs">
	<?php 
	if(empty($_SESSION['pseudo']) && empty($_SESSION['motdepasse'])){
		echo "<a href='accueil.php'>ACCUEIL</a>";
	}else{
		
		if(getUserAdmin($pseudo, $pwd, $conn) == 1) { 
			echo "<a href='page_administrateur.php'>ACCUEIL</a>";
				
		}else{
					
			if(getUserUtil($pseudo, $pwd, $conn) == 1) {
				echo "<a href='page_utilisateur.php'>ACCUEIL</a>";
					
			}
		}
	}
?>
	</nav><br>

<?php

$dir = "assets/images/";

details($photoId, $conn);

function details($ImageId, $link) {?>
    <h1>Les détails sur cette photo</h1><br><br><p> <p><br><br>
    <?php
    $resultat_imNom = executeQuery($link, "SELECT nomFich FROM Photo WHERE photoId = $ImageId");
    $row_imNom = $resultat_imNom->fetch_assoc();
    $images = glob($GLOBALS['dir'] . $row_imNom["nomFich"], GLOB_BRACE);?>
	<div class="row justify-content-center " style="margin:1em;padding:0;">
   <div  class="row justify-content-start p-2">
   <div class="col-4" >
   <?php foreach ($images as $image):
        echo "<img src='" . $image . "' hspace = '10' border = '5'/>";
    endforeach;

    $resultat_description = executeQuery($link, "SELECT description FROM Photo WHERE photoId = $ImageId");
    $row_description = $resultat_description->fetch_assoc();

    $resultat_cat = executeQuery($link, "SELECT nomCat FROM Categorie WHERE catId = (SELECT catId FROM Photo WHERE photoId = $ImageId)");
    $row_cat = $resultat_cat->fetch_assoc();

    $resultat_cat_Id = executeQuery($link, "SELECT catId FROM Photo WHERE photoId = $ImageId");
    $row_cat_id = $resultat_cat_Id->fetch_assoc();
    ?>
	</div>
	<div class="col-8" >
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
	</div>
	</div>
	</div>
	</br></br>
		<?php 
	if(empty($_SESSION['pseudo']) && empty($_SESSION['motdepasse'])){
		
	}else{
		if(getUserAdmin($_SESSION['pseudo'], $_SESSION['motdepasse'], $link) == 1) { 
			$pseudo = $_SESSION['pseudo'];?>
			<div class="row justify-content-center p-2">
			<a href="https://bdw1.univ-lyon1.fr/p1501149/bdw1_projet-master/sup.php"> supprimer la photo</a><br>
			
			
			<a href="https://bdw1.univ-lyon1.fr/p1501149/bdw1_projet-master/modif.php"> modifier les détails </a><br>
			</div>
			<?php
	
		}else{
					
			if(getUserUtil($_SESSION['pseudo'], $_SESSION['motdepasse'], $link) == 1) { 

		
			?>	<div class="row justify-content-center p-2">
				<a href="https://bdw1.univ-lyon1.fr/p1501149/bdw1_projet-master/sup.php"> supprimer la photo</a><br>
				<a href="https://bdw1.univ-lyon1.fr/p1501149/bdw1_projet-master/modif.php"> modifier les détails </a><br>
				</div>
				<?php
				
					
			}
		}
	}

			

		
    
}	?>


		
</body>
</html>