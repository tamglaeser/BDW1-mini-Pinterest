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
    echo "ajouter";?>
    <form action="modifier.php" method="post" enctype="multipart/form-data">
        Choisir le fichier:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form>
<?php
}
?>
</body>
</html>
