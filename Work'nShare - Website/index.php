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
		echo $form ->input('username');
		echo $form ->input('password');
		echo $form -> submit();
		?>	
</body>
<?php
include "footer.php";
?>