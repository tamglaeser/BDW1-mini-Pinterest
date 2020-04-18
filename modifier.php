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
        <br>Décrire la photo en une phrase:<br>
        <input type="text">
        <br>Choisir une catégorie:<br>
        <input list="categories" name="catgeorie">
        <datalist id="categories"><?php
            while ($row_categorie = $resultat_categorie->fetch_assoc()) {
                echo "<option value=" . $row_categorie["nomCat"] . ">" .$row_categorie["nomCat"] . "</option>";
            }?>
        </datalist>
        <input type="submit" value="Envoyer" name="submit">
    </form>
<?php
}
?>
</body>
</html>