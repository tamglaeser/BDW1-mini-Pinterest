<?php
	require_once('bd.php');
	require_once('utilisateur.php');
	require_once('administrateur.php');
?>

<?php
session_start();

?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Bienvenue sur PhotouCat</title>
  <link rel="stylesheet" href="bootstrap.css">
  <link rel="stylesheet" href="accueil.css">
</head>
<body>
<table class="head" ><tr><td><h1>PhotouCat</h1></td>
	<td><img src="img/accueil.jpg"/></td></tr></table>
<nav class="crumbs">
	<form name="accueil" action="accueil.php" method="POST">
	   <button style="float: left;" type="submit" name="accueil" class="btn btn-success">
		Accueil
		</button>
    </form>
</nav>

<!-- utilisation du framework bootstrap.
	Beaucoup de mot compliqués pour désigner une feuille de style toute prète.
-->

<div class="row justify-content-center">
	<div class="block container p-4 m-4 border rounded border-dark" name='block'>
		<form action="inscription.php" method="POST">

            <div class="row justify-content-start">
                <div class="col-4">
                    <p>* champs requis</p>
                </div>
            </div>
            <div  class="row justify-content-start p-2">
                <div class="col-5" >
                    Selection type utilisateur*
                </div>
                <div class="col-6">
                <!--<form action="function.php" method="post">-->
                    <select name="dowpdown" >
                        <option value="0">Administrateur</option>
                        <option value="1" SELECTED>Utilisateur</option>
                    </select>
                <!--</form>-->
                </div>
                <div class="row justify-content-start p-2">
                    <div class="col-5 ">
                        Pseudo*
                    </div>
                    <div class="col-6 ">
                        <input type="text" name="pseudo"  placeholder="Pseudo">
                    </div>
                    <small class="col-10">
                        <?php
                            if(isset($pseudoErr) && $pseudoErr){
                                echo $pseudoErr;}
                        ?>
                    </small>
                    <div class="row justify-content-start p-2">
                        <div class="col-5 ">
                            Mot de passe*
                        </div>
                        <div class="col-6 ">
                            <input type="password" name="motdepasse" >
                        </div>
                        <small class="col-10">
                            <?php
                                if(isset($pwdErr) && $pwdErr){
                                    echo $pwdErr;
                                }
                            ?>
                        </small class="col-10">
                        <div class="row justify-content-start p-2">
                            <div class="col-5">
                                Confirmez votre Mot de passe
                            </div>
                            <div class="col-6 ">
                                <input type="password" name="confmotdepasse" >
                            </div>
                            <small class="col-10">
                                <?php
                                    if(isset($confpwdErr) && $confpwdErr){
                                        echo $confpwdErr;
                                    }
                                ?>
                            </small>
                        </div>
                        <div style="display:flex;margin-top:0em; margin-left:9em; padding-right:8em;padding-left:2em;">
                        <input type="submit" name="submit" value="Valider"/>
                        </div>
                    </div>
                </div>
            </div>
            <div style="padding-left:2em;">
                <a href="https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/connexion.php"> Déja Inscrit ? </a>
            </div>
        </form>
    </div>
</div>







<?php


/*Cette fonction doit être définie hors d'une condition (if/else), donc on la définie avant de l'utiliser dans une boucle*/
function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['submit'])) {

    $pseudo = $_POST["pseudo"];
    $pwd = $_POST["motdepasse"];
    $confpwd = $_POST["confmotdepasse"];

    if (empty($_POST["pseudo"])){
        $pseudoErr = "Il vous faut un pseudo";
    }
    else {
        $pseudo = test_input($_POST["pseudo"]);
        $pseudoErr = "";
    }
    if (empty($_POST["motdepasse"])) {
        $pwdErr = "le mot de passe est requis";
    }
    else {
        $pwd = test_input($_POST["motdepasse"]);
    }
    if (empty($_POST["confmotdepasse"])) {
        $confpwd = " la confirmation de mot de passe est requis";
    }
    else {
        $confpwd = test_input($_POST["confmotdepasse"]);
    }

    if ( isset($pwd) && $pwd != $confpwd){
        $pwdErr = "le mot de passe n'est pas le même que le champ d'en dessous";
        $confpwd = " la confirmation de mot de passe n'est pas la même qu'au dessus";
    }
    if ( ! (empty($_POST["pseudo"]) || empty($_POST["motdepasse"]) || empty($_POST["confmotdepasse"])) ) {
        $link = getConnection('localhost', "p1926029", "ef5d0c", "p1926029");
        if($_POST['dowpdown'] ==0){
            if(checkAvailabilityAdmin($pseudo, $link)==1){
                registerAdmin($pseudo, $pwd, $link);
                header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/connexion.php');
                exit();
            }
            else {
                $pseudoErr="pseudo déjâ pris";
            }
        }
        else{
            if(checkAvailabilityUtil($pseudo, $link)==1){
                registerUtil($pseudo, $pwd, $link);
                header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/connexion.php');
                exit();
            }
            else {
                $pseudoErr="pseudo déjâ pris";
            }
        }

    }
}


if (isset($_POST['accueil'])) {
    header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/accueil.php');
    exit();
}
?>


</body>
</html>
