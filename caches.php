<?php
//require_once ('page_utilisateur.php');
require_once ('bd.php');
$pseudo = $GLOBALS['pseudo'];
$conn = getConnection('localhost', "p1926029", "ef5d0c", "p1926029");

?>

<form action="caches.php" method="post">
    <div style="display:flex; margin-left:16em;">
        <h5> Selection de la catégorie d'image à afficher : </h5>
        <!-- here start the dropdown list -->
        <div style='display:flex; margin-left:5em;'>
            <?php
            // seulement afficher ses categories
            $resultat_cat = executeQuery($GLOBALS['conn'], "SELECT DISTINCT c.nomCat, c.catId FROM Categorie c JOIN Photo p ON p.catId=c.catId WHERE p.utilId IN (SELECT u.utilId FROM utilisateur u WHERE u.utilPseudo='" . $pseudo . "') AND p.statut='cache'");
            ?>
            <select name="dowpdown_cache" >
                <option value="0">Toutes les photos</option>
                <?php
                //$val = 0;

                while ($row_cat = $resultat_cat->fetch_assoc()){
                    echo "<option value=" . $row_cat['catId'] . ">". $row_cat['nomCat'] . "</option>";
                }
                ?>
            </select>
            <input type="submit" name="show_dowpdown_cache_value" value="Valider"/>
        </div>
    </div><br><br><br>
</form>
<?php if ((isset($_POST['show_dowpdown_cache_value']) and $_POST['dowpdown_cache'] !=0)) {

    echo "enter into photos caches categorie";

    //$qui = 'util';
    include("function.php");
}

else {?>
    <h1>Toutes les photos</h1><?php
    // seulement afficher ses photos

    echo "enter into all photos in caches.php";

    $resultat_photoId = executeQuery($GLOBALS['conn'], "SELECT DISTINCT p.photoId FROM Photo p WHERE p.utilId IN (SELECT u.utilId FROM utilisateur u WHERE u.utilPseudo = '" . $pseudo . "') AND p.statut = 'cache'");
    while ($row_photoId = $resultat_photoId->fetch_assoc()) {
        $resultat_imNom = executeQuery($GLOBALS['conn'], "SELECT nomFich FROM Photo WHERE photoId = " . $row_photoId["photoId"] );
        $row_imNom = $resultat_imNom->fetch_assoc();
        $images = glob($GLOBALS['dir'] . $row_imNom["nomFich"], GLOB_BRACE);
        foreach ($images as $image):
            echo "<a href='details.php?photoId=" . $row_photoId["photoId"] . "'><img src='" . $image . "' hspace = '10' border = '5'/></a>";
        endforeach;
    }
}?>
