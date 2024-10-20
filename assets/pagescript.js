

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

function validate_size() {
	var size = document.querySelector("#size");
	var pass = true;
	
	var float_size = parseFloat(size.value);
	
	// check if size is a number
	if (isNaN(float_size)) {
		pass = false;
	}
	
	// negative sizes probably won't make sense here, so filter them out
	if (float_size < 0.0) {
		pass = false;
	}


	if (!pass) {
		document.querySelector("#size-error").style = "";
	} else {
		document.querySelector("#size-error").style = "display:none";
	}
	
	return pass;
}

function validate_weight() {
	var weight = document.querySelector("#weight");
	var pass = true;
	
	var float_weight = parseFloat(weight.value);
	
	// check if weight is a number
	if (isNaN(float_weight)) {
		pass = false;
	}
	
	// I think that we can allow negative weights -- maybe you're selling
	// helium balloons

	if (!pass) {
		document.querySelector("#weight-error").style = "";
	} else {
		document.querySelector("#weight-error").style = "display:none";
	}
	
	return pass;
}

function validate_dimension() {
	var width = document.querySelector("#width");
	var height = document.querySelector("#height");
	var length = document.querySelector("#length");
	var pass = true;
	
	var float_width = parseFloat(width.value);
	var float_height = parseFloat(height.value);
	var float_length = parseFloat(length.value);
	
	// check if size is a number
	if (isNaN(float_width) || isNaN(float_height) || isNaN(float_length)) {
		pass = false;
	}
	
	// negative dimensions are definitely not a thing
	if (float_width < 0.0 || float_height < 0.0 || float_length < 0.0) {
		pass = false;
	}

	if (!pass) {
		document.querySelector("#dimension-error").style = "";
	} else {
		document.querySelector("#dimension-error").style = "display:none";
	}
	
	return pass;
}

function product_change() {
	var product = document.querySelector("#productType").value;
	
	var hide = function(thing) { thing.style = "display:none"; };
	var show = function(thing) { thing.style = ""; };
	
	document.querySelectorAll(".disc-options").forEach(hide);
	document.querySelectorAll(".book-options").forEach(hide);
	document.querySelectorAll(".furniture-options").forEach(hide);
	
	switch (product) {
		case "DVD":
			document.querySelectorAll(".disc-options:not([id='size-error'])").forEach(show);
			//validate_size();
			break;
		case "Book":
			document.querySelectorAll(".book-options:not([id='weight-error'])").forEach(show);
			//validate_weight();
			break;
		case "Furniture":	
			document.querySelectorAll(".furniture-options:not([id='dimension-error'])").forEach(show);
			//validate_dimension();
			break;
		default:
			break;
	}
}


function validate_all() {
	var pass = true;
	
	if (!validate_sku()) pass = false;
	if (!validate_name()) pass = false;
	if (!validate_price()) pass = false;
	
	switch (document.querySelector("#productType").value) {
		case "DVD":
			if (!validate_size()) pass = false;
			break;
		case "Book":
			if (!validate_weight()) pass = false;
			break;
		case "Furniture":
			if (!validate_dimension()) pass = false;
			break;
		default:
			break;
	}

	return pass;
}