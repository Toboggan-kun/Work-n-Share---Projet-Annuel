<?php 
include "header.php";
require "form.php";
require "conf.inc.php";
require "functions.php";
$form = new Form($_POST);
$db = connectDb();


?>
<body>
	<form action="saveuser.php" method = "POST"> 	
		<?php 
		echo $form -> input('nameUser');
		echo $form -> input('surnameUser');
		echo $form -> input('emailUser');
		echo $form -> input('passwordUser');
		echo $form -> input('passwordUser2');
		echo $form -> submit();
		echo "ok";
		?>	
</body>
<?php
include "footer.php";
?>