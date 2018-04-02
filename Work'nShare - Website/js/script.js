
function getXhr(){
  var xhr = null;
  if(window.XMLHttpRequest){ //SI NAVIGATEURS (Firefox, Chrome...)
    xhr = new XMLHttpRequest(); //INSTANCIATION DE L'OBJET XHR

  }else if(window.ActiveXObject){ //SI INTERNET EXPLORER
      try{
        xhr = new ActiveXObject("Msxml2.XMLHTTP"); //INSTANCIATION DE L'OBJET AXO

      }catch(e){
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
      }
  }else{

    alert("Votre navigateur de supporte pas les objets XHR.");
    xhr = false;
  }
  return xhr;
}
function refreshArray(){


  var request = getXhr(); //INSTANCIATION DE L'OBJET XHR

  request.onreadystatechange = function(){

    if(request.readyState == 4){

      if(request.status == 200){ //SI STATUT OK
        //ON AJOUTE LES INFORMATIONS DU FICHIER filterArrayRoom.php DANS UNE DIV
        document.getElementById('response').innerHTML = request.responseText;


      }
    }

  }
  request.open('POST', 'filterArrayRoom.php', true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  var data = document.getElementById('selectOpenspace');
  var val = data.options[data.selectedIndex].value;

  val = 'idOpenSpace=' + val;

  request.send(val);


}

function showPopup(){


  var background = document.getElementById('background');
  background.style.display = "block";
  

}

function closePopup(){
  var popup = document.getElementById('background');
  popup.style.display = "none";
}

function editProfile(){

  var request = getXhr();

  request.onreadystatechange = function(){

    if(request.readyState == 4){

      if(request.status == 200){

          console.log(request.responseText);
          document.getElementById('display').innerHTML = request.responseText; //AFFICHAGE DANS LA BALISE FORM

      }

    }

  }
  request.open('GET', 'editProfile.php', true);
  request.send();


}
function deleteUser(idUser){

  

  var request = getXhr();
  request.onreadystatechange = function(){

    if(request.readyState == 4){
      if(request.status == 200){
        //alert(request.responseText);
        document.getElementById('refresh').innerHTML = request.responseText;
      }
    }
  }
request.open('POST', 'deleteUser.php', true);
request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  var data = document.getElementById(idUser).getAttribute('id');
  console.log(data);
  var result = 'user=' + data;
  console.log(result);

  request.send(result);


}

function addRoom(){
  var request = getXhr();
  request.onreadystatechange = function(){

    if(request.readyState == 4){
      if(request.status == 200){
        refreshArray();
      }
    }
  }
  request.open('POST', 'filterArrayRoom.php', true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  var newRoom = [];
  var idOpenSpace = parseInt(document.getElementById("selectIdOpenspace").value);
  var typeOpenSpace = document.getElementById("selectType").value;

  if(typeOpenSpace === "Cosy"){
    typeOpenSpace = 0;
  }else if(typeOpenSpace === "Appels"){
    typeOpenSpace = 2;
  }else if(typeOpenSpace === "Réunion"){
    typeOpenSpace = 1;
  }
  var nameRoom = document.getElementById("nameRoom").value;

  if(idOpenSpace != NaN && typeOpenSpace != NaN && nameRoom.length != 0){
    newRoom.push(idOpenSpace, typeOpenSpace, nameRoom);
    console.log(newRoom);
    var result = 'addRoom=' + newRoom.join('|');
    console.log(result);
    request.send(result);

  }else{
    alert('Veuillez saisir toutes les informations');
  }


}
function deleteRoom(nameRoom){
  var request = getXhr();
  request.onreadystatechange = function(){

    if(request.readyState == 4){
      if(request.status == 200){

        refreshArray();
      }
    }
  }
  request.open('POST', 'filterArrayRoom.php', true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  
  var name = "deleteRoom=" + nameRoom;
  request.send(name);

}
function addEvent(){
  var request = getXhr();
  request.onreadystatechange = function(){

    if(request.readyState == 4){
      if(request.status == 200){
        //alert(request.responseText.value);
        closePopup();
        document.getElementById('eventArrayMiniature').innerHTML = request.responseText;
      }
    }
  }
  request.open('POST', 'addEvent.php', true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  var newEvent = [];
  var titleEvent = document.getElementById("titleEvent").value;
  var addressEvent = document.getElementById("addressEvent").value;
  var dateEvent = document.getElementById("dateEvent").value;
  var hourEvent = document.getElementById("hourEvent").value;
  var descriptionEvent = document.getElementById("descriptionEvent").value;

  newEvent.push(titleEvent, addressEvent, dateEvent, hourEvent, descriptionEvent);

  var result = "addEvent=" + newEvent.join('|');
  console.log(result);
  request.send(result);
}
function setMaintenance(nameRoom, maintenanceOption){

  var request = getXhr();
  request.onreadystatechange = function(){
    if(request.readyState == 4){
      if(request.status == 200){
        

        refreshArray();
      }
    }
  }
  request.open('POST', 'filterArrayRoom.php', true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  if(maintenanceOption === 1){ //SI L'ON SOUHAITE METTRE EN MAINTENANCE UNE SALLE
    var result = "nameRoomSetMaintenance=" + nameRoom;
 
  }else if(maintenanceOption === 0){ //SINON ON SOUHAITE ANNULER LA MAINTENANCE
    var result = "nameRoomUnsetMaintenance=" + nameRoom;
  }

  request.send(result);
}
