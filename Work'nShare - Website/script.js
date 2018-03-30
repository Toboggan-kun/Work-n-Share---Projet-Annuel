
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

/*function showPopup(idContent){
  alert(idContent);
  if(idContent == null || idContent == 'undefined'){
    alert("Cet id n'existe pas");
  }
  var content = document.getElementById(idContent);

  alert(content);
  if(content.style.display == "block"){
    alert('ok');
    content.style.display = "none";
  }else{
    alert('ok');
    content.style.display = "block";
  }
  alert('ok!');
}*/

function editProfile(){

  var request = getXhr();
  var subChild = [];
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
function setMaintenance(){
  var request = getXhr();
  request.onreadystatechange = function(){

    if(request.readyState == 4){
      if(request.status == 200){
        //alert(request.responseText);
        document.getElementById('response').innerHTML = request.responseText;
        //document.getElementById('response').innerHTML = request.responseText;
        //document.getElementById('refresh').innerHTML = request.responseText;
      }
    }
  }
  request.open('GET', 'filterArrayRoom.php?="display"');
  request.send();
}

function addRoom(){
  var request = getXhr();
  request.onreadystatechange = function(){

    if(request.readyState == 4){
      if(request.status == 200){
        //alert(request.responseText);
        document.getElementById('response').innerHTML = request.responseText;
        //document.getElementById('response').innerHTML = request.responseText;
        //document.getElementById('refresh').innerHTML = request.responseText;
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
  }
  var nameRoom = document.getElementById("nameRoom").value;

  if(idOpenSpace != NaN && typeOpenSpace != NaN && nameRoom.length != 0){
    newRoom.push(idOpenSpace, typeOpenSpace, nameRoom);
    console.log(newRoom);
    var result = 'result=' + newRoom.join('|');
    console.log(result);
    request.send(result);

  }else{
    alert('Veuillez saisir toutes les informations');
  }
  
  
}