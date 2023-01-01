function createForm(value) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById('main-body').innerHTML = this.responseText;
		}
	};
	xhttp.open("GET", "contact.php?q=" + value, true);
	xhttp.send();
}
