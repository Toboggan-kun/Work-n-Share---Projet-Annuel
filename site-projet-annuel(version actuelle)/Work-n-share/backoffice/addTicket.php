<?php

include "header.php";
require "class/ticketClass.php";
require_once "class/equipmentClass.php";
$equipment = new Equipment();
$ticket = new Ticket();

$listEquipment = $equipment->loadEquipments();


?>

<div class="page-header">
  <h2>Création d'un ticket</h2>
</div>
<div id="addTicket"></div>

<script type="text/javascript" src="js/script.js" onload="loadPage('ticketError.php', 'addTicket')"></script>

<form class="form-horizontal" action="/action_page.php">
  <div class="form-group">
    <label class="control-label col-sm-3">Sujet du ticket</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" id="subjectTicket" placeholder="Entrez le sujet de l'incident">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-3">Désignation de l'équipement</label>
    <div class="col-sm-7">
      <select class="form-control" id="select_equip" required="required" onchange="getSelectedEquipment()">
        <option value="">Veuillez choisir l'équipement concerné</option>
      <?php
        foreach ($listEquipment as $value) {
          echo '<option>'.$value[1].'</option>';
        }
      ?>
      </select>
      
    </div>
  </div>
  <div class="form-group" style="display: none" id="dataEquipment">
  
  </div>
  <div class="form-group">
    <label class="control-label col-sm-3" for="pwd">Description de l'incident</label>
    <div class="col-sm-7"> 
      <textarea rows="15" class="form-control" id="descriptionTicket" placeholder="Décrivez-nous l'incident"></textarea>
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-12">
      <button type="button" class="btn btn-success btn-lg" onclick="addTicket()">Envoyer</button>
    </div>
  </div>
</form>


