<?php

require_once "class/equipmentClass.php";


$equipment = new Equipment();
$db = new DataBase();

$db->prepareQuery('SELECT * FROM openspace ORDER BY idOpenSpace');
$db->executeQuery();
$result = $db->fetchQuery();
?>
<div class="modal fade" id="addEquipmentForm" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Ajouter un équipement</h3>
			</div>
			<div class="modal-body">
				
				<form class="form-horizontal" action="">
				    <div class="form-group">
				      <label class="control-label col-sm-5" for="email">Désignation</label>
				      <div class="col-sm-5">
				        <input type="text" class="form-control" id="nameEquipment" placeholder="Désignation de l'équipement">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-sm-5" for="email">Numéro de série</label>
				      <div class="col-sm-5">
				        <input type="text" class="form-control" id="serialNumberEquipment" placeholder="">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-sm-5">Type</label>
				      <div class="col-sm-5">          
				        <select id="selectEquipmentType" class="form-control">
							<option>Ordinateur</option>
							<option>Ordinateur portable</option>
							<option>Imprimante</option>
							<option>Machine à canettes</option>
							<option>Machine à café</option>
							<option>Multiprise 4 entrées</option>
						</select>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-sm-5" for="email">Appartenance à un lieu</label>
				      <div class="col-sm-5">
				        	<select id="selectOpenspace" class="form-control">			
								<?php
								foreach($result as $res){

									echo "<option id = 'idOption' value='" . $res[0] . "'>" . utf8_encode($res[1]) ."</option>";
								}
								?>
							</select>

				      </div>
				    </div>
				  </form>

				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
				<button type="button" class="btn btn-success" id="nameRoom" data-dismiss="modal" onclick="addEquipment()">Confirmer</button>
			</div>
		</div>
	</div>

</div>