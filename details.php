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
echo $_GET['photoId'];
$photoId = $_GET['photoId'];
$conn = getConnection('localhost', "p1926029", "ef5d0c", "p1926029");

details($photoId, $conn);

function details($ImageId, $link) {
    $resultat = executeQuery($link, "SELECT description, catId FROM Photo WHERE nomFich=$nomIm");
    $src = glob($GLOBALS['dir'] .$nomIm, GLOB_BRACE);
    echo "<img src='" . $src . "' hspace = '10' border = '5'/>";

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
