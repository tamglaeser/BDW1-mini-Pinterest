<?php

/*Cette fonction prend en entrée un pseudo à ajouter à la relation utilisateur et une connexion et
retourne vrai si le pseudo est disponible (pas d'occurence dans les données existantes), faux sinon*/
function checkAvailabilityUtil($pseudo, $link)
{
	$query = "SELECT * FROM utilisateur WHERE utilPseudo = \"$pseudo\"" ;
	$resultat_req = executeQuery($link, $query); // R: Il vous manquait l'execution de la requete
	$res=mysqli_num_rows($resultat_req);
	return $res==0; //R: vrai si le pseudo n'existe pas dans la base

}

/*Cette fonction prend en entrée un pseudo et un mot de passe, associe une couleur aléatoire dans le tableau de taille fixe
array('red', 'green', 'blue', 'black', 'yellow', 'orange') et enregistre le nouvel utilisateur dans la relation utilisateur via la connexion*/
function registerUtil($pseudo, $hashPwd, $link)
{
	//$hashPwd = md5($hashPwd);
	$query = "INSERT INTO utilisateur VALUES (\"$pseudo\", \"$hashPwd\")"; // R: il fallait utiliser \"
	executeUpdate($link, $query) ;
}

/*Cette fonction prend en entrée un pseudo d'utilisateur et change son état en 'connected' dans la relation
utilisateur via la connexion*/
function setConnectedUtil($pseudo, $link)
{
	$query = "UPDATE utilisateur SET etat = 'connected' WHERE utilPseudo = \"$pseudo\"";
	executeUpdate($link, $query);
	
}

/*Cette fonction prend en entrée un pseudo et mot de passe et renvoie vrai si l'utilisateur existe (au moins un tuple dans le résultat), faux sinon*/
function getUserUtil($pseudo, $hashPwd, $link)
{
	
	//$hashPwd = md5($hashPwd);
	$query1 = "SELECT * FROM utilisateur WHERE utilPseudo = \"$pseudo\" AND utilMdp= \"$hashPwd\"";
	$res_req = executeQuery($link, $query1);
	$res1= mysqli_num_rows($res_req);
	return $res1;
}

/*Cette fonction renvoie un tableau (array) contenant tous les pseudos d'utilisateurs dont l'état est 'connected'*/
function getConnectedUsersUtil($link)
{
	$req = "SELECT pseudo FROM utilisateur WHERE etat = 'connected'";
    $result = executeQuery($link, $req);
    $users = array();
    $n = 0;
    while($row = mysqli_fetch_assoc($result)) {
        $users[$n] = $row["pseudo"];
        $n += 1;
    }
    return $users;
}

/*Cette fonction prend en entrée un pseudo d'utilisateur et change son état en 'disconnected' dans la relation
utilisateur via la connexion*/
function setDisconnectedUtil($pseudo, $link)
{
	$query = "UPDATE utilisateur SET etat = 'disconnected' WHERE utilPseudo = \"$pseudo\"";
	executeUpdate($link, $query);
}



?>
