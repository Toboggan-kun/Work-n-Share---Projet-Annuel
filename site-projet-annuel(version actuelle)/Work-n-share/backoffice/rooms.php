<?php

include "header.php";

require "class/windowClass.php";
require "class/roomClass.php";
$room = new Room();
$window = new Window();

$result = $room->displayOpenspaces();
$typeRoom = $room->displayTypeRoom();

?>
<div class="page-header">
	<h2>Gestion des salles</h2>
</div>

	
	<script onload="userArray()" src="js/script.js"></script>
	<script src="js/script.js" onload="loadPage('addRoom.php', 'headerFormRoom')" type="text/javascript" ></script>
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

	<label>Filter</label><select  id="selectOpenspace" name="selectOpenspace" onchange="refreshArray()">
		<option></option>
			
		<?php
		foreach($result as $res){

			echo "<option id = 'idOption' value='" . $res[0] . "'>" . $res[1] ."</option>";
		}
		?>
				

	</select>
	<div id="response"></div>



<div class="modal fade" id="addRoom" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-header"></div>

		<div class="modal-content">
		<!-- CHARGE LES MESSAGES D'ERREURS -->
			<div id="headerFormRoom" class="modal-header">
				
			</div>
			<br><br>
			<div class="modal-body">
				
				<form class="form-horizontal">
					<div class="form-group">

					    <label>Lieu*</label>
					    <div>
					    	<select id="selectIdOpenspace">
								<option></option>
							
								<?php
								foreach($result as $res){

									echo "<option id = 'idOption' value='" . $res[0] . "'>" . $res[1] ."</option>";
								}

								?>
							</select>
					    </div>
					    <label>Type de salle*</label>
					    <div>
					    	<select id="selectType">
								<option></option>
								<?php
								
									for($i = 0; $i < count($typeRoom); $i++){


										if($typeRoom[$i]['typeRoom'] == 0){
											echo '<option> Cosy </option>';
										}else if($typeRoom[$i]['typeRoom'] == 1){
											echo '<option> Réunion </option>';
										}else if($typeRoom[$i]['typeRoom'] == 2){
											echo '<option> Appels </option>';
										}else{
											echo '<option> Indéfini </option>';
										}
									}

								?>
							</select>
					    </div>

					</div>

						<div class="form-group">
						    <label>Nom de salle*</label>
						    <div>
						    	<input type="text" class="form-control input-lg" id="nameRoom" placeholder="Entrez le nom de la salle" minlength="5" maxlength="100">
						    	<small>5 caractères minimum</small>
						    </div>
						</div>
						
					<p>* : champs obligatoires</p>
				</form>
			</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Annuler</button>
			<button type="button" class="btn btn-success btn-lg" onclick="addRoom()">Ajouter</button>
		</div>

				

		</div>
	</div>
</div>

	
</center>

<?php

include "footer.php";

?>