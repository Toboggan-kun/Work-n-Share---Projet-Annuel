<h1>Ajouter un matériel</h1>

<form>
	<input type="hidden" name="page" value="add_hardware">
	<p>
		<label for="type">Type :</label>
		<input type="text" id="type" name="type" placeholder="Ordinateur portable">
	</p>

	<p>
		<label for="name">Désignation :</label>
		<input type="text" id="name" name="name">
	</p>

	<p>
		<label for="serial_number">Numéro de série :</label>
		<input type="text" id="serial_number" name="serial_number">
	</p>

	<p>
		<label for="assignment">Assignation :</label>
		<input type="text" id="assignment" name="assignment">
	</p>

	<p>
		<label for="date_purchase">Date d'achat :</label>
		<input type="date" id="date_purchase" name="date_purchase">
	</p>
	
	<p>
		<button>Envoyer</button>
	</p>
</form>