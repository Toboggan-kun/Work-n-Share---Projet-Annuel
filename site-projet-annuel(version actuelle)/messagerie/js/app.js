/**
 * Il nous faut une fonction pour récupérer le JSON des
 * messages et les afficher correctement
 */
function getMessages(){
  // 1. Elle doit créer une requête AJAX pour se connecter au serveur, et notamment au fichier handler.php
  const requeteAjax = new XMLHttpRequest();
  requeteAjax.open("GET", "handler.php");

  // 2. Quand elle reçoit les données, il faut qu'elle les traite (en exploitant le JSON) et il faut qu'elle affiche ces données au format HTML
  requeteAjax.onload = function(){
    const resultat = JSON.parse(requeteAjax.responseText);
    const html = resultat.reverse().map(function(message){
      return `
        <div class="message">
          <span class="date">${message.created_at.substring(11, 16)}</span>
          <span class="content">${message.content}</span>
        </div>
      `
    }).join('');

    const messages = document.querySelector('.messages');

    messages.innerHTML = html;
    messages.scrollTop = messages.scrollHeight;
  }

  // Envoi de la requête
  requeteAjax.send();
}

/*Envoi et raffraichissement messages */

function postMessage(event){
  //Stop submit formulaire
  event.preventDefault();

  // Recupère les données du formulaire
  //const author = document.querySelector('#author');
  const content = document.querySelector('#content');

  // Elle doit conditionner les données
  const data = new FormData();
  //data.append('author', author.value);
  data.append('content', content.value);

  // Requête ajax, envoi
  const requeteAjax = new XMLHttpRequest();
  requeteAjax.open('POST', 'handler.php?task=write');
  
  requeteAjax.onload = function(){
    content.value = '';
    content.focus();
    getMessages();
  }

  requeteAjax.send(data);
}

document.querySelector('form').addEventListener('submit', postMessage);

/*2 secondes d'interval (raffraichissement messages) qui donnent une impression instantannée */
const interval = window.setInterval(getMessages, 2000);

getMessages();