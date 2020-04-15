<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>PhotouCat</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="index.css">
</head>
<body>



<?php
require_once ('bd.php');
$photoId = $_GET['photoId'];

$conn = getConnection('localhost', "p1926029", "ef5d0c", "p1926029");
$dir = "assets/images/";

details($photoId, $conn);

function details($ImageId, $link) {?>
    <h1>Les détails sur cette photo</h1>
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
                echo $row_cat['nomCat'];

                echo "<a href='function.php?catId=" . $row_cat_id['catId']. "'>" . $row_cat['nomCat'] . "</a>"?>
            </td>
        </tr>
    </table>

    <?php
}
$url = htmlspecialchars($_SERVER['HTTP_REFERER']);
echo "<a href='$url'>BACK</a>";

?>


</body>
</html>
