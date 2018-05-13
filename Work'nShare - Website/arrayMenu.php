<?php
	session_start();
	require "class/menuClass.php";
	require "class/windowClass.php";
	$deleteWindow = new Window();
	$db = new DataBase();
	$menu = new Menu();
	$count = $menu->countMenu();
	$loadMenu = $menu->loadMenu(0);
	$loadActualMenu = $menu->loadMenu(1);

	if(isset($_POST['deleteMenu'])){
		$value = $_POST['deleteMenu'];
		$menu->deleteMenu($value);
	}

?>


<?php

	if(isset($_SESSION['success'])  && !empty($_SESSION['success'])){
		echo '<div class="alert alert-success alert-dismissible fade in">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>';
		foreach ($_SESSION['success'] as $value) {
			
			echo '<li><span class="glyphicon glyphicon-ok"></span>'.$value.'</li>';

		}
		echo '</ul>
			</strong>
		</div>';
	}
?>
	<h3>Liste des menus</h3>
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addMenu">Ajouter un menu</button>
	<div class="table-responsive">
		<table class="table table-hover">
			<h3>Menus Work'n Share</h3>
			<thead>
				<tr>
					<th>Numéro</th>
					<th>Nom</th>
					<th>Entrée</th>
					<th>Plat</th>
					<th>Dessert</th>
					<th>Quantité</th>
					<th colspan="2">Actions</th>
				</tr>
			</thead>
			<tbody>
			
			<?php
				foreach ($loadMenu as $value) {
				
			?>
				<tr>
					<?php
						if($count[0]['COUNT(idMenu)'] != 0){
								
								$titleMenu = str_replace(' ', '', $value[1]); //SUPPRIMER LES ESPACES
								echo $titleMenu;
								echo '<td>'.$value[0].'</td>'; //ID
								echo '<td>'.$value[1].'</td>'; //NOM
								echo '<td>'.$value[2].'</td>'; //ENTREE
								echo '<td>'.$value[3].'</td>'; //PLAT
								echo '<td>'.$value[4].'</td>'; //DESSERT
								if($value[5] == 0){
									echo "<td style='color:red'>Epuisé</td>";
								}else if($value[5] < 10){
									echo '<td style="color:orange">'.$value[5].'</td>'; //QUANTITE
								}
								
								echo '<td><button type="button" class="btn btn-warning">Modifier</button></td>';
								echo '<td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#'.$titleMenu.'">Supprimer</button></td>';
								//echo $deleteWindow->confirmAction("Etes-vous sûr de vouloir supprimer le menu ".$value[1]."?", $value[1], "deleteMenu(\"".$value[1]."\")");
								echo $deleteWindow->confirmAction('Etes-vous sûr de vouloir supprimer le menu '.$value[1].'?', $titleMenu, 'deleteMenu(\''.$value[1].'\')');
							
						}else{
							echo '<td colspan="8">Pas de menu enregistré!</td>';
						}
					?>
				</tr>
				<?php

				} //FIN DU FOREACH

				?>
			</tbody>
		</table>
	</div>
	<?php

	?>
		