<?php

require "class/userClass.php";
require "class/windowClass.php";

$window = new window();
$user = new User();
$db = new DataBase();
if(isset($_POST['user'])){
	$id = $_POST['user'];
	$user->deleteUser($id);
}
if(isset($_POST['unsuspend_user'])){
	$id = $_POST['unsuspend_user'];
	$user->unsuspendUser($id);
}


$loadUsers = $user->loadUsers(0);
$loadSuspendedUsers = $user->loadUsers(1);

//MESSAGES
if(isset($_SESSION['success']) && !empty($_SESSION['success'])){
	echo '<div class="alert alert-success alert-dismissible fade in">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>';
	foreach ($_SESSION['success'] as $value) {
			
			echo '<li><span class="glyphicon glyphicon-valid-sign"></span>'.$value.'</li>';

		
	}

	echo '</ul></div>';

}
?>
<div id="arrayUser" class="table-responsive">
	<table class="table table-hover">
		<h3>Membres Work'n Share</h3>

		<thead>
			<tr>
				<th>Identifiant</th>
				<th>Nom</th>
				<th>Prénom</th>
				<th>Email</th>
				<th>N° abonnement</th>
				<th>Validité de l'abonnement</th>
				<th>Statut</th>
				<th>Actions</th>

			</tr>
		</thead>
		
		
		


	<tbody>
		<?php
			foreach($loadUsers as $res){
			

		 ?>

			
		<?php

			echo '		<tr id="'.$res[0].'"><th>' . $res[0] . '</th>';

			echo '		<th>' . $res[1] . '</th>';
			echo '		<th>' . $res[2] . '</th>';
			echo '		<th>' . $res[3] . '</th>';
			echo '		<th>' . $res[5] . '</th>';
			if($res[5] == 1 || $res[5] == 2){
				echo '	<th> x jours restants</th>';
			}else{
				echo '	<th>Ok</th>';
			}
			
			echo '		<th>Conneté(tmp)</th>';

			echo '<td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#'.$res[0].$res[1].'">Consulter</button></td>';
			echo '<td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#'.$res[0].'">Suspendre</button></td>';
			echo $window->consultUser($res[0].$res[1], $res[1], $res[2],null, $res[3], $res[5], 'test', 'tet');
			echo $window->suspendUser($res[0], 'deleteUser('.$res[0].')');
			

		}
		
		if($loadUsers == null){
			echo '<tr class="danger"><td colspan=7>Pas de membres</td></tr>';
		}
		
		?>

				
			
	</tbody>
	</table>

</div>



<a href="#arrayUserSuspended" class="btn btn-danger" data-toggle="collapse">Membres suspendus</a>
<div id="arrayUserSuspended" class="collapse">
	<div id="arrayUser" class="table-responsive">
		<table class="table table-hover">
			<h3>Membres suspendus Work'n Share</h3>

			<thead>
				<tr>
					<th>Identifiant</th>
					<th>Nom</th>
					<th>Prénom</th>
					<th>Email</th>
					<th>N° abonnement</th>

					<th>Suspendu le</th>
					<th>Motif de la suspension</th>

					<th>Actions</th>

				</tr>
			</thead>

			<tbody>
				<?php
					foreach($loadSuspendedUsers as $res){
					

				 ?>

					
				<?php

					echo '		<tr id="'.$res[0].'"><th>' . $res[0] . '</th>';

					echo '		<th>' . $res[1] . '</th>';
					echo '		<th>' . $res[2] . '</th>';
					echo '		<th>' . $res[3] . '</th>';
					echo '		<th>' . $res[5] . '</th>';
					echo '		<th>Date à venir</th>';
					echo '		<th>Motif à venir</th>';
					echo '<td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#'.$res[0].'">Désuspendre</button></td>';

					echo $window->confirmAction('Voulez-vous annuler la suspension de l\'utilisateur '.$res[0].' ?', $res[0], 'unsuspendUser('.$res[0].')');

				} //FIN DU FOREACH
				
				if($loadSuspendedUsers == null){
					echo '<tr class="danger"><td colspan=8>Pas de membres suspendus</td></tr>';
				}
				
				?>	
					
			</tbody>
		</table>

	</div>
</div>
