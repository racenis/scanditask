

function validate_sku() {
	var sku = document.querySelector("#sku");
	var pass = true;
	
	// check if sku is just whitespace
	if (sku.value.replace(/\s/g, '') == "") {
		pass = false;
	}
	
	// check if it will fit in the database
	if (sku.value.length > 255) {
		pass = false;
	}
	
	if (!pass) {
		document.querySelector("#sku-error").style = "";
	} else {
		document.querySelector("#sku-error").style = "display:none";
	}
	
	return pass;
}

function validate_name() {
	var name = document.querySelector("#name");
	var pass = true;
	
	// check if name is just whitespace
	if (name.value.replace(/\s/g, '') == "") {
		pass = false;
	}
	
	// check if name will fit in database
	if (name.value.length > 1023) {
		pass = false;
	}
	
	if (!pass) {
		document.querySelector("#name-error").style = "";
	} else {
		document.querySelector("#name-error").style = "display:none";
	}
	
	return pass;
}

function validate_price() {
	var price = document.querySelector("#price");
	var pass = true;
	
	var float_price = parseFloat(price.value);
	
	// check if price is a number
	if (isNaN(float_price)) {
		pass = false;
	}
	
	// negative prices probably won't make sense here, so filter them out
	if (float_price < 0.0) {
		pass = false;
	}
	
	if (!pass) {
		document.querySelector("#price-error").style = "";
	} else {
		document.querySelector("#price-error").style = "display:none";
	}
	
	return pass;
}

function product_change() {
	var product = document.querySelector("#productType").value;
	
	switch (product) {
		case "DVD":
		
			break;
		case "Book":
		
			break;
		case "Furniture":
		
			break;
		default:
			break;
	}
}
