
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

function showPopup(idDiv){
  console.log(idDiv);
  var background = document.getElementById(idDiv);
  background.style.display = "block";
  console.log("ok");
  

}

function closePopup(idDiv){
  var popup = document.getElementById(idDiv);
  popup.style.display = "none";
}

function editProfile(){


  var values = [];
  var inputs = [];

  var name = document.getElementById("labelInfo1").innerText;
  var surname = document.getElementById("labelInfo2").innerText;
  var mail = document.getElementById("labelInfo3").innerText;
  var phone = document.getElementById("labelInfo4").innerText;

  //CREATION DES 4 INPUTS DE TYPE TEXT
  values.push(name, surname, mail, phone);
  for(var i = 0; i < values.length; i++){
    inputs[i] = document.createElement('input');
    inputs[i].setAttribute('type', 'text');
    inputs[i].setAttribute('class', 'inputs');
    inputs[i].setAttribute('value', values[i]);
  }
  var undoButton = document.getElementById('undoButton');


  //RECUPERE L'ID DES BALISES POUR POUVOIR TOUCHER AUX ATTRIBUTS CSS
  var nameHide = document.getElementById("labelInfo1");
  var surnameHide = document.getElementById("labelInfo2");
  var mailHide = document.getElementById("labelInfo3");
  var phoneHide = document.getElementById("labelInfo4");

  //LA BALISE <p> DEVIENT INVISIBLE
  hide(nameHide);
  hide(surnameHide);
  hide(mailHide);
  hide(phoneHide);

  //ON AJOUTE LES INPUTS A LA PLACES DES <p>
  document.getElementById('inputInfo1').appendChild(inputs[0]);
  document.getElementById('inputInfo2').appendChild(inputs[1]);
  document.getElementById('inputInfo3').appendChild(inputs[2]);
  document.getElementById('inputInfo4').appendChild(inputs[3]);

  //AFFICHER LE BOUTON ANNULER
  display(undoButton);


  document.getElementById('editButton').setAttribute('onclick', '');


}
function undo(){
  var nameHide = document.getElementById("labelInfo1");
  var surnameHide = document.getElementById("labelInfo2");
  var mailHide = document.getElementById("labelInfo3");
  var phoneHide = document.getElementById("labelInfo4");
  var undoButton = document.getElementById("undoButton");

  /* ON REAFFICHE LES BALISES <p> */
  display(nameHide);
  display(surnameHide);
  display(mailHide);
  display(phoneHide);

  //CACHE LE BOUTON Annuler
  hide(undoButton);

  var inputs = document.getElementsByClassName('inputs');

  for(var i = 0; i < inputs.length; i++){
    hide(inputs[i]);
  }
  document.getElementById('editButton').setAttribute('onclick', 'editProfile()');
  


}
function hide(node){

  node.style.display = "none";
}
function display(node){
  node.style.display = "block";
}
document.getElementById('refresh').onload = userArray();
function userArray(){
 
  var request = getXhr();
  request.onreadystatechange = function(){

    if(request.readyState == 4){
      if(request.status == 200){

        document.getElementById("refresh").innerHTML = request.responseText;
      }
    }
  }
  request.open('GET', 'deleteUser.php', true);
  request.send();
}
/*var test = 0;
function isClicked(value){
  return value;

}*/

function deleteUser(idUser){



  console.log(idUser);
  //document.getElementById('buttonSubmit').onclick = showPopup(); //OUVRE LA POPUP


  //if(test == 1){
    console.log(document.getElementById('submitAction').onclick);

  var request = getXhr();
  request.onreadystatechange = function(){

    if(request.readyState == 4){
      if(request.status == 200){

        var id = request.responseText;
        closePopup(idUser); //FERME LA POPUP
        document.getElementById("refresh").innerHTML = request.responseText;
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
  
  //}


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
  if(maintenanceOption == 1){ //SI L'ON SOUHAITE METTRE EN MAINTENANCE UNE SALLE
    var result = "nameRoomSetMaintenance=" + nameRoom;
    alert(result);
  }else if(maintenanceOption == 0){ //SINON ON SOUHAITE ANNULER LA MAINTENANCE
    var result = "nameRoomUnsetMaintenance=" + nameRoom;
  }

  request.send(result);
}
