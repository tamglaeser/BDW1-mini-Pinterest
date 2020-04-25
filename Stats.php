<?php
	require_once('bd.php');
	require_once('utilisateur.php');
	require_once('administrateur.php');
/*bdw1.univ-lyon1.fr/p1501149/tp4*/

session_start();
$temp=$_SESSION['expire'] - time(); //MARINE
$conn = getConnection('localhost', "p1926029", "ef5d0c", "p1926029");
?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Bienvenue sur PhotouCat</title>
  <link rel="stylesheet" href="bootstrap.css">
  <link rel="stylesheet" href="accueil.css">
</head>
<form>
<div style="background-image:url(img/accueil_bis.jpg);" ><B><h1>PhotouCat_Admin</h1></B><br>

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
	<form name="accueil_stats" action="Stats.php" method="POST">
	   <button style="float: left;" type="submit" name="accueil" class="btn btn-success">
		Accueil
		</button>
		<div class='connexion'>
		<button style="float: right;" type="submit" name="deconnexion" class="btn btn-success">
		Deconnexion
		</button>
		</div>
	</nav></br>
    </form>



<h1> Page de Statistiques</h1><br><br><br>
<?php  $res = executeQuery($conn,"SELECT utilPseudo FROM utilisateur ");
//$row_res = $res->fetch_assoc();
$users = array();
$n = 0;
while($row = mysqli_fetch_assoc($res)) {
    $users[$n] = $row["utilPseudo"];
    $n += 1;
}
$a = sizeof($users);

$res_req =executeQuery($conn,"SELECT u.utilPseudo FROM utilisateur u JOIN Photo p ON u.utilId = p.utilId GROUP BY u.utilPseudo HAVING COUNT(p.utilId) ");
$res_req1 =executeQuery($conn,"SELECT COUNT(p.utilId) AS p FROM utilisateur u JOIN Photo p ON u.utilId = p.utilId GROUP BY u.utilPseudo HAVING COUNT(p.utilId) ");
$nbp= array();
$u=array();
$n = 0;
$i = 0;
while($row = mysqli_fetch_assoc($res_req)) {
    $u[$n] = $row["utilPseudo"];
    $n += 1;
}
while($row1 = mysqli_fetch_assoc($res_req1)) {
    $nbp[$i] = $row1["p"];

    $i += 1;

}
$re =executeQuery($conn,"SELECT u.nomCat FROM Categorie u JOIN Photo p ON u.CatId = p.CatId GROUP BY u.nomCat HAVING COUNT(p.CatId) ");
$re1 =executeQuery($conn,"SELECT COUNT(p.CatId) AS p FROM Categorie u JOIN Photo p ON u.CatId = p.CatId GROUP BY u.nomCat HAVING COUNT(p.CatId) ");
$nbc= array();
$ul=array();
$m = 0;
$o = 0;
while($row = mysqli_fetch_assoc($re)) {
    $ul[$m] = $row["nomCat"];
    $m += 1;
}
while($row1 = mysqli_fetch_assoc($re1)) {
    $nbc[$o] = $row1["p"];

    $o += 1;

}

$array=getConnectedUsersUtil($conn);
?>
<table>
    <tr>
        <th>le nombre d'utilisateur inscrit: </th>
        <td><?php echo $a; ?></td>
    </tr>
</table>
<table>
    <tr>
        <th>nom utilisateur </th>
        <td>nombre de photo</td>
    </tr>
    <?php for($j=0; $j< sizeof($u); $j++){?>
        <tr>
            <th><?php echo $u[$j]; ?> </th>
            <td><?php echo $nbp[$j];?></td>
        </tr>
    <?php }?>
    <tr>
</table>
<table>
    <th>nom Categorie </th>
    <td>nombre de photo</td>
    </tr>
    <?php for($j=0; $j< sizeof($ul); $j++){?>
        <tr>
            <th><?php echo $ul[$j]; ?> </th>
            <td><?php echo $nbc[$j];?></td>
        </tr>
    <?php }?>
</table>
<table>
    <th>utilisateur connecte </th>
    </tr>
    <?php for($j=0; $j< sizeof($array); $j++){?>
        <tr>
            <th><?php echo $array[$j];?> </th>
        </tr>
    <?php }?>
</table>





</body>

</html>
<?php
/**
if (isset($_GET['catId'])) {
    $Id = htmlspecialchars($_GET["catId"]);
    include("function.php");
}**/


if (isset($_POST['accueil'])) {
    header('Location: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/page_administrateur.php?pseudo='.$_SESSION['pseudo']);
    exit();
}
if (isset($_POST['deconnexion'])) {
    //MARINE
    unset($_SESSION["pseudo"]);
    unset($_SESSION["motdepasse"]);
    session_destroy();
    //MARINE
    header('Location:https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/accueil.php');
    exit();
}


closeConnexion($conn);
?>