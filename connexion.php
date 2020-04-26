<?php
	require_once('bd.php');
	require_once('utilisateur.php');
	require_once('administrateur.php');
/*bdw1.univ-lyon1.fr/p1501149/tp4*/

?>

<?php
session_start();
 if (isset($_POST['accueil'])) {
	header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/accueil.php');
	exit();
}
if (isset($_POST['submit'])) {

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
	$link = getConnection('localhost', "p1926029", "ef5d0c", "p1926029");
	if(isset($_POST["pseudo"])){
		if ((isset($pseudo)) &&( isset($pwd))){
			//$link=getConnection($dbHost, $dbUser, $dbPwd, $dbName);
			if($_POST['dowpdown'] ==0){
				if(getUserAdmin($pseudo, $pwd, $link) != 1) { 
				
					$pwdErr = "le pseudo/mot de passe sont erroné ou l'admin n'existe pas";
				}
			}
			else{
				if(getUserUtil($pseudo, $pwd, $link) != 1) {
				   		
					$pwdErr = "le pseudo/mot de passe sont erroné ou l'utilisateur n'existe pas";
				}
			}
		}
	}
}
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
    <div style="background-image:url(img/accueil_bis.jpg);" ><B><h1>PhotouCat</h1></B><br> </div>
    <nav class="crumbs">
        <form name="accueil" action="accueil.php" method="POST">
           <button style="float: left;" type="submit" name="accueil" class="btn btn-success">
            Accueil
            </button>
        </form>
    </nav>
    <div class="row justify-content-center">
        <div class="block container p-4 m-4 border rounded border-dark" name='block'>
            <form action="connexion.php" method="POST">

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
                        <select name="dowpdown" >
                            <option value="0">Administrateur</option>
                            <option value="1" SELECTED>Utilisateur</option>
                        </select>
                    </div>
                    <div class="row justify-content-start p-2">
                        <div class="col-5 ">
                            Pseudo*
                        </div>
                        <div class="col-6 ">
                            <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo">
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
                                <input type="password" name="motdepasse" id="motdepasse">
                            </div>
                            <small class="col-10">
                                <?php
                                if(isset($pwdErr) && $pwdErr){
                                    echo $pwdErr;
                                }
                                ?>
                            </small class="col-10">
                        </div>
                        <input type="submit" name="submit" value="Se Connecter"/>

                    </div>
                </div>

            </form>
            <!--<div style="display:flex; margin-top :3em;margin-left:9em; padding-right:8em;padding-left:2em;">
                <form action="connexion.php" method="POST">
                    <input type="submit" name="submit" value="Se Connecter"/>
                </form>
            </div></br>-->
            <div style="padding-left:2em;">
                <a href="https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/inscription.php"> Pas encore Inscrit ? </a>
            </div>

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
	
	$conn = getConnection('localhost', "p1501149", "49afdf", "p1501149");
	if(isset($_POST["pseudo"])){
	    $link = getConnection('localhost', "p1926029", "ef5d0c", "p1926029");
		if ((isset($pseudo)) &&( isset($pwd))){
			//$link=getConnection($dbHost, $dbUser, $dbPwd, $dbName);
			if($_POST['dowpdown'] ==0){
				if(getUserAdmin($pseudo, $pwd, $link) == 1) { 
				$_SESSION["pseudo"]= $pseudo;
				$_SESSION["motdepasse"] =$pwd;
				/*MARINE*/
				$_SESSION['start'] = time();
                $_SESSION['expire'] = $_SESSION['start'] + (30 * 6);
                /*MARINE*/

                    header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/page_administrateur.php?pseudo='.$pseudo);
				exit();
			
				}
				else{
					$pwdErr = "le pseudo/mot de passe sont erroné ou l'admin n'existe pas";
				}
			}
			else{
				if(getUserUtil($pseudo, $pwd, $link) == 1) {
				    setConnectedUtil($pseudo, $link);
					$_SESSION["pseudo"]= $pseudo;
					$_SESSION["motdepasse"] =$pwd;
					/*MARINE*/
                    $_SESSION['start'] = time();
                    $_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
                    /*MARINE*/


                    header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/page_utilisateur.php?pseudo='.$pseudo);
					exit();
				
				}
				else{
					$pwdErr = "le pseudo/mot de passe sont erroné ou l'utilisateur n'existe pas";
				}
			}
		}
	}
	
}
 
?>

</body>
</html>
<?php

if (isset($_POST['accueil'])) {
    header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/accueil.php');
    exit();
}

?>