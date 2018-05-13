
<?php
require "class/ticketClass.php";
$ticket = new Ticket();

$state_number = $ticket->loadStateTicket();

$states = array("En attente de traitement", "En cours de traitement", "En retard", "Terminé");
$states_color = array("blue", "orange", "red", "green");
$query = $ticket->loadTickets();
if(isset($_POST['state_ticket'])){
  
  switch ($_POST['state_ticket']) {
    case 'En attente de traitement':
      $state = 0;
      $query = $ticket->loadTicketsSortByState($state);
      break;
    case 'En cours de traitement':
      $state = 1;
      $query = $ticket->loadTicketsSortByState($state);
      break;
    case 'En retard':
      $state = 2;
      $query = $ticket->loadTicketsSortByState($state);
      break;
    case 'Terminé':
      $state = 3;
      $query = $ticket->loadTicketsSortByState($state);
      break;
    default:
      $query = $ticket->loadTickets();
      break;
  }
}

?>

<div class="container">
  <h2>Liste des tickets</h2>
          
  <table class="table">
    <thead>
      <tr>
        <th>Numéro du ticket</th>
        <th>Intitulé du ticket</th>
        <th>Créé le</th>
        <th>Auteur</th>
        <th>Statut</th>
        <th>Actions</th>
      </tr>
    </thead>
    <?php

        foreach ($query as $value) {

        $date = date('d-m-Y', strtotime($value[3]));
        $hour = date('H:i', strtotime($value[3]));
    ?>
    <tbody>
      <tr>
      <?php
          echo '<td>'.$value[0].'</td>'; //NUMERO
          echo '<td>'.$value[1].'</td>'; //INTITULE
          echo '<td>'.$date." à ".$hour.'</td>'; //CREATION
          echo '<td>'.utf8_encode($value[5]).'</td>'; //AUTEUR

          echo '<td style="color: '.$states_color[$value[2]].'">'.$states[$value[2]].'</td>'; //STATUT : <td style="color: couleur">text</td>

          echo '<td><a href="ticketDataSub.php?id_ticket='.$value[0].'" class="btn btn-info" id="'.$value[0].'"">Visualiser</a></td>'; //ACTION VISUALISER
          //echo '<script type="text/javascript" src="js/script.js" onload="loadPage("ticketDataSub.php?id_ticket='.$value[0].'&state='.$states[$value[2]].', "infoTicket")"></script>';
        
          }
      ?>

      </tr>
    </tbody>
  </table>

</div>
