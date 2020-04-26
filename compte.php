<!-- MARINE -->

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
session_start();
$temp=$_SESSION['expire'] - time();
require_once('bd.php');
require_once('administrateur.php');
require_once('utilisateur.php');
$pseudo = $_SESSION['pseudo'];
$pwd = $_SESSION['motdepasse'];
$conn = getConnection($dbHost, $dbUser, $dbPwd, $dbName);
$dir = "assets/images/";
?>
<div style="background-image:url(img/accueil_bis.jpg);" ><B><h1>PhotoCat </h1></B><br>
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
    <form name="accueil" action="compte.php" method="POST">
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
        <form action="compte.php" method="POST">
            <div class="row justify-content-start p-2">
                <div class="col-5 ">
                    Pseudo :
                </div>
                <div class="col-6 ">
                    <?php echo $pseudo;?>
                </div>
                <div class="row justify-content-start p-2">
                    <div>
                        ---------------------------------------------------------------
                    </div>
                    <div class="row justify-content-start p-2">
                        <div class="col-5 ">
                            Mot de passe :
                        </div>
                        <div class="col-4 ">
                            <?php echo $pwd;?>
                        </div>
                        <div class="row justify-content-start p-2">
                            <div style="margin-left:1em;">
                                ---------------------------------------------------------------
                            </div>
                            <div class="row justify-content-start p-4 m-2">
                                <div class="col-6 ">
                                    <input type="submit" name="modif" value="modifier"/>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>

    </div>
</div>
<?php
if (isset($_POST['modif'])){?>
    <div class="row justify-content-center">
        <div class="block container p-4 m-4 border rounded border-dark" name='block'>
            <form action="compte.php" method="POST">
                <div class="row justify-content-start">
                    <div class="col-4">
                        <p>* champs requis</p>
                    </div>
                </div>
                <div class="row justify-content-start p-2">
                    <div class="col-5 ">
                        Pseudo* :
                    </div>
                    <div class="col-6 ">
                        <input type="text" name="p" id="p" placeholder="Pseudo">
                    </div>
                    <div class="row justify-content-start p-2">
                        <div class="col-5 ">
                            Mot de passe* :
                        </div>
                        <div class="col-4 ">
                            <input type="password" name="m" id="m">
                        </div>

                        <div class="row justify-content-start p-4 m-2">
                            <div class="col-6 ">
                                <input type="submit" name="val" value="valider"/>
                            </div>


                        </div>
                    </div>
                </div>

            </form>

        </div>
    </div>


<?php } ?>
<?php

if (isset($_POST['val'])){
    $m=$_POST['m'];
    $p=$_POST['p'];
    if(getUserAdmin($pseudo, $pwd, $conn) == 1) {
        executeUpdate($conn,"UPDATE administrateur SET adminMdp= \"$m\" ,adminPseudo= \"$p\"");
        $_SESSION['motdepasse']=$m;
        $_SESSION['pseudo']=$p;
        $pseudo = $p;//MARINE
        $pwd = $m;//MARINE
        header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/page_administrateur.php?pseudo='.$pseudo);
        exit();

    }else{
        if(getUserUtil($pseudo, $pwd, $conn) == 1) {

            executeUpdate($conn,"UPDATE utilisateur SET utilMdp= \"$m\" ,utilPseudo= \"$p\"");
            $_SESSION['motdepasse']=$m;
            $_SESSION['pseudo']=$p;
            $pseudo=$p; //MARINE
            $pwd=$m; //MARINE

            header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/page_utilisateur.php?pseudo='.$pseudo);
            exit();

        }

    }
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
    if(getUserAdmin($pseudo, $pwd, $conn) == 1) {
        header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/page_administrateur.php?pseudo='.$pseudo);
    }
    if(getUserUtil($pseudo, $pwd, $conn) == 1) {
        header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/page_utilisateur.php?pseudo='.$pseudo);
    }
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
