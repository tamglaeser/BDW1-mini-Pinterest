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

<h1>Quelle photo?</h1>
<form action="ajouter.php?pseudo=<?php echo $_GET['pseudo']?>" method="post" enctype="multipart/form-data">
    Choisir le fichier:<br>
        <!--<label for="fileToUpload" class="btn btn-primary">Parcourir..</label>-->
    <script>$('#fileToUpload').inputFileText({
            text: 'Parcourir..'
        });</script>
    <input type="file" name="fileToUpload" id="fileToUpload"><br>
    Décrire la photo en une phrase:<br>
    <input type="text" name="description" id="description"><br>
    Choisir une catégorie:<br>
    <select name="categories" id="categories" size="3">
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

</body>
</html>

<?php
$target_dir = "assets/images/";
//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
//$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {

    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

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
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";


            $resultat_utilId = executeQuery($GLOBALS['conn'], "SELECT utilId FROM utilisateur WHERE utilPseudo='" . $_GET['pseudo'] . "'");
             while ($row_utilId=$resultat_utilId->fetch_assoc()) {

                 $resultat_nom = executeQuery($GLOBALS['conn'], "INSERT INTO Photo(nomFich, description, catId, utilId) VALUES ('" . basename($_FILES["fileToUpload"]["name"]) . "', '" . $_POST["description"] . "', " . $_POST["categories"] . ", " . $row_utilId["utilId"]);
             }
            
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    
}
?>