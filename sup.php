<?php 

session_start();
require_once ('bd.php');
require_once ('administrateur.php');
require_once ('utilisateur.php');
require_once ('function.php');

$pId = $_SESSION['photoId'];
$ps = $_SESSION['pseudo'];

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
<?php
$conn = getConnection('localhost', "p1501149", "49afdf", "p1501149");
sup($pId,$ps);

?>
</body>
</html>
<?php
function sup($photoId,$pseudo) {
				
				if(isset($_SESSION['motdepasse'])){$pwd= $_SESSION['motdepasse'];}
				echo "patat";
				$conn = getConnection('localhost', "p1501149", "49afdf", "p1501149");
				
				if(getUserUtil($pseudo,$_SESSION['motdepasse'],$conn) ==1){
					echo"y";
					$result_pseudo= executeQuery($conn, "SELECT utilId FROM utilisateur WHERE utilPseudo= \"$pseudo\"");
					$result_photo= executeQuery($conn, "SELECT utilId FROM Photo WHERE photoId=\"$photoId\"");
					if($result_photo== $result_pseudo){
						echo "eeeeeee";
						executeUpdate($conn, "DELETE FROM Photo WHERE photoId =\"$photoId\"");
						echo "la photo a ete supprimé";
						header('Location: https://bdw1.univ-lyon1.fr/p1501149/bdw1_projet-master/page_utilisateur.php');
						
						exit();
					}
					else{
						echo "vous ne pouvez pas la supprimer ";
						header('Location: https://bdw1.univ-lyon1.fr/p1501149/bdw1_projet-master/page_utilisateur.php');
					}
				}
			   else {
					if(getUserAdmin($pseudo,$_SESSION['motdepasse'],$conn) ==1){
						echo"sssssssssssssssssssss";
						executeUpdate($conn, "DELETE FROM Photo WHERE photoId =\"$photoId\"");
						header('Location: https://bdw1.univ-lyon1.fr/p1501149/bdw1_projet-master/page_administrateur.php');
						
						exit();
						echo "aaaa";
					}
					else{
						echo " vous êtes pas connecté, vous ne pouvez pas la supprimer";
					}
				}
			  
	}?>
			