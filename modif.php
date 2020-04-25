<?php 

session_start();
require_once ('bd.php');
require_once ('administrateur.php');
require_once ('utilisateur.php');
require_once ('function.php');

$pId = $_SESSION['photoId'];
$ps = $_SESSION['pseudo'];
$pwd= $_SESSION['motdepasse'];
$temp=$_SESSION['expire'] - time(); //MARINE

if (isset($_POST['submit'])) {

  if (empty($_POST["des"])){
    $desErr = "Il vous faut un pseudo";
  }
	else {
		$des = test_input($_POST["des"]);
		$desErr = "";
	}
	
	
}
?>
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>PhotouCat</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="accueil.css">
</head>
<body>
 <div style="background-image:url(img/accueil_bis.jpg);" ><B><h1>PhotouCat</h1></B><br>
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
        <?php 
	if(empty($_SESSION['pseudo']) && empty($_SESSION['motdepasse'])){
		echo "<a href='https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/accueil.php'>ACCUEIL</a>";
	}else{
		
		if(getUserAdmin($_SESSION['pseudo'], $_SESSION['motdepasse'], $conn) == 1) { 
			echo "<a href='https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/page_administrateur.php'>ACCUEIL</a>";
				
		}else{
					
			if(getUserUtil($_SESSION['pseudo'], $_SESSION['motdepasse'], $conn) == 1) {
				echo "<a href='https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/page_utilisateur.php'>ACCUEIL</a>";
					
			}
		}
	}
?>
    </nav>
<div class="row justify-content-center">
        <div class="block container p-4 m-4 border rounded border-dark" name='block'>
            <form action="modif.php" method="POST">

                <div class="row justify-content-start">
                    <div class="col-4">
                        <p>* champs requis</p>
                    </div>
                </div>                    
                    <div class="row justify-content-start p-2">
                        <div class="col-5 ">
                            Description*
                        </div>
                        <div class="col-6 ">
                            <input type="text" name="des" id="des" placeholder="description">
                        </div>
                            <small class="col-10">
                                <?php
                                if(isset($desErr) && $desErr){
                                    echo $desErr;}
                                ?>
                            </small>
                        <input type="submit" name="submit" value="Valider"/>

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
	
	if(isset($_POST["des"])){
		$des=$_POST["des"];
		if (isset($des) ){
			echo "a" ;
			$query="UPDATE Photo SET description = \"$des\" WHERE photoId = \"$pId\"";
			modif($pId,$ps,$query);
			
		}
	}
	
}
 
?>

</body>
</html>
<?php
function modif($photoId,$pseudo,$query) {
				if(isset($_SESSION['motdepasse'])){$pwd= $_SESSION['motdepasse'];}
				$conn = getConnection('localhost', "p1926029", "ef5d0c", "p1926029");
				
				if(getUserUtil($pseudo,$_SESSION['motdepasse'],$conn) ==1){
					$result_pseudo= executeQuery($conn, "SELECT utilId FROM utilisateur WHERE utilPseudo= \"$pseudo\"");
					$result_photo= executeQuery($conn, "SELECT utilId FROM Photo WHERE photoId=\"$photoId\"");
					if($result_photo== $result_pseudo){
						executeUpdate($conn, $query);
						echo "la description a ete modifier";
						header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/page_utilisateur.php?pseudo=' . $pseudo);
						exit();
					}
					else{
						echo "vous ne pouvez pas la modifier ";
						header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/page_utilisateur.php?pseudo=' . $pseudo);
					}
				}
			   else {
					if(getUserAdmin($pseudo,$_SESSION['motdepasse'],$conn) ==1){
						executeUpdate($conn, $query);
						header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/page_administrateur.php?pseudo='.$pseudo);
						
						exit();
					}
					else{
						echo " vous êtes pas connecté, vous ne pouvez pas la modifier";
					}
				}
			  
	}?>
	