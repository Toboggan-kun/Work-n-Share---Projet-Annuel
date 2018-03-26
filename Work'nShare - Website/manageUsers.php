<?php

include "header.php";
require "class/userClass.php";

$db = new DataBase();
$user = new User();

$db->connectDataBase();

$db->prepareQuery("SELECT * FROM user WHERE isAdmin = :isAdmin AND isDeleted = :isDeleted");

$db->executeQuery	([	'isAdmin' => 0,
											'isDeleted' => 0
 									]);

$result = $db->fetchQuery();

?>


<center>
	<h1> Administration Work'n Share </h1>
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
		<?php
				foreach($result as $res){
		 ?>
		<tbody>
			<tr id="refresh"">
				<?php
					echo '		<th>' . $res[0] . '</th>';
					echo '		<th>' . $res[1] . '</th>';
					echo '		<th>' . $res[2] . '</th>';
					echo '		<th>' . $res[3] . '</th>';
					echo '		<th>' . $res[5] . '</th>';
					echo '		<th>Conneté(t)</th>';

					echo '    <th><button id="'.$res[0].'" onclick="deleteUser(' . $res[0] . ')"><i class="fas fa-trash"></i></button></th>';

				}
				?>

			</tr>

		</tbody>

	</table>

</center>

<?php

include "footer.php";
?>
