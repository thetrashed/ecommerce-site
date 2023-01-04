function createForm(value) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById('main-body').innerHTML = this.responseText;
			autoFill();
		}
	};
	xhttp.open("GET", "contact.php?q=" + value, true);
	xhttp.send();
}

function autoFill() {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText.slice(2) === 'NotLoggedIn') {
				alertify.message("Please login to fill information in automatically!");
			} else {
				var response = JSON.parse(this.response)[0];
				console.log(response.email_addr);

				document.getElementById('cus_fname').value = response.cus_fname;
				document.getElementById('cus_lname').value = response.cus_lname;
				document.getElementById('cus_phone').value = response.cus_phone;
				document.getElementById('con_po_no').value = response.con_po_no;
				document.getElementById('email_addr').value = response.email_addr;
			}
		}
	};

	xhttp.open("GET", "autofill.php", true);
	xhttp.send();
}
