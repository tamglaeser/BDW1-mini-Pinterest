<?php
session_start();
$temp=$_SESSION['expire'] - time(); //MARINE

$pseudo = $_SESSION['pseudo'];
$pwd = $_SESSION['motdepasse'];

require_once('bd.php');
require_once ('utilisateur.php');
require_once ('administrateur.php');


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

<table class="head"><tr><td><h1>PhotouCat</h1> 
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
        <form name="accueil" action="ajouter.php" method="POST">
           <button style="float: left;" type="submit" name="accueil" class="btn btn-success">
            Accueil
            </button>
        </form>
    </nav>
<div class="menu">&nbsp;</div>
    <div class="row justify-content-center">
        <div class="block container p-4 m-4 border rounded border-dark" name='block'>

<h1>Quelle photo?</h1>


<form action="ajouter.php" method="post" name = "Ajouter" enctype="multipart/form-data">
    Choisir le fichier:<br>
        <!--<label for="fileToUpload" class="btn btn-primary">Parcourir..</label>-->
    <script>$('#fileToUpload').inputFileText({
            text: 'Parcourir..'
        });</script>
    <input type="file" name="fileToUpload" id="fileToUpload" required><br>
    Décrire la photo en une phrase:<br>
    <input type="text" name="description" id="description" required><br>
    Choisir une catégorie:<br>
    <select name="categories" id="categories" size="3" required>
        <option value="0">Toutes les photos</option>
        <?php
        $resultat_cat = executeQuery($GLOBALS['conn'], "SELECT nomCat FROM Categorie");
        $val = 0;
        while ($row_cat = $resultat_cat->fetch_assoc()){
            echo "<option value=" . ++$val . ">". $row_cat['nomCat'] . "</option>";
        }
        ?>
    </select><br>
    <input type="submit" value="Envoyer" name="submit">
</form>
</div>
</div>
</body>
</html>



<?php


function getValue($key) {
    if (!isset($_GET[$key])) {
        return false;
    }
    return $_GET[$key];
}



$target_dir = "assets/images/";
//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
//$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {


    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    echo "imagefiletype : " . $imageFileType;

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

// Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
// Check file size
    if ($_FILES["fileToUpload"]["size"] > 100000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }




// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    }

    else {


        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";


            if (getUserUtil($pseudo, $pwd, $conn) == 1) {
                $resultat_utilId = executeQuery($GLOBALS['conn'], "SELECT utilId FROM utilisateur WHERE utilPseudo='" . $_SESSION['pseudo'] . "'");
                while ($row_utilId = $resultat_utilId->fetch_assoc()) {
                    $resultat_nom = executeQuery($GLOBALS['conn'], "INSERT INTO Photo(nomFich, description, catId, utilId, statut) VALUES ('" . basename($_FILES["fileToUpload"]["name"]) . "', '" . $_POST["description"] . "', " . $_POST["categories"] . ", " . $row_utilId["utilId"] . ", 'montre')");
                }
            }

            // FIXER -- ON A PAS LA UTILID POUR CHAQUE UTILID???
            else if (getUserAdmin($pseudo, $pwd, $conn) == 1) {
                echo "on rentre pour ajouter pour admin";
                /*$resultat_utilId = executeQuery($GLOBALS['conn'], "SELECT utilId FROM utilisateur");
                while ($row_utilId = $resultat_utilId->fetch_assoc()) {
                    $resultat_nom = executeQuery($GLOBALS['conn'], "INSERT INTO Photo(nomFich, description, catId, utilId, statut) VALUES ('" . basename($_FILES["fileToUpload"]["name"]) . "', '" . $_POST["description"] . "', " . $_POST["categories"] . ", " . $row_utilId["utilId"] . ", 'montre')");
                }*/
                $resultat_add_admin = executeQuery($GLOBALS['conn'], "INSERT INTO Photo(nomFich, description, catId, statut) VALUES ('" . basename($_FILES["fileToUpload"]["name"]) . "', '" . $_POST["description"] . "', " . $_POST["categories"] . ", 'montre')");

            }

             $resultat_photoId = executeQuery($GLOBALS['conn'], "SELECT photoId FROM Photo WHERE nomFich='".basename($_FILES["fileToUpload"]["name"])."'");
             while ($row_photoId = $resultat_photoId->fetch_assoc()) {
                 $photoId=$row_photoId['photoId'];
             }
            header("Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/details.php?photoId=" . $photoId);


        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    
}
?>
<?php 
if(isset($_POST['accueil'])){
		if(getUserAdmin($pseudo, $pwd, $conn) == 1) {
			header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/page_administrateur.php?pseudo='.$pseudo);
				
		}else{
					
			if(getUserUtil($pseudo, $pwd, $conn) == 1) {
				header('Location:https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/page_utilisateur.php?pseudo='.$pseudo);
					
			}
		}
	
}
?>
