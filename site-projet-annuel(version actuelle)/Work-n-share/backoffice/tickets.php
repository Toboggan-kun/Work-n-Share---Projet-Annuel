<?php

include "header.php";
require "class/ticketClass.php";
$ticket = new Ticket();

$state_number = $ticket->loadStateTicket();

$states = array("En attente de traitement", "En cours de traitement", "En retard", "Terminé");
$states_color = array("black", "orange", "red", "green");

?>
<div id="ticketArrayPage">
<div class="page-header">
	<h2>Gestion des tickets</h2>
</div>
<a href="addTicket.php" class="btn btn-info btn-lg">Créer un ticket</a>
<form class="form-horizontal" action="">
  <div class="form-group">
    <label class="control-label col-sm-2">Filtrage</label>
    <div class="col-sm-3">
      <select class="form-control" onchange="loadTicketArray()" id="stateTicket">
        <option>Tous</option>
        <?php

          foreach ($state_number as $data) {

            echo '<option>'.$states[$data[0]].'</option>';
          }
        ?>

      </select>
    </div>
  </div>
</form>
<div id="arrayTicket"></div>
<script type="text/javascript" src="js/script.js" onload="loadPage('arrayTicket.php', 'arrayTicket')"></script>
</div>