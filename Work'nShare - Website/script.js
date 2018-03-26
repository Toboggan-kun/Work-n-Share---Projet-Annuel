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

function showPopup(idContent){
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
}

function editProfile(){

  var node = document.createElement('INPUT');
  node.setAttribute("placeholder", "currentName");
  node.setAttribute("type", "text");


  var request = getXhr();
  var result = [];
  request.onreadystatechange = function(){

    if(request.readyState == 4){

      if(request.status == 200){

          var result = request.responseText;
          console.log(result.innerHTML);
          for(var i = 0; i < result.length - 1; i++){
            result[i].appendChild(node);
          }
          //document.getElementById('labelEditProfileForm') = request.responseText; //AFFICHAGE DANS LA BALISE FORM


      }

    }

  }


  request.open('POST', 'userProfile.php', false);
  var parent = document.getElementById('editProfileForm'); //ON RECUPERE L'ID DU FORMULAIRE
  var child = document.querySelectorAll('label');
  console.log(child);
  request.send(child);


}
function deleteUser(idUser){

  var request = getXhr();
  request.onreadystatechange = function(){

  }
  var data = document.getElementById(idUser);
  alert(data);

}
