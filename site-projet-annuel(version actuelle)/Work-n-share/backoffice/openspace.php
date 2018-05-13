<?php

include "header.php";

require "class/openspaceClass.php";

$openspace = new Openspace();
$result = $openspace->loadOpenspaces();



?>
<div class="page-header">
  <h2>Gestion des openspaces</h2>
</div>

<!--<select id="selectOpenspace" name="selectOpenspace" onchange="loadSchedules()">

	<option>Sélectionnez un openspace</option>
	<?php

	//foreach($result as $res){

		//echo "<option id = 'idOption' value='" . $res[0] . "'>" . $res[1] ."</option>";
	//}

	?>


</select>
-->
<div id="scheduleTable"></div>
<script>
	document.getElementById('scheduleTable').onload = loadPage('arrayOpenspace.php', 'scheduleTable');

</script>

<?php

include "footer.php";

?>