$(document).ready(function(){

	get_accesories();
	
	
});

function get_accesories(){
	$.ajax({
		url: "api/accesories/read.php",
		type: "GET",
		dataType: "json",
		success: function(accesories){
			show_accesories(accesories); control_price_checkboxes();
		},
		error: function(e){
			console.log("Error occured while getting all accesories "+e);
			$.notify("Error while getting accesories", "error");
		}
	})
}

function show_accesories(accesories){

	var table = document.getElementById("table");
	var cpt = 0;

	for(i=0; i<accesories.length; i++){
		if(cpt == accesories.length) break;
		//Get first product of each row
		var previousProduct = accesories[3*i];
		cpt++; 
		var tr = document.createElement("tr");
		var td1 = build(previousProduct); tr.append(td1);

		if(3*i+1 <accesories.length){
			//Get second product of each row
			var nextProduct = accesories[3*i+1];
			cpt++; 
			var td2 = build(nextProduct);
			tr.append(td2);
		}

		if(3*i+2 <accesories.length){
			//Get third product of each row
			var thirdProduct = accesories[3*i+2];
			cpt++; 
			var td3 = build(thirdProduct);
			tr.append(td3);
		}


		if(i%2 == 0)
		 tr.style.backgroundColor = "white";
		table.append(tr);
	}

} 

function build(product){
	var td = document.createElement("td");
	var productParentDiv = document.createElement("div");
	productParentDiv.style.marginTop = "30px";
	productParentDiv.style.marginLeft = "30px";
	var productDivFirstRow = document.createElement("div");
	productDivFirstRow.className = "row";
	productDivFirstRow.style.marginLeft = "20px";
	var productName_h4 = document.createElement("h4");
	productName_h4.innerHTML = product.name;
	var productCategory_h6 = document.createElement("h6");
	productCategory_h6.innerHTML = product.category_name;
	productDivFirstRow.append(productName_h4);
	productDivFirstRow.append(productCategory_h6);
	productParentDiv.append(productDivFirstRow);
	var productDivSecondRow = document.createElement("div");
	productDivSecondRow.className = "row";
	var productDivSecondRow_innerDiv1 = document.createElement("div");
	productDivSecondRow_innerDiv1.className = "col-md-6";
	var productImage_img = document.createElement("img");
	productImage_img.src = product.image_url;
	productImage_img.alt = "tea";
	productImage_img.style.width = "200px";
	productImage_img.style.height = "200px";
	productDivSecondRow_innerDiv1.append(productImage_img);
	var productDivSecondRow_innerDiv2 = document.createElement("div");
	productDivSecondRow_innerDiv2.className = "col-md-4";
	productDivSecondRow_innerDiv2.append(document.createElement("br"));
	productDivSecondRow_innerDiv2.append(document.createElement("br"));


	var addToCart_button = document.createElement("button");
	addToCart_button.id = product.id;
	addToCart_button.value = product.price;
	addToCart_button.onclick = function(e){
		var price = parseFloat(this.value);
		// from shoppingCart.js included in header.php
		add_to_shoppingCart("api/accesories/read_single_accesory.php", this.id, price); 
		
	};
	addToCart_button.className = "btn";
	addToCart_button.style.marginTop = "15px";
	addToCart_button.style.fontSize = "14px";
	addToCart_button.style.width = productImage_img.style.width;
	addToCart_button.style.backgroundColor = " #0C2A46";
	addToCart_button.style.color = "white";
	addToCart_button.innerHTML = "Add ( " + product.price + "&euro; ) to Cart";
	var thirdRow = document.createElement("div");
	thirdRow.className = "row";
	var thirdRow_col = document.createElement("div");
	thirdRow_col.className = "col-md-6 third-row";
	thirdRow_col.append(addToCart_button);
	thirdRow.append(thirdRow_col);


	productDivSecondRow.append(productDivSecondRow_innerDiv1);
	productDivSecondRow.append(productDivSecondRow_innerDiv2);


	productParentDiv.append(productDivSecondRow);
	productParentDiv.append(thirdRow);
	td.append(productParentDiv);


	return td;
}

function control_price_checkboxes(){
	$( ".checkbox_price" ).click(function() {
	    $( ".checkbox_price" ).prop('checked', false);
	    $(this).prop('checked', true);
    });
}



