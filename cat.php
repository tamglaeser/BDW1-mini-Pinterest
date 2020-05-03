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
require_once('bd.php');
session_start();
$temp=$_SESSION['expire'] - time();
$conn = getConnection($dbHost, $dbUser, $dbPwd, $dbName);
$dir = "assets/images/";

?>
<div class="head" ><B><h1>PhotoCat Admin</h1></B><br>
    <?php if (!isset($_SESSION['pseudo'])) {
        echo "Please Login again";
        header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/connexion.php');
    }
    else {
    $now = time(); // Checking the time now when home page starts.

    if ($now > $_SESSION['expire']) {
        session_destroy();
        header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/connexion.php');
    }
    else { //Starting this else one [else1]
    ?>
    <!-- From here all HTML coding can be done -->
    <h5>Welcome
        <?php
        echo $_SESSION['pseudo'];
        ?></h5>
            <h6> votre temps de connexion restant :  <?php
                echo $temp;
                ?></h6>

                    <?php
                    }
                    }

                    ?>
</div>
<nav class="crumbs">
    <form name="accueil" action="page_administrateur.php?pseudo<?php $_SESSION['pseudo']?>" method="POST">
        <button style="float: left;" type="submit" name="accueil" class="btn btn-success">
            Accueil
        </button>
        <div class='connexion'>
            
            <button style="float: right;" type="submit" name="deconnexion" class="btn btn-success">
                Deconnexion
            </button>
        </div>
    </form>
</nav><br>
<div class="row justify-content-center">
    <div class="block container p-4 m-4 border rounded border-dark" name='block'>
        <form action="cat.php" method="POST">
            <div class="row justify-content-start p-2">
                <div class="col-5 ">
                    Catégorie :
                </div>
                <div class="col-6 ">
                    <input type="text" name="cat" id="cat" placeholder="Catégorie">
                </div>

                <div class="row justify-content-start p-2">
                    <div style="margin-left:1em;">
                        ---------------------------------------------------------------
                    </div>
                    <div class="row justify-content-start p-4 m-2">
                        <div class="col-6 ">
                            <input type="submit" name="ajout" value="Ajouter"/>
                        </div>

                    </div>
                </div>


            </div>

        </form>

    </div>
</div>
<?php
if(isset($_POST["ajout"])){
    $cat=$_POST["cat"];
    executeUpdate($conn,"INSERT INTO Categorie (nomCat)VALUES(\"$cat\")");
    echo "Categorie ajoutée";
}
?>
</body>
</html>
<?php
/**
if (isset($_GET['catId'])) {
$Id = htmlspecialchars($_GET["catId"]);
include("function.php");
}**/


if (isset($_POST['accueil'])) {
    header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/page_administrateur.php?pseudo='.$pseudo);
    exit();
}
if (isset($_POST['deconnexion'])) {
    unset($_SESSION["pseudo"]);
    unset($_SESSION["motdepasse"]);
    header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/accueil.php');
    exit();
}


closeConnexion($conn);
?>
