<h1>Créer un ticket</h1>

<form>
	<input type="hidden" name="page" value="add_ticket">
	<p>
		<label for="title">Titre</label>
		<input type="text" id="title" name="title">
	</p>

	<p>
	<label for="author">Auteur</label>
		<input type="text" id="author" name="author">
	</p>

	<p>
		<label for="description">Description</label><br>
		<textarea name="description" id="description" cols="30" rows="10"></textarea>
	</p>

	<p>
		<button>Envoyer</button>
	</p>
</form>