function getCartItems() {
	const xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var htmlTag = document.getElementById("cart-items");
			var response = JSON.parse(this.response);
			console.log(response);

			total_price = 0;
			prodids_query = '';
			if (response.length != 0) {
				for (var i = 0; i < response.length; i++) {
					prodids_query += '&item'+i+'='+response[i].prodid;

					if (response[i].sale !== '') {
						response[i].price = response[i].sale;
					}
					htmlTag.innerHTML += '<li><img src="'+response[i].img+'"></img><p><span>'+response[i].name+'</span><span class="price">'+response[i].price+'</span></p><p><span style="width:60px;"></span><p>Quantity: '+response[i].quantity+'</p><span style="width:60px;"></span><p>'+((response[i].details === '') ? response[i].details : '')+'</p></li><br/><hr>';
					total_price += parseInt(response[i].price.slice(3)) * parseInt(response[i].quantity);
				}
				htmlTag.innerHTML += '<li id="total_price"><strong>Total</strong>: Rs. '+total_price+'</li>';
				htmlTag.innerHTML += '<li><button id="checkout" onclick="checkout()">Checkout</button></li>';

				var body = document.getElementsByClassName('cart');
				console.log(body);
				body[0].innerHTML += '<span id="prodids" style="display:none">'+prodids_query+'</span>';
			} else {
				htmlTag.innerHTML = '<h2 style="text-align:center"> Your cart is empty </h2>'
			}
		}
	};

	xhttp.open('GET', 'cart.php?q=1', true);
	xhttp.send();
}

function checkout() {
	const xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (this.response.slice(2) === 'Done') {
				alertify.message('Order placed!');
				window.location.replace('/index');
			} else {
				alertify.message('Some error occurred. Please try again later.');
			}
		}
	};
	var query_str = document.getElementById("prodids").innerHTML.replace(/&amp;/g, '&');


	xhttp.open('GET', 'cart.php?'+query_str.slice(1), true);
	xhttp.send();
}
