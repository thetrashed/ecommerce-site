"use strict";
function validateLogin() {
	var form_data = new FormData();
	form_data.append('username', document.getElementById('uname'));
	form_data.append('password', document.getElementById('password'));

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById('uname').value = this.responseText;
		}
	};
	xhttp.open('POST', 'login.php', true);
	xhttp.send(form_data);
}
