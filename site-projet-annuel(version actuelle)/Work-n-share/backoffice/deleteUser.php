<?php


require "class/userClass.php";
require "class/windowClass.php";

$window = new window();
$user = new User();
if(isset($_POST['user'])){
	$id = $_POST['user'];
	$user->deleteUser($id);
}
$db = new DataBase();

$db->connectDataBase();

$db->prepareQuery("SELECT * FROM user WHERE isAdmin = :isAdmin AND isDeleted = :isDeleted");

$db->executeQuery	([	'isAdmin' => 0,
						'isDeleted' => 0
 									]);

$result = $db->fetchQuery();
?>
	<table>
		<caption> Membres Work'n Share <br><br></caption>

		<thead>
			<tr>
				<th>Identifiant</th>
				<th>Nom</th>
				<th>Prénom</th>
				<th>Email</th>
				<th>N° abonnement</th>

				<th>Statut</th>
				<th>Supprimer</th>

			</tr>
		</thead>
		
		
		


	<tbody>
		<?php
			foreach($result as $res){
			

		 ?>

			
		<?php

			echo '		<tr id="'.$res[0].'"><th>' . $res[0] . '</th>';

			echo '		<th>' . $res[1] . '</th>';
			echo '		<th>' . $res[2] . '</th>';
			echo '		<th>' . $res[3] . '</th>';
			echo '		<th>' . $res[5] . '</th>';
			echo '		<th>Conneté(tmp)</th>';

			/*echo '    
			<th>
			<input type="button" 
			id="buttonSubmit" class="buttonClass"
			onclick="deleteUser('.$res[0].')" value="Ok"></th></tr>';*/

			echo '    
			<th>
			<input type="button" 
			id="buttonSubmit" class="buttonClass"
			onclick="showPopup('. $res[0] . ')" value="Suspendre"></th></tr>';

			echo $window->confirmAction('Etes-vous sûr de vouloir suspendre l\'utilisateur '.$res[0].'?', $res[0], 'deleteUser('.$res[0].')');

		}
		
		if($result == null){
			echo '<th colspan=7>Pas de membres</th>';
		}
		
		?>

				
			
	</tbody>
	</table>