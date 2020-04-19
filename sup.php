<?php function sup() {
				echo "patat";
				if(getUserUtil($pseudo,$pwd,$conn) ==1){
					echo"y";
					$result_pseudo= executeQuery($conn, "SELECT utilId FROM utilisateur WHERE utilPseudo= \"$pseudo\"");
					$result_photo= executeQuery($conn, "SELECT utilId FROM Photo WHERE photoId=\"$photoId\"");
					if($result_photo== $result_pseudo){
						executeUpdate($conn, "DELETE FROM Photo WHERE photoId =\"$photoId\"");
						header('Location: https://bdw1.univ-lyon1.fr/p1501149/bdw1_projet-master/page_utilisateur.php');?>
						<script>txt.textContent='la Photo à bien été supprimée';</script><?php
						exit();
					}
					else{
						?> <script> aff.textContent='Vous ne pouvez pas supprimer cette photo';</script><?php
					}
				}
			   else {
					if(getUserAdmin($pseudo,$pwd,$conn) ==1){
						executeUpdate($conn, "DELETE FROM Photo WHERE photoId =\"$photoId\"");
						header('Location: https://bdw1.univ-lyon1.fr/p1501149/bdw1_projet-master/page_administrateur.php');?>
						<script>txt.textContent='la Photo à bien été supprimée';</script><?php
						exit();
						echo "aaaa";
					}
					else{
						echo " vous êtes pas connecté, vous ne pouvez pas la supprimer";
					}
				}
			  
			}?>