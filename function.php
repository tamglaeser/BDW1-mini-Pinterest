<?php

if (isset($_POST['show_dowpdown_value'])) {

    $catId = $_POST['dowpdown']; // this will print the value if downbox out
    category($catId, $conn);
}


require_once('bd.php');
$conn = getConnection('localhost', "p1926029", "ef5d0c", "p1926029");

$dir = "assets/images/";

function category(int $cat, $link) {
    $resultat = executeQuery($link, "SELECT nomFich FROM Photo WHERE catId = $cat");
    //$sql = "SELECT nomFich FROM Photo WHERE catId = $cat";
    //$resultat = $link->query($sql);
    while($row = $resultat->fetch_assoc()) {
        //echo "nomFich: " . $row["nomFich"] . " ";
        $images = glob($GLOBALS['dir'] . $row["nomFich"], GLOB_BRACE);
        foreach ($images as $image):
            echo "<img src='" . $image . "' />";

        endforeach;
    }
}

?>