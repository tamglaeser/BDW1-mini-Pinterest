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
echo $_GET['photoId'];
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
    endforeach;?>

    <table>
        
    </table>

    <?php
}

?>
<button onclick="goBack()">Go Back</button>

<script>
    function goBack() {
        window.history.back();
    }
</script>

</body>
</html>
