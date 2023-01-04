function requestProducts(page_name, value) {
	const xhttp = new XMLHttpRequest();

	xhttp.onload = function () {
		var prod_data = JSON.parse(this.responseText);
		var doc_elem = document.getElementById('products');
		for (let i = 0; i < prod_data.length; i++) {
			var div_open = '<div class="prod_data">';
			if (prod_data[i].stock > 0) {
				if (!!prod_data[i].sale) {
					var price = '<strong>Price:</strong> <span class="sale">' + prod_data[i].price + ' </span> ' +  prod_data[i].sale; 
				} else {
					var price = '<strong>Price:</strong> ' + prod_data[i].price;
				}
				var button = '<li><button onclick=addToCart("' + prod_data[i].prodid + '")>Add To Cart</button></li>';
			} else {
				div_open = '<div class="prod_data" disabled>';
				var price = '<strong>Out of Stock</strong>';
				var button = '';
			}

			doc_elem.innerHTML += div_open + '<img src="' + prod_data[i].img + '" alt="Image of item"><br/><ul><li><strong>' + prod_data[i].name + '</strong></li><li>' + price + '</li>' + button + '<li style="display: none" onclick="add2cart(' + prod_data[i].prodid + ')"></li></ul></div>';
		}
	}

	xhttp.open("GET", page_name + ".php?q=" + value + "_2", true);
	xhttp.send();
}

function addToCart(prodid) {
	const xhttp = new XMLHttpRequest();
	xhttp.onload = function () {
		if (this.responseText === '') {
			alertify.message("Please Login First!");
		} else {
			const xhttp2 = new XMLHttpRequest();

			xhttp2.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					alertify.message("Added to cart");
				}
			};

			xhttp2.open("GET", "add2cart.php?q=" + prodid, true);
			xhttp2.send();
		}
	}

	xhttp.open("GET", "login_status.php", true);
	xhttp.send()
}
