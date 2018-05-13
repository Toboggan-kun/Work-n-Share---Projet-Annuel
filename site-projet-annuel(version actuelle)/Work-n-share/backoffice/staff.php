<?php

include "header.php";


?>


	<h2> Gestion des salariés </h1>
	<a href="manageUsers.php"><i class="fas fa-undo"></i></a><p>Gestion des utilisateurs</p>
	<input type="button" value="Ajouter un nouveau salarié Work'n Share">
	<div id="refresh"></div> <!-- ICI -->
	<script onload="" src="js/script.js"></script>

	<div>
		<label>Nom<input type="text" placeholder="Nom" required="required"></label>
		<label>Prénom<input type="text" placeholder="Prénom" required="required"></label>
		<label>Prénom<input type="mail" placeholder="Mail" required="required"></label>
		<label>Date de naissance<input type="date"  required="required" max="2000-12-31"></label>
		<label>Téléphone<input type="mail" placeholder="Mail" required="required"></label>
		<p>Après validation du formulaire, un mot de passe sera généré pour ce nouveau salarié.</p>
		<input type="button" value="Valider">
	</div>


</center>

<?php

include "footer.php";
?>
