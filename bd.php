<?php
/*bdw1.univ-lyon1.fr/p1501149/tp4*/
$dbHost = "localhost";// à compléter
$dbUser = "p1926029";// à compléter
$dbPwd = "ef5d0c";// à compléter
$dbName = "p1926029";

/*Cette fonction prend en entrée l'identifiant de la machine hôte de la base de données, les identifiants (login, mot de passe) d'un utilisateur autorisé 
sur la base de données contenant les tables pour le chat et renvoie une connexion active sur cette base de donnée. Sinon, un message d'erreur est affiché.*/
function getConnection($dbHost, $dbUser, $dbPwd, $dbName)
{
	$link = mysqli_connect($dbHost,$dbUser,$dbPwd, $dbName);
	if(mysqli_connect_errno()) { // erreur si > 0
		printf("Échec de la connexion : %s", mysqli_connect_error());
	}
	else {
		return $link;
	}

}

/*Cette fonction prend en entrée une connexion vers la base de données du chat ainsi 
qu'une requête SQL SELECT et renvoie les résultats de la requête. Si le résultat est faux, un message d'erreur est affiché*/
function executeQuery($link, $query)
{
	//print($query);  R: utilisez ce print pour débogage 
	$resultat = mysqli_query($link, $query) ;
	if($resultat == FALSE){ // échec si FALSE
		printf("Échec de la requête". mysqli_error($link)) ;
	}
	else {
		//$row = mysqli_fetch_assoc($resultat); pour une ligne
		return $resultat;
	}

}

/*Cette fonction prend en entrée une connexion vers la base de données du chat ainsi 
qu'une requête SQL INSERT/UPDATE/DELETE et ne renvoie rien si la mise à jour a fonctionné, sinon un 
message d'erreur est affiché.*/
function executeUpdate($link, $query)
{
    echo "enter into bd.php execute update";
	//print($query);  R: utilisez ce print pour débogage 
	$resultat = mysqli_query($link, $query) ;
	if($resultat == FALSE){ // échec si FALSE
		printf("Échec de la mise à jour") ;
	}

}

/*Cette fonction ferme la connexion active $link passée en entrée*/
function closeConnexion($link)
{
	mysqli_close($link) ;
}
?>