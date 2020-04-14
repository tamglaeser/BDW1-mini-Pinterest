<?php
function details($nomIm, $link) {
    $resultat = executeQuery($link, "SELECT description, catId FROM Photo WHERE nomFich=$nomIm");
    $src = glob($GLOBALS['dir'] .$nomIm, GLOB_BRACE);
    echo "<img src='" . $src . "' hspace = '10' border = '5'/>";

}
?>