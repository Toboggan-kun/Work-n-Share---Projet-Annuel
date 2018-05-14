
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
document.getElementById("response").onload = loadRooms();
function loadRooms(){
  var request = getXhr(); //INSTANCIATION DE L'OBJET XHR

  request.onreadystatechange = function(){

    if(request.readyState == 4){

      if(request.status == 200){ //SI STATUT OK
        //ON AJOUTE LES INFORMATIONS DU FICHIER filterArrayRoom.php DANS UNE DIV
        document.getElementById('response').innerHTML = request.responseText;


      }
    }

  }
  request.open('GET', 'arrayRoom.php', true);
  request.send();
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
  request.open('POST', 'arrayRoom.php', true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  var data = document.getElementById('selectOpenspace');
  var val = data.options[data.selectedIndex].value;

  val = 'idOpenSpace=' + val;

  request.send(val);


}

function showPopup(idDiv){
  console.log(idDiv);
  var background = document.getElementById(idDiv);
  console.log(background);
  background.style.display = "block";



}


function closePopup(idDiv){
  console.log(idDiv);
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
function sendMessage(){

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


function userArray(){

  var request = getXhr();
  request.onreadystatechange = function(){

    if(request.readyState == 4){
      if(request.status == 200){

        document.getElementById("refresh").innerHTML = request.responseText;
      }
    }
  }
  request.open('GET', 'arrayUser.php', true);
  request.send();
}


function deleteUser(idUser){


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
  request.open('POST', 'arrayUser.php', true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  var data = document.getElementById(idUser).getAttribute('id');

  console.log(data);
  var result = 'user=' + data;
  console.log(result);

  request.send(result);




}
function unsuspendUser(idUser){
  var request = getXhr();
  request.onreadystatechange = function(){

    if(request.readyState == 4){
      if(request.status == 200){

        document.getElementById("refresh").innerHTML = request.responseText;
      }
    }
  }
  request.open('POST', 'arrayUser.php', true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  var data = document.getElementById(idUser).getAttribute('id');

  console.log(data);
  var result = 'unsuspend_user=' + data;
  console.log(result);

  request.send(result);
}
loadPage('addRoom.php', 'headerFormRoom');
function addRoom(){
  var request = getXhr();
  request.onreadystatechange = function(){

    if(request.readyState == 4){
      if(request.status == 200){

        refreshArray();
        loadPage('addRoom.php', 'headerFormRoom');


      }
    }
  }
  request.open('POST', 'addRoom.php', true);
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
  }else{
    typeOpenSpace = null;
  }
  var nameRoom = document.getElementById("nameRoom").value;
  newRoom.push(idOpenSpace, typeOpenSpace, nameRoom);
  console.log(newRoom);
  var result = "addRoom=" + newRoom;
  request.send(result);

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
  request.open('POST', 'arrayRoom.php', true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  console.log(nameRoom);
  var name = "delete_room=" + nameRoom;
  console.log(name);
  request.send(name);

}
function updateRoom(id){
  var request = getXhr();
  request.onreadystatechange = function(){

    if(request.readyState == 4){
      if(request.status == 200){
        refreshArray();
      }
    }
  }
  request.open('POST', 'arrayRoom.php', true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  var idRoom = id;
  var idOpenSpace = parseInt(document.getElementById("selectOpenspaceUpdate").value);
  var typeOpenSpace = document.getElementById("selectTypeUpdate").value;

  if(typeOpenSpace === "Cosy"){
    typeOpenSpace = 0;
  }else if(typeOpenSpace === "Appels"){
    typeOpenSpace = 2;
  }else if(typeOpenSpace === "Réunion"){
    typeOpenSpace = 1;
  }else{
    typeOpenSpace = null;
  }
  var nameRoom = document.getElementById("nameRoomUpdate"+id).value;
  var result = "id=" + idRoom + "&id_openspace=" + idOpenSpace + "&type_openspace=" + typeOpenSpace + "&name_room=" + nameRoom;
  console.log(result);
  request.send(result);
}

//document.getElementById('address').onload = displayAddressForm();
function displayAddressForm(){
  console.log("displayAddressForm");
  var option = document.getElementById("noEvent").checked;

  if(option == true){

      document.getElementById("os").removeAttribute('disabled');
      document.getElementById("addressEvent").setAttribute('readonly', 'readonly');
      document.getElementById("postalCodeEvent").setAttribute('readonly', 'readonly');
      document.getElementById("cityEvent").setAttribute('readonly', 'readonly');
      closePopup('hidden');

  }else{
      document.getElementById("os").setAttribute('disabled', 'disabled');
      document.getElementById("addressEvent").removeAttribute('readonly');
      document.getElementById("postalCodeEvent").removeAttribute('readonly');
      document.getElementById("cityEvent").removeAttribute('readonly');
      showPopup('hidden');

  }
}
function deleteEvent(id){
  var request = getXhr();
  request.onreadystatechange = function(){

    if(request.readyState == 4){
      if(request.status == 200){

        loadPage('arrayEvent.php', 'arrayEvent');
      }
    }
  }
  request.open('POST', 'arrayEvent.php', true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  var name = "deleteEvent=" + id;
  console.log(name);
  request.send(name);
}
var cnt = 0;
function addEvent(){
  var request = getXhr();
  request.onreadystatechange = function(){

    if(request.readyState == 4){
      if(request.status == 200){

        //loadPage('addEvent.php', 'headerFormEvent');

        document.getElementById('eventError').innerHTML = request.responseText;
        if(!document.getElementById('errors') && cnt != 0){
          $('#addEvent').modal('hide');
          loadPage('arrayEvent.php', 'arrayEvent');
        }

        cnt = 1;
        
        console.log(cnt);
        
      }
    }
  }
  request.open('POST', 'addEvent.php', true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  var newEvent = [];
  var titleEvent = document.getElementById("titleEvent").value;
  var addressEvent = document.getElementById("addressEvent").value;
  var postalCodeEvent = document.getElementById("postalCodeEvent").value;
  var option = document.getElementById("noEvent").checked;

  if(option == true){
    option = 0; //SI NON EST COCHE, PAS D'ADRESSE
  }else{ //SINON, RECUPERE LES COORDONNES DE L'ADRESSE
    option = 1;
  }
  var cityEvent = document.getElementById("cityEvent").value;
  var dateEvent = document.getElementById("dateEvent").value;
  var hourEvent = document.getElementById("hourEvent").value;
  var descriptionEvent = document.getElementById("descriptionEvent").value;
  var openspace = document.getElementById('os').value;

  //var result = "title=" + titleEvent + "&address=" + addressEvent + "&postal=" + postalCodeEvent + "&option=" + option + "&city=" + cityEvent + "&date=" + dateEvent + "&hour=" + hourEvent + "&description=" + descriptionEvent;

  newEvent.push(titleEvent, addressEvent, dateEvent, hourEvent, descriptionEvent, postalCodeEvent, cityEvent, option, openspace);

  var result = "addEvent=" + newEvent.join('|');
  console.log(result);
  request.send(result);
}
function setMaintenance(nameRoom, maintenanceOption){
  console.log(nameRoom);
  var request = getXhr();
  request.onreadystatechange = function(){
    if(request.readyState == 4){
      if(request.status == 200){


        refreshArray();


      }
    }
  }
  request.open('POST', 'arrayRoom.php', true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  if(maintenanceOption == 1){ //SI L'ON SOUHAITE METTRE EN MAINTENANCE UNE SALLE
    var result = "nameRoomSetMaintenance=" + nameRoom;

  }else if(maintenanceOption == 0){ //SINON ON SOUHAITE ANNULER LA MAINTENANCE
    var result = "nameRoomUnsetMaintenance=" + nameRoom;
  }

  request.send(result);
}


function addEquipment(){
  var request = getXhr(); //INSTANCIATION DE L'OBJET XHR

  request.onreadystatechange = function(){

    if(request.readyState == 4){

      if(request.status == 200){ //SI STATUT OK


        loadPage('arrayEquipments.php', 'equipmentList');


      }
    }

  }

  var nameEquipment = document.getElementById("nameEquipment").value;
  var idOpenSpace = parseInt(document.getElementById("selectOpenspace").value);
  var typeEquipment = document.getElementById("selectEquipmentType").value;

  request.open('GET', 'arrayEquipments.php?nameEquipment='+ nameEquipment + '&typeEquipment=' + typeEquipment + "&idOpenSpace=" + idOpenSpace, true);
  request.send();

}
function deleteEquipment(id){
  var request = getXhr();
  request.onreadystatechange = function(){

    if(request.readyState == 4){
      if(request.status == 200){

        loadPage('arrayEquipments.php', 'equipmentList');
      }
    }
  }
  request.open('POST', 'arrayEquipments.php', true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  var value = "deleteEquipment=" + id;
  console.log(value);
  request.send(value);
}

function updateEquipment(id){
   var request = getXhr(); //INSTANCIATION DE L'OBJET XHR

  request.onreadystatechange = function(){

    if(request.readyState == 4){

      if(request.status == 200){ //SI STATUT OK


        loadPage('arrayEquipments.php', 'equipmentList');


      }
    }

  }
  request.open('POST', 'arrayEquipments.php', true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  var nameEquipment = document.getElementById("nameEquipment"+id).value;
  var idOpenSpace = parseInt(document.getElementById("selectOpenspace"+id).value);
  var typeEquipment = document.getElementById("selectEquipmentType"+id).value;
  var result = "name_equipment=" + nameEquipment + "&type_equipment=" + typeEquipment + "&id_openSpace=" + idOpenSpace + "&id_equipment=" + id;
  console.log(result);

  request.send(result);
}

function loadSchedules(){
  var request = getXhr(); //INSTANCIATION DE L'OBJET XHR

  request.onreadystatechange = function(){

    if(request.readyState == 4){

      if(request.status == 200){ //SI STATUT OK


        document.getElementById('scheduleTable').innerHTML = request.responseText;


      }
    }

  }
  var data = document.getElementById('selectOpenspace');
  var val = data.options[data.selectedIndex].value;
  console.log(val);
  request.open('GET', 'arrayOpenspace.php?idOpenSpace=' + val, true);
  request.send();
}
function isChecked(form){

  var checked = form.checkbox.checked;
  console.log(checked);
  if(checked == true){

    var openHour = document.getElementById('openHour').setAttribute('readonly', 'readonly');
    var closeHour = document.getElementById('closeHour').setAttribute('readonly', 'readonly');
  }else if(checked == false){
    console.log("loadedf");
    document.getElementById('openHour').removeAttribute('readonly');
    document.getElementById('closeHour').removeAttribute('readonly');
  }


}

function updateSchedules(idOpenSpace, day){
  var request = getXhr(); //INSTANCIATION DE L'OBJET XHR

  request.onreadystatechange = function(){

    if(request.readyState == 4){

      if(request.status == 200){ //SI STATUT OK

        loadPage('arrayOpenspace.php', 'scheduleTable');

      }
    }

  }

  var openHour = document.getElementById('openHour').value;
  var closeHour = document.getElementById('closeHour').value;
  var id = idOpenSpace;
  var dayLabel = day;

  var result = "open=" + openHour + "&close=" + closeHour + "&id=" + id + "&day=" + dayLabel;
  request.open('POST', 'arrayOpenspace.php', true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  console.log(result);
  request.send(result);

}


function loadAddMenuForm(){

  var request = getXhr(); //INSTANCIATION DE L'OBJET XHR

  request.onreadystatechange = function(){

    if(request.readyState == 4){

      if(request.status == 200){ //SI STATUT OK

        //CHARGE LA POPUP DANS LA DIV
        document.getElementById('test').innerHTML = request.responseText;

      }
    }

  }

  request.open('GET', 'addMenu.php', true);
  request.send();
}

function loadArrayMenu(){
  var request = getXhr(); //INSTANCIATION DE L'OBJET XHR

  request.onreadystatechange = function(){

    if(request.readyState == 4){

      if(request.status == 200){ //SI STATUT OK

        //CHARGE LA POPUP DANS LA DIV
        document.getElementById('editMenu').innerHTML = request.responseText;
        closeModal();
      }
    }

  }

  request.open('GET', 'arrayMenu.php', true);
  request.send();
}
function addMenu(){

  showPopup('addMenu');
  var request = getXhr(); //INSTANCIATION DE L'OBJET XHR
  request.onreadystatechange = function(){

    if(request.readyState == 4){

      if(request.status == 200){ //SI STATUT OK

          loadPage('addMenu.php', 'test');
          loadPage('arrayMenu.php', 'editMenu');
          //loadPage('menu.php', 'loadActualMenu');

      }
    }

  }
  var name = document.getElementById('nameMenu').value;
  var starter = document.getElementById('starter').value;
  var dish = document.getElementById('dish').value;
  var dessert = document.getElementById('dessert').value;

  var quantity = document.getElementById('quantity').value;
  console.log(quantity);
  var checked = document.getElementById('no').checked;
  if(checked == true){
    checked = 0; //SI NON EST COCHE, PAS DE MENU DU JOUR
  }else{
    checked = 1; //SINON, LE MENU DOIT ETRE DEFINI EN MENU DU JOUR
  }

  var result = "namemenu=" + name + "&startermenu=" + starter + "&dishmenu=" + dish + "&dessertmenu=" + dessert + "&quantitymenu=" + quantity + "&checkedmenu=" + checked;

  request.open('POST', 'addMenu.php', true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  request.send(result);

  console.log(result);
}

function closeModal(){

  if(!document.getElementById('errors')){
    $("#addMenu").modal('hide');
  }
}

function deleteMenu(idMenu){
  var request = getXhr();
  request.onreadystatechange = function(){

    if(request.readyState == 4){
      if(request.status == 200){

        loadArrayMenu();
        //loadPage('menu.php', 'loadActualMenu');

      }
    }
  }

  var name = "deleteMenu=" + idMenu;
  request.open('POST', 'arrayMenu.php', true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  request.send(name);
}

function loadPage(page, where){
  var request = getXhr(); //INSTANCIATION DE L'OBJET XHR

  request.onreadystatechange = function(){

    if(request.readyState == 4){

      if(request.status == 200){ //SI STATUT OK

        //CHARGE LA POPUP DANS LA DIV
        document.getElementById(where).innerHTML = request.responseText;
        closeModal();
      }
    }

  }

  request.open('GET', page, true);
  request.send();
}

function getDay(){
  var day = document.getElementById('selectDay').value;

}

/**RESERVATION**/
function nextPage(){

  var request = getXhr(); //INSTANCIATION DE L'OBJET XHR

  request.onreadystatechange = function(){

    if(request.readyState == 4){

      if(request.status == 200){ //SI STATUT OK

        closePopup('bookingFormStep1'); //REND LA PAGE 1 INVISIBLE
        closePopup('equip');
        document.getElementById('bookingFormStep2').innerHTML = request.responseText;
        showPopup('recapBooking'); //AFFICHE LA PAGE QUI ETAIT CACHEE DE BASE
        showPopup('paymentForm'); //AFFICHE LE FORMULAIRE DE PAIEMENT
        showPopup('confirmBooking');
        showPopup('payment_form');
      }
    }

  }

  result =  "openspace_booking=" + openspace_booking + 
            "&typeroom_booking=" + typeroom_booking + 
            "&date_booking=" + date_booking + 
            "&hourentrance_booking=" + hourentrance_booking + 
            "&hourexit_booking=" + hourexit_booking +
            "&quantityequipment1_booking=" + quantityequipment1_booking +
            "&quantityequipment2_booking=" + quantityequipment2_booking +
            "&quantitymenu_booking=" + quantitymenu_booking;

  request.open('POST', 'bookingFormConfirm.php', true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.send(result);

  
  console.log(result);


}
function previousPage(){
  
  closePopup('recapBooking'); //N'AFFICHE PLUS LE RECAP DE LA RESERVATION
  closePopup('paymentForm'); //N'AFFICHE PLUS LE FORMUALAIRE DE PAIEMENT
  closePopup('confirmBooking');
  closePopup('bookingFormStep2');
  showPopup('bookingFormStep1'); //REAFFICHE LE FORMULAIRE DE RESERVATION
  showPopup('equip');


}

var openspace_booking;
var room_booking;
var date_booking;
var typeroom_booking;
var hourentrance_booking;
var hourexit_booking;
var quantitymenu_booking = 0;
var quantityequipment1_booking = 0;
var quantityequipment2_booking = 0;
var cardnumber_booking = 0;
var cardmonth_booking = 0;
var cardyear_booking = 0;
var cardsecurity_booking = 0;



function getHour(id){

  var request = getXhr(); //INSTANCIATION DE L'OBJET XHR

  request.onreadystatechange = function(){

    if(request.readyState == 4){

      if(request.status == 200){ //SI STATUT OK

        document.getElementById('selectScheduleExit').innerHTML = request.responseText;
        showPopup(id);
        closePopup('equip');
      }
    }

  }
  hourentrance_booking = document.getElementById('selectedHourEntrance').value;

  request.open('POST', 'bookingForm.php', true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  //request.open('GET', 'bookingForm.php?hourentrance='+selectedHour, true);
  result = 'entrance=' + hourentrance_booking + '&day_booking=' + date_booking + '&nameOpenspace_booking=' + openspace_booking + '&room_value=' + room_booking + "&date_value=" + date_booking;
  //hourentrance=17:00
  console.log(result);
  request.send(result);
  //request.send();


}
function wrongDate(){
  closePopup('hourEntrance'); //OK
  closePopup('hourExit'); 
  closePopup('equip');  
  
}
function getHourExit(){

  var request = getXhr(); //INSTANCIATION DE L'OBJET XHR

  request.onreadystatechange = function(){

    if(request.readyState == 4){

      if(request.status == 200){ //SI STATUT OK

        document.getElementById('selectOptions').innerHTML = request.responseText;
        showPopup("equip");
      }
    }

  }
  hourexit_booking = document.getElementById('selectedHourExit').value;
  request.open('POST', 'bookingForm.php', true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  //request.open('GET', 'bookingForm.php?hourentrance='+selectedHour, true);
  result = 'exit=' + hourexit_booking;
  //hourentrance=17:00
  console.log(result);
  request.send(result);
  //request.send();


}
function getQuantity(){
  var request = getXhr(); //INSTANCIATION DE L'OBJET XHR

  request.onreadystatechange = function(){

    if(request.readyState == 4){

      if(request.status == 200){ //SI STATUT OK

        //document.getElementById('values').innerHTML = request.responseText;
        nextPage();
      }
    }

  }
  if(document.getElementById('equip4')){
    quantityequipment1_booking = document.getElementById('equip4').value;
  }
  if(document.getElementById('computer')){
    quantityequipment2_booking = document.getElementById('computer').value;
  }
  
  quantitymenu_booking = document.getElementById('qtyMenu').value;
  request.open('POST', 'bookingFormConfirm.php', true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  //request.open('GET', 'bookingForm.php?hourentrance='+selectedHour, true);
  result = 'qty_equip1=' + quantityequipment1_booking + '&qty_equip2=' + quantityequipment2_booking + '&qty_menu=' + quantitymenu_booking;
  //hourentrance=17:00
  console.log(result);
  request.send(result);
}
function getQuantityOnchange(){
  quantityequipment1_booking = document.getElementById('equip4').value;
  console.log(quantityequipment1_booking);
  document.getElementById('qty_data').innerHTML = quantityequipment1_booking;
  quantityequipment2_booking = document.getElementById('computer').value;
  document.getElementById('qty_data2').innerHTML = quantityequipment2_booking;

}
function getTypeRoom(id) {
    console.log("getTypeRoom");
    typeroom_booking = id;

    if(document.getElementById('typeRoom'+id).style.background != "grey" && typeroom_booking == 0){

      document.getElementById('typeRoom'+id).style.background = "grey";
      document.getElementById('typeRoom'+1).style.background = "white";
      document.getElementById('typeRoom'+2).style.background = "white";

    }else if(document.getElementById('typeRoom'+id).style.background != "grey" && typeroom_booking == 1){
      document.getElementById('typeRoom'+id).style.background = "grey";
      document.getElementById('typeRoom'+0).style.background = "white";
      document.getElementById('typeRoom'+2).style.background = "white";
    }else if(document.getElementById('typeRoom'+id).style.background != "grey" && typeroom_booking == 2){

      document.getElementById('typeRoom'+id).style.background = "grey";
      document.getElementById('typeRoom'+0).style.background = "white";
      document.getElementById('typeRoom'+1).style.background = "white";
    }
    var request = getXhr(); //INSTANCIATION DE L'OBJET XHR

    request.onreadystatechange = function(){

      if(request.readyState == 4){

        if(request.status == 200){ //SI STATUT OK
          
          document.getElementById('buttonOpenspaceArray').innerHTML = request.responseText;
          showPopup('buttonOpenspace');
          closePopup('inputDate');
          closePopup('hourEntrance');
          closePopup('hourExit');
          closePopup('equip');
          
        }
      }

    }

    request.open('POST', 'bookingForm.php', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    result = 'typeRoom=' + typeroom_booking;
    console.log(result);
    request.send(result);
    



}


function getOpenspace(){
  console.log("getOpenspace");
  openspace_booking = document.getElementById('openspaceValue').value;
  var request = getXhr(); //INSTANCIATION DE L'OBJET XHR

  request.onreadystatechange = function(){

    if(request.readyState == 4){

      if(request.status == 200){ //SI STATUT OK

        document.getElementById('selectRoom').innerHTML = request.responseText;
        showPopup('selectRoomName');
       
      }
    }

  }
  console.log(openspace_booking);
  request.open('POST', 'bookingForm.php', true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  result = 'openspace=' + openspace_booking + "&type=" + typeroom_booking;
  console.log(result);
  request.send(result);
  
}
function getRoom(){
  
  var request = getXhr(); //INSTANCIATION DE L'OBJET XHR

  request.onreadystatechange = function(){

    if(request.readyState == 4){

      if(request.status == 200){ //SI STATUT OK
        
        document.getElementById('selectDate').innerHTML = request.responseText;
        showPopup('inputDate');
        
      }
    }

  }
  room_booking = document.getElementById('room').value;
  request.open('POST', 'bookingForm.php', true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  result = 'room=' + room_booking;
  console.log(result);
  request.send(result);
}
function getDate(){

  if(document.getElementById('hourEntrance')){
    closePopup('hourEntrance'); //OK
  }
  if(document.getElementById('hourExit')){
    closePopup('hourExit'); 
  }
  if(document.getElementById('equip')){
    closePopup('equip');
  }

  var request = getXhr(); //INSTANCIATION DE L'OBJET XHR

  request.onreadystatechange = function(){

    if(request.readyState == 4){
    

      if(request.status == 200){ //SI STATUT OK
        
        document.getElementById('selectScheduleEntrance').innerHTML = request.responseText;
        showPopup('hourEntrance');
        //console.log("OK");
      }
    }

  }

  date_booking = document.getElementById('calendar').value;

  request.open('POST', 'bookingForm.php', true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  result = 'date=' + date_booking + "&openspace2=" + openspace_booking + "&type=" + typeroom_booking + "&room=" + room_booking;
  console.log(result);
  request.send(result);
}
function addBooking(){

  var request = getXhr(); //INSTANCIATION DE L'OBJET XHR

  request.onreadystatechange = function(){

    if(request.readyState == 4){

      if(request.status == 200){ //SI STATUT OK
        
        loadPage('bookingFormErrors', 'errors_booking');
        
        document.getElementById('errors').innerHTML = request.responseText;
      }
    }

  }

  //RECUPERE LES INFORMATIONS DU FORMULAIRE DE PAIEMENT
  cardnumber_booking = document.getElementById('idCard').value;
  cardsecurity_booking = document.getElementById('security_code').value;
  cardmonth_booking = document.getElementById('card_month').value;
  cardyear_booking = document.getElementById('card_year').value

  request.open('POST', 'bookingFormErrors.php', true); 
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  result = 
    "openspace_booking=" + openspace_booking + 
    "&typeroom_booking=" + typeroom_booking +
    "&date_booking=" + date_booking + 
    "&hourentrance_booking=" + hourentrance_booking + 
    "&hourexit_booking=" + hourexit_booking + 
    "&quantityequipment1_booking=" + quantityequipment1_booking + 
    "&quantityequipment2_booking=" + quantityequipment2_booking +
    "&quantitymenu_booking=" + quantitymenu_booking + 
    "&cardnumber_booking=" + cardnumber_booking +
    "&cardsecurity_booking=" + cardsecurity_booking + 
    "&cardmonth_booking=" + cardmonth_booking + 
    "&cardyear_booking=" + cardyear_booking;

  console.log(result);
  request.send(result);

}


/** GESTION DES TICKETS **/
function addTicket(){
  var request = getXhr(); //INSTANCIATION DE L'OBJET XHR

  request.onreadystatechange = function(){

    if(request.readyState == 4){

      if(request.status == 200){ //SI STATUT OK
        
        
        if(document.getElementById('success') && !document.getElementById('errors')){
          document.location.replace('tickets.php');
        }else{
          loadPage('ticketError.php', 'addTicket');
        }
        
      }
    }

  }

  subject = document.getElementById('subjectTicket').value;
  designation = document.getElementById('select_equip').value;
  description = document.getElementById('descriptionTicket').value;
  request.open('POST', 'ticketError.php', true); 
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  result = 
    "subject=" + subject + 
    "&designation=" + designation +
    "&description=" + description;

  request.send(result);
  console.log(result);
}

function loadTicketArray(){

  var request = getXhr(); //INSTANCIATION DE L'OBJET XHR

  request.onreadystatechange = function(){

    if(request.readyState == 4){

      if(request.status == 200){ //SI STATUT OK
        
        document.getElementById('arrayTicket').innerHTML = request.responseText;
      }
    }

  }

  state_ticket = document.getElementById('stateTicket').value;

  request.open('POST', 'arrayTicket.php', true); 
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  result = "state_ticket=" + state_ticket;

  request.send(result);
  console.log(result);

}
function seeTicketWithoutHeader(){
  closePopup('ticketArrayPage');
  showPopup('infoTicket');
}
function sendTicketMessage(id){
  var request = getXhr(); //INSTANCIATION DE L'OBJET XHR

  request.onreadystatechange = function(){

    if(request.readyState == 4){

      if(request.status == 200){ //SI STATUT OK
  
        document.getElementById('loadMsg').innerHTML = request.responseText;
        if(!document.getElementById('errors')){
          loadPage('ticketDataMessage.php?id_ticket=' + id, 'messageTicket');
        }
        
        
      }
    }

  }

  message_ticket = document.getElementById('sendMessage').value;

  request.open('POST', 'ticketDataMessage.php?id_ticket=' + id, true); 
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  result = "message_ticket=" + message_ticket;

  request.send(result);
  console.log(result);
}


function changeStateTicket(id){
  console.log(id);
  var request = getXhr(); //INSTANCIATION DE L'OBJET XHR

  request.onreadystatechange = function(){

    if(request.readyState == 4){

      if(request.status == 200){ //SI STATUT OK
        closePopup('header');
        document.getElementById('infoTicket').innerHTML = request.responseText;


      }
    }

  }

  stateTicket = document.getElementById('stateTicket').value;

  request.open('POST', 'ticketDataSub.php?id_ticket=' + id, true); 
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  result = "state_ticket=" + stateTicket + "&id=" + id;
  request.send(result);
  console.log(result);
}

function getSelectedEquipment(){

  var name = document.getElementById('select_equip').value;
  var request = getXhr(); //INSTANCIATION DE L'OBJET XHR

  request.onreadystatechange = function(){

    if(request.readyState == 4){

      if(request.status == 200){ //SI STATUT OK

        document.getElementById('dataEquipment').innerHTML = request.responseText;
        showPopup('dataEquipment');
        //loadPage('addTicket.php', 'arrayTicket');
      }
    }

  }

  request.open('POST', 'addTicketSelectEquipment.php', true); 
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  if(name == ""){ //SI IL A RIEN SELECT
    result = "empty=" + name;
  }else{
    result = "nameEquipment=" + name;
  }

  request.send(result);
  console.log(result);
}
var subscription;
var engagement;
function getSubscription(){
  var sub1 = document.getElementById('abo1').checked;
  var sub2 = document.getElementById('abo2').checked;

  var request = getXhr(); //INSTANCIATION DE L'OBJET XHR

  request.onreadystatechange = function(){

    if(request.readyState == 4){

      if(request.status == 200){ //SI STATUT OK
        if(subscription == "Sans abonnement"){
          showPopup('nextPage');
        }else{
          closePopup('nextPage');
        }
        //showPopup('sub_info');
        document.getElementById('sub_info').innerHTML = request.responseText;
        
     
      }
    }

  }

  request.open('POST', 'subscriptionFormPart2.php', true); 
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  
  if(sub1 == true){
    subscription = document.getElementById('abo1').value;
    result = "sub=" + subscription;
  }else{
    subscription = document.getElementById('abo2').value;
    result = "sub=" + subscription;
  }

  request.send(result);
  console.log(result);

}
function changeStateSubscription(button){
  var request = getXhr(); //INSTANCIATION DE L'OBJET XHR

  request.onreadystatechange = function(){

    if(request.readyState == 4){

      if(request.status == 200){ //SI STATUT OK
        
        //showPopup('sub_info');

        document.getElementById('price_total').innerHTML = request.responseText;
        showPopup('nextPage');

        
     
      }
    }

  }
  if(button == "noengagementChoice"){
    document.getElementById('engagementChoice').style.background = "";
    document.getElementById('noengagementChoice').style.background = "grey";
    result = "subscription=" + subscription + "&engagement=" + '0';
    engagement = 0;
  }else if(button == "engagementChoice"){
 
    document.getElementById('engagementChoice').style.background = "grey";
    document.getElementById('noengagementChoice').style.background = "";
    result = "subscription=" + subscription + "&engagement=" + '1';
    engagement = 1;
  }
  request.open('POST', 'subscriptionFormPart3.php', true); 
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  


  

  request.send(result);
  console.log(result);
}
function validSubscription(){
  var request = getXhr(); //INSTANCIATION DE L'OBJET XHR

  request.onreadystatechange = function(){

    if(request.readyState == 4){

      if(request.status == 200){ //SI STATUT OK

        //loadPage('paymentFormSubscription.php', 'page2_payment');

        document.getElementById('paymentFormSub').innerHTML = request.responseText;
        showPopup("page2_payment");
        showPopup('payment_form_div');
        if(!document.getElementById('errors')){
          document.location.replace('success.php');
        }
        
        
      }
    }

  }
  //RECUPERE LES INFORMATIONS DU FORMULAIRE DE PAIEMENT
  cardnumber = document.getElementById('idCard').value;
  cardsecurity = document.getElementById('security_code').value;
  cardmonth = document.getElementById('card_month').value;
  cardyear = document.getElementById('card_year').value

  result = "subscription=" + subscription + "&engagement=" + engagement + "&id_card=" + cardnumber + "&security_card=" + cardsecurity + "&card_month=" + cardmonth + "&card_year=" + cardyear;
  request.open('POST', 'paymentFormSubscription.php', true); 
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  request.send(result);
  console.log(result);
}
function switch_div(){
  showPopup('payment_form_div');
  closePopup('alert_sub');
}
function nextPageSubscription(){
  closePopup('sub_part3');
  closePopup('sub_part2');
  closePopup('sub_part1');
  showPopup('page2_payment');

  


}

function previousPageSubscription(){
  closePopup('page2_payment');
  showPopup('sub_part3');
  showPopup('sub_part2');
  showPopup('sub_part1');
  
}