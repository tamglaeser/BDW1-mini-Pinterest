<?php

/*Cette fonction prend en entrée un pseudo à ajouter à la relation administrateur et une connexion et
retourne vrai si le pseudo est disponible (pas d'occurence dans les données existantes), faux sinon*/
function checkAvailabilityAdmin($pseudo, $link)
{
	$query = "SELECT * FROM administrateur WHERE adminPseudo = \"$pseudo\"" ;
	$resultat_req = executeQuery($link, $query); // R: Il vous manquait l'execution de la requete
	$res=mysqli_num_rows($resultat_req);
	return $res==0; //R: vrai si le pseudo n'existe pas dans la base
}

/*Cette fonction prend en entrée un pseudo et un mot de passe, associe une couleur aléatoire dans le tableau de taille fixe
array('red', 'green', 'blue', 'black', 'yellow', 'orange') et enregistre le nouvel administrateur dans la relation administrateur via la connexion*/
function registerAdmin($pseudo, $hashPwd, $link)
{
	//$hashPwd = md5($hashPwd);
	$query = "INSERT INTO administrateur(adminPseudo, adminMdp) VALUES (\"$pseudo\", \"$hashPwd\")"; // R: il fallait utiliser \"
	executeUpdate($link, $query) ;
}



/*Cette fonction prend en entrée un pseudo et mot de passe et renvoie vrai si l'administrateur existe (au moins un tuple dans le résultat), faux sinon*/
function getUserAdmin($pseudo, $hashPwd, $link)
{
	
	//$hashPwd = md5($hashPwd);
	$query1 = "SELECT * FROM administrateur WHERE adminPseudo = \"$pseudo\" AND adminMdp= \"$hashPwd\"";
	$res_req = executeQuery($link, $query1);
	$res1= mysqli_num_rows($res_req);
	return $res1;
}



?>
