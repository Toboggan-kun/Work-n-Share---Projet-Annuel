<?php

include "header.php";
require "class/formClass.php";

require "class/validFormClass.php";
$validators = new Validators($_POST);

$form = new Form($_POST);

//1/ VERIFIER SI LES CHAMPS SONT VIDES
$validators->notEmpty($_POST);
?>
<center>
<section>

	<form action="saveuser.php" method = "POST"> 	
		<?php
			echo $form->input('nameUser', 'Nom');
			echo $form->input('surnameUser', 'Prénom');
			echo $form->input('emailUser', 'Email');
			echo $form->input('passwordUser', 'Mot de passe');
			echo $form->input('passwordUser2', 'Confirmez votre mot de passe');
			echo $form->submit('Envoyer');
		
		?>
	</form>
</section>	
</center>






<?php

include "footer.php";

?>