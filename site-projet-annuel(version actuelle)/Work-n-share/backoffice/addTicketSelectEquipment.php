<?php
  require "class/equipmentClass.php";
  $equipment = new Equipment();
  if(isset($_POST['empty']) || $_POST['nameEquipment']){
    
    if(isset($_POST['empty'])){
      echo '<div class="col-sm-3"></div><div class="col-sm-7"><div class="alert alert-danger fade in">
          <strong>Attention </strong> Vous devez choisir une désignation.
        </div></div>';
    }else if(isset($_POST["nameEquipment"])){
      $equip = $equipment->loadEquipmentByName($_POST['nameEquipment']);
      foreach ($equip as $value) {
        # code...
      }
      echo '<label class="control-label col-sm-3">Ce choix concerne</label>
      <div class="col-sm-7">
        <div class="well well-lg">L\'équipement n° '.$value[0].' <b>'.$value[1].'</b> de la catégorie <b>'.$value[3].'</b></div>
      </div>
    </div>';
    }
  }
?>