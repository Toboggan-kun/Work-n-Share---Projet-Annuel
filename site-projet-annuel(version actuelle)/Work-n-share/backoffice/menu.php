<?php

include "header.php";

require "class/menuClass.php";
$db = new DataBase();
$menu = new Menu();


$count = $menu->countMenu();
$loadMenu = $menu->loadMenu(0);
$loadActualMenu = $menu->loadMenu(1);


?>
	
 
 	
<h2>Gestion des menus</h2>
<div id="loadActualMenu" class="panel panel-default">
	<?php
		if($count[0]['COUNT(idMenu)'] != 0){
			echo '<div class="panel-heading">Menu du jour</div>
				<div class="panel-body">
				<p>Nom menu : '.$loadActualMenu[0]['nameMenu'].'</p>
				<li>Entrée :'.$loadActualMenu[0]['starter'].'</li>
				<li>Plat :'.$loadActualMenu[0]['dish'].'</li>
				<li>Dessert :'.$loadActualMenu[0]['dessert'].'</li>
				<li>Boisson: au choix</li></div>';
		}else{
			echo '<div class="panel-heading">Menu du jour</div>
				<div class="panel-body">
				<div class="alert alert-info">
				  <p>Pas de menu enregistré</p>.
				</div>';
		}
	?>
	

</div>

	<div id="editMenu"></div>

	<!-- CHARGE LE TABLEAU -->
	<script  onload="loadArrayMenu()" type="text/javascript" src="js/script.js"></script>
	<div class="modal fade" id="addMenu" role="dialog">
		<div class="modal-dialog modal-lg">


			<div class="modal-content">
				
				<div class="modal-body">
					<!-- CHARGE LES MESSAGES D'ERREURS -->
					<div id="test" class="modal-header"></div>
				<form class="form-horizontal">
					<div class="form-group">
					    <label class="control-label col-sm-5">Nom du menu*</label>
					    <div class="col-sm-5">
					      <input type="text" class="form-control input-lg" id="nameMenu" placeholder="Entrez un nom">
					    </div>
					</div>
					<div class="form-group">
					    <label class="control-label col-sm-5">Entrée*</label>
					    <div class="col-sm-5">
					      <input type="text" class="form-control input-lg" id="starter" placeholder="Entrez un nom d'entrée">
					    </div>
					</div>
					<div class="form-group">
					    <label class="control-label col-sm-5">Plat*</label>
					    <div class="col-sm-5">
					      <input type="text" class="form-control input-lg" id="dish" placeholder="Entrez un nom de plat">
					    </div>
					</div>
					<div class="form-group">
					    <label class="control-label col-sm-5">Dessert*</label>
					    <div class="col-sm-5">
					      <input type="text" class="form-control input-lg" id="dessert" placeholder="Entrez un nom de dessert">
					    </div>
					</div>
					<div class="form-group">
					    <label class="control-label col-sm-5">Quantité*</label>
					    <div class="col-sm-5">
					      <input type="number" class="form-control input-lg" id="quantity" value="1" min="1">
					    </div>
					</div>

					<h4>Souhaitez-vous ajouter ce menu en tant que menu du jour?</h4>

					<div class="radio">
						<label><input type="radio" id="no" name="optradio" checked="checked">Non</label>
					</div>
					<div class="radio">
						<label><input type="radio" id="yes" name="optradio">Oui</label>
					</div>
					<?php
					if($count[0]['COUNT(idMenu)'] != 0){
						echo '	<div class="alert alert-warning">
								  <strong>!</strong> Un menu du jour a déjà été défini, celui-ci sera remplacé</a>.
								</div>';
					}else{
						echo '	<div class="alert alert-success">
								  <strong>!</strong> Pas de menu du jour enregistré</a>.
								</div>';
					}
					?>

					<p>* : champs obligatoires</p>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Annuler</button>
				<button type="button" class="btn btn-success btn-lg" onclick="addMenu()">Ajouter</button>
			</div>

					

			</div>
		</div>
	</div>
	<!-- CHARGE LA POPUP -->
	<script  onload="loadAddMenuForm()" type="text/javascript" src="js/script.js"></script>


	
	




<?php

include "footer.php";

?>