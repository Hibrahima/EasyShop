$(document).ready(function(){

	getAllCategories();

	var add_product_form = $("#add_product_form");

	add_product_form.submit(function(e){
		e.preventDefault();
		addProduct();
	});

	
});

function addProduct(){

	var prices = []; 
	prices.push(parseInt($("#50gr").val())); 
	prices.push(parseInt($("#100gr").val())); 
	prices.push(parseInt($("#150gr").val()));

	//console.log("-------------price 50 gr "+price50_gr);

	var product = {
		name: $("#name").val(),
		image_url: $("#image_url").val(),
		stock: $("#stock").val(),
		type: $("#type").val(),
		category_id: $("#category").val(),
		prices : prices
	};
	$.ajax({
		url: "../../api/products/create.php",
		type: "POST",
		data: {product: JSON.stringify(product)},
		success: function(result){
			console.log("result "+result);
			$.notify("Product successfully created.", "success");
		},
		error: function(e){
			console.log("Error occured while adding product");
		}
	})
}

function getAllCategories(){

	var category_select = $("#category");

	$.ajax({
		url: "../../api/categories/read.php",
		type: "GET",
		dataType: "json",
		success: function(categories){
			for(i=0; i<categories.length; i++){
				category_select.append($("<option></option>").attr("value",categories[i].id).text(categories[i].name)); 
			}
		},
		error: function(e){
			console.log("Error occured while getting all categories "+e);
			$.notify("Error occured while getting categories", "error");
		}
	})
}


