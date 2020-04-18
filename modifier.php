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

    $resultat_categorie = executeQuery($GLOBALS['conn'], "SELECT nomCat FROM Categorie");

    ?>
    <h1>Quelle photo?</h1>
    <form action="modifier.php" method="post" enctype="multipart/form-data">
        Choisir le fichier:<br>
        <input type="file" name="Parcourir.." id="fileToUpload">
        <!--<br>Décrire la photo en une phrase:<br>
        <input type="text">
        <br>Choisir une catégorie:<br>
        <input list="categories" name="catgeorie">
        <datalist id="categories"><?php/*
            while ($row_categorie = $resultat_categorie->fetch_assoc()) {
                echo "<option value=" . $row_categorie["nomCat"] . ">" .$row_categorie["nomCat"] . "</option>";
            }*/?>
        </datalist>-->
        <input type="submit" value="Envoyer" name="submit">
    </form>
<?php
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
    }
}
?>
</body>
</html>