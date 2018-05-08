
function loadChatBox(){

	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
	    if (xhr.status === 200 && xhr.readyState == 4) {
	        document.getElementById('chatBox').innerHTML = xhr.responseText;
	    }
	};
	xhr.open('GET', '../messagerie/index.html', true);
	xhr.send();
}
