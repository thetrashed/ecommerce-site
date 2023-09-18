function validateUNUniqueness(str) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById('uniqueness').innerHTML = this.responseText;
		}
	};

	xhttp.open('GET', 'signup.php?q=' + str, true);
	xhttp.send();
}
