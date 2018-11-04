$(document).ready(function(){

	get_infusions();
	
	
});



function get_infusions(){
	$.ajax({
		url: "api/products/read_infusions.php",
		type: "GET",
		dataType: "json",
		success: function(infusions){
			show_infusions(infusions); control_price_checkboxes();
		},
		error: function(e){
			console.log("Error occured while getting all infusions "+e);
			$.notify("Error occured while getting infusions", "error");
		}
	})
}

function show_infusions(infusions){

	var table = document.getElementById("table");
	var cpt = 0;

	for(i=0; i<infusions.length; i++){
		if(cpt == infusions.length) break;
		//Get first product of each row
		var previousProduct = infusions[2*i];
		cpt++;
		var tr = document.createElement("tr");
		var td1 = build(previousProduct); tr.append(td1);
	
		if(2*i+1 <infusions.length){
			//Get second product of each row
			var nextProduct = infusions[2*i+1];
			cpt++; 
			var td2 = build(nextProduct);
			tr.append(td2);
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
	var p1 = document.createElement("p");
	var label1 = document.createElement("label");
	var checkboxPrice50_gr = document.createElement("input");
	checkboxPrice50_gr.id = "checkbox_price_50_gr_"+product.id;
	checkboxPrice50_gr.type = "checkbox";
	checkboxPrice50_gr.value = product.price50_gr;
	checkboxPrice50_gr.className = "checkbox_price";
	label1.innerHTML = "50 Gr";
	label1.append(checkboxPrice50_gr);
	var spanPrice50_gr = document.createElement("span");
	spanPrice50_gr.innerHTML = product.price50_gr+"&euro;";
	spanPrice50_gr.style.display = "inline-block";
	spanPrice50_gr.style.marginLeft = "8px";
	label1.append(spanPrice50_gr);
	p1.append(label1);

	var p2 = document.createElement("p");
	var label2 = document.createElement("label");
	var checkboxPrice100_gr = document.createElement("input");
	checkboxPrice100_gr.id = "checkbox_price_100_gr_"+product.id;
	checkboxPrice100_gr.type = "checkbox";
	checkboxPrice100_gr.value = product.price100_gr;
	checkboxPrice100_gr.className = "checkbox_price";
	label2.innerHTML = "100 Gr";
	label2.append(checkboxPrice100_gr);
	var spanPrice100_gr = document.createElement("span");
	spanPrice100_gr.innerHTML = product.price100_gr+"&euro;";
	spanPrice100_gr.style.display = "inline-block";
	spanPrice100_gr.style.marginLeft = "8px";
	label2.append(spanPrice100_gr);
	p2.append(label2);

	var p3 = document.createElement("p");
	var label3 = document.createElement("label");
	var checkboxPrice150_gr = document.createElement("input");
	checkboxPrice150_gr.id = "checkbox_price_150_gr_"+product.id;
	checkboxPrice150_gr.type = "checkbox";
	checkboxPrice150_gr.value = product.price150_gr;
	checkboxPrice150_gr.className = "checkbox_price";
	label3.innerHTML = "150 Gr";
	label3.append(checkboxPrice150_gr);
	var spanPrice150_gr = document.createElement("span");
	spanPrice150_gr.innerHTML = product.price150_gr+"&euro;";
	spanPrice150_gr.style.display = "inline-block";
	spanPrice150_gr.style.marginLeft = "8px";
	label3.append(spanPrice150_gr);
	p3.append(label3);

	var addToCart_button = document.createElement("button");
	addToCart_button.id = product.id;
	addToCart_button.onclick = function(e){
		var is_checkbox_clicked = is_price_checkbox_ok(this.id);
		if(is_checkbox_clicked){
			var variationPrice = get_clicked_checkbox_price(this.id);
			// from shoppingCart.js included in header.php
			add_to_shoppingCart("api/products/read_single_product.php", this.id, variationPrice); 
		}
		else
			$.notify("No price selected! Please select a price.", "warn");
		
	};
	addToCart_button.className = "btn";
	addToCart_button.style.backgroundColor = " #0C2A46";
	addToCart_button.style.color = "white";
	addToCart_button.innerHTML = "Add to Cart";
	productDivSecondRow_innerDiv2.append(p1);
	productDivSecondRow_innerDiv2.append(p2);
	productDivSecondRow_innerDiv2.append(p3);
	productDivSecondRow_innerDiv2.append(addToCart_button);


	productDivSecondRow.append(productDivSecondRow_innerDiv1);
	productDivSecondRow.append(productDivSecondRow_innerDiv2);


	productParentDiv.append(productDivSecondRow);

	td.append(productParentDiv);

	//td.append(productParentDiv);


	return td;
}

function control_price_checkboxes(){
	$( ".checkbox_price" ).click(function() {
	    $( ".checkbox_price" ).prop('checked', false);
	    $(this).prop('checked', true);
    });
}

function is_price_checkbox_ok(product_id){
	var price_50_gr_checkbox = document.getElementById("checkbox_price_50_gr_"+product_id);
	var price_100_gr_checkbox = document.getElementById("checkbox_price_100_gr_"+product_id);
	var price_150_gr_checkbox = document.getElementById("checkbox_price_150_gr_"+product_id);

	if(price_50_gr_checkbox.checked || price_100_gr_checkbox.checked || price_150_gr_checkbox.checked)
		return true;
}

function get_clicked_checkbox_price(product_id){
	var price_50_gr_checkbox = document.getElementById("checkbox_price_50_gr_"+product_id);
	var price_100_gr_checkbox = document.getElementById("checkbox_price_100_gr_"+product_id);
	var price_150_gr_checkbox = document.getElementById("checkbox_price_150_gr_"+product_id);

	if(price_50_gr_checkbox.checked)
		return parseFloat(price_50_gr_checkbox.value);
	if(price_100_gr_checkbox.checked)
		return parseFloat(price_100_gr_checkbox.value);
	if(price_150_gr_checkbox.checked)
		return parseFloat(price_150_gr_checkbox.value);

}
