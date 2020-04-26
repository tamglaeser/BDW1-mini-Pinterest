<?php
$pseudo = $_SESSION['pseudo'];
?>

<form action="caches.php" method="post">
    <div style="display:flex; margin-left:16em;">
        <h5> Selection de la catégorie d'image à afficher : </h5>
        <!-- here start the dropdown list -->
        <div style='display:flex; margin-left:5em;'>
            <?php
            // seulement afficher ses categories
            $resultat_cat = executeQuery($GLOBALS['conn'], "SELECT DISTINCT c.nomCat, c.catId FROM Categorie c JOIN Photo p ON p.catId=c.catId WHERE p.utilId IN (SELECT utilId FROM utilisateur WHERE utilPseudo='" . $pseudo . "') AND p.statut='cache'");
            ?>
            <select name="dowpdown" >
                <option value="0">Toutes les photos</option>
                <?php
                //$val = 0;

                while ($row_cat = $resultat_cat->fetch_assoc()){
                    echo "<option value=" . $row_cat['catId'] . ">". $row_cat['nomCat'] . "</option>";
                }
                ?>
            </select>
            <input type="submit" name="show_dowpdown_value" value="Valider"/>
        </div>
    </div><br><br><br>
</form>
<?php if ((isset($_POST['show_dowpdown_value']) and $_POST['dowpdown'] !=0) or (isset($_GET['catId']))) {
    //$qui = 'util';
    include("function.php");
}

else {?>
    <h1>Toutes les photos</h1><?php
    // seulement afficher ses photos
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
