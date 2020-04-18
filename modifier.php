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
require_once ('bd.php');
$conn = getConnection('localhost', "p1926029", "ef5d0c", "p1926029");
$dir = "assets/images/";

ajouter();

if (isset($_POST['ajouter'])) {
ajouter();
}


function ajouter(){

    //$resultat_categorie = executeQuery($GLOBALS['conn'], "SELECT nomCat FROM Categorie");

    ?>

<form action="modifier.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

<!--
    <h1>Quelle photo?</h1>
    <form action="modifier.php" method="post" enctype="multipart/form-data">
        Choisir le fichier:<br>
        <input type="file" name="Parcourir.." id="fileToUpload">
        <br>Décrire la photo en une phrase:<br>
        <input type="text">
        <br>Choisir une catégorie:<br>
        <input list="categories" name="catgeorie">
        <datalist id="categories"><?php /*
            while ($row_categorie = $resultat_categorie->fetch_assoc()) {
                echo "<option value=" . $row_categorie["nomCat"] . ">" .$row_categorie["nomCat"] . "</option>";
            }*/?>
        </datalist>
        <input type="submit" value="Envoyer" name="submit">
    </form>
<?php /*
    $target_dir = "assets/images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["id"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_id"]);
        if($check !== false) {
            echo "Fichier est bien une image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "Fichier n'est pas une image.";
            $uploadOk = 0;
        }

    }

    //Voir si le fichier existe deja
    if (file_exists($target_file)) {
        echo "Desolé, le fichier existe déjà.";
        $uploadOk = 0;
    }
    // Voir taille du fichier
    if ($_FILES["fileToUpload"]["size"] > 100000) {
        echo "Desolé, ton fichier est trop grand.";
        $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif") {
        echo "Desolé, on n'accepte que les fichiers JPG, PNG & GIF.";
        $uploadOk = 0;
    }

    // Voir si $uploadOk est mis a 0 par un erreur
    if ($uploadOk == 0) {
        echo "Desolé, ton fichier n'était pas téléchargé.";
    // si tout va bien, essayer de télécharger le fichier
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_id"], $target_file)) {
            echo "Le fichier ". basename( $_FILES["fileToUpload"]["id"]). " était téléchargé.";
        } else {
            echo "Désolé, il y avait un erreur téléchargant ton fichier.";
        }
    } */


$target_dir = "/home/tullia/Documents/School/Tulane_University/Junior_Year/BDW1/ProjetFinale/bdw1_projet/assets/images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
echo "BEFORE $-POST SUBMIT??";
if(isset($_POST["submit"])) {
    echo "SUBMITTED";

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
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
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "SHLD BE UPLOADED";
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "NOT UPLOADED???";
        echo "Sorry, there was an error uploading your file.";
    }
}
}
}


?>

?> -->
</body>
</html>