<?php
function category(string $cat, $link) {
    echo "la category: ".$cat;
    $catId = executeQuery($link,"SELECT catId FROM Categorie WHERE nomCat ='". $cat. "'");
    echo $catId->fetch_assoc()['catId'];
    /*
    $sql = "SELECT nomFich FROM Photo WHERE catId = $catId";
    $resultat = $link->query($sql);
    while($row = $resultat->fetch_assoc()) {
        echo "nomFich: " . $row["nomFich"] . " ";
        //$im = glob($GLOBALS['dir'] . $nomFich, GLOB_BRACE);
        //echo "<img src='" . $im . "' />";
    }*/
}
?>