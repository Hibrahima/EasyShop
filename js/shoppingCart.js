var products = [];
if(get_cookie("shopping_cart")){
	 products = JSON.parse(get_cookie("shopping_cart"));
}else{
	 products = [];
}

//Add chosen product to shopping cart by retrieving product details
//Design the shopping cart at the end of everything went right
function add_to_shoppingCart(url, product_id, variationPrice){
	$.ajax({
		url: url + "/?product_id="+product_id,
		type: "GET",
		dataType: "json",
		success: function(product){
			var bool = false; var products; var index = -1;
			if(get_cookie("shopping_cart")){
				 products = JSON.parse(get_cookie("shopping_cart"));
				 for(i=0; i<products.length; i++){
					if(products[i].variationPrice == variationPrice && product_id == products[i].id){
						bool = true; index = i; break;
					}
				}
			}
			else
				products = [];
			if(!bool){
				product.variationPrice = variationPrice;
				product.quantity_div_input_id = "quantity_"+variationPrice+"_"+product.id;
				products.push(product);
				//Show information ===> product has been added to the shopping cart
				$.notify(products[products.length-1].name+" ( "+variationPrice+" € ) has been added to your cart", "success");
			}
			
			set_cookie("shopping_cart", JSON.stringify(products));

			$(".nav__cart-count").html(products.length);
			$(".nav__cart-count").show();
			design_shopping_cart(products, variationPrice, bool, false, index);

		},
		error: function(e){
			console.log("Error occured while buiilding shopping cart "+e);
			$.notify("Oups! Something went wrong."+products[products.length-1].name+" cannot be added to your cart");
		}
	})
}

//Set cookie with cookie name and cookie value
//Used in most cases for storing shopping cart's products
function set_cookie(cookie_name, cookie_value){
	document.cookie = cookie_name +" = "+cookie_value +'; Path=/;';
}

//Get cookie content by cookie name
function get_cookie(cookie_name){
	var match = document.cookie.match(new RegExp(cookie_name + '=([^;]+)'));
	if (match)
		return match[1];

	return false;
}

//Adding chosen product to shopping cart
function design_shopping_cart(products, variationPrice = 0, bool = false, is_header = true, index){

	
	var shoppingModal = document.getElementById("shopping_modal_body_content_top");

	var cpt; var currentProduct;
	if(!is_header)
		cpt = 1;
	else{
		cpt = products.length;
		document.getElementById("shopping_modal_body_content_top").innerHTML = "";
	}
	for(i=0; i<cpt; i++){
		if(is_header == false)
			 currentProduct = products[products.length-1];
		else
			currentProduct = products[i];

		if(bool){
			//$.notify(currentProduct.name + " is already in your shopping cart.", "info");
			if(index != -1){
				var quantity_el = document.getElementById("quantity_"+variationPrice +"_" + products[index].id);
				var answer = confirm("This product is already in your shopping cart! Increase the quantity?");
				if(answer){
					 quantity_el.value = parseInt(quantity_el.value) + 1;
					 $.notify("The quantity of "+products[index].name+" ( "+products[index].variationPrice+" € ) has been increased. The new quantity is "+quantity_el.value, "success");
				}
			}
				
		}else{
			var row = document.createElement("div");
			row.className = "row";

			var imageDiv = document.createElement("div");
			imageDiv.className = "col-md-2";
			var product_image_img = document.createElement("img");
			product_image_img.className = "img-responsive";
			product_image_img.src = currentProduct.image_url;
			imageDiv.append(product_image_img);
			row.append(imageDiv);


			var product_name_category_div = document.createElement("div");
			product_name_category_div.className = "col-md-4";
			var product_name_h4 = document.createElement("h4");
			product_name_h4.className = "product-name";
			var product_name_strong = document.createElement("strong");
			product_name_strong.innerHTML = currentProduct.name;
			product_name_h4.append(product_name_strong);
			var product_category_h4 = document.createElement("div");
			var product_category_small = document.createElement("small");
			product_category_small.innerHTML = currentProduct.category_name;
			product_category_h4.append(product_category_small);
			product_name_category_div.append(product_name_h4);
			product_name_category_div.append(product_category_h4);
			row.append(product_name_category_div);

			var right_div = document.createElement("div");
			right_div.className = "col-md-6";
			var price_div = document.createElement("div");
			price_div.className = "col-md-5 text-right";
			var price_div_h6 = document.createElement("h6");
			var price_div_h6_strong = document.createElement("strong");
			price_div_h6_strong.innerHTML = currentProduct.variationPrice;
			var price_div_h6_strong_span = document.createElement("span");
			price_div_h6_strong_span.className = "ext-muted";
			price_div_h6_strong_span.innerHTML = " &euro; X ";
			price_div_h6_strong.append(price_div_h6_strong_span);
			price_div_h6.append(price_div_h6_strong);
			price_div.append(price_div_h6);
			right_div.append(price_div);

			var quantity_div = document.createElement("div");
			quantity_div.className = "col-md-3";
			var quantity_div_input = document.createElement("input");
			quantity_div_input.id = currentProduct.quantity_div_input_id;
			quantity_div_input.className = "form-control input-md";
			quantity_div_input.type = "number";
			quantity_div_input.onchange = function(e){
				update_total(false);
				if(is_delivery_checkbox_ok()){
					var deliveryPrice = getOrderDeliveryTypeInfo()[1];
					update_total(true, deliveryPrice);
				}
				else{
					update_total(false);
				}
			};
			if(!bool)
				quantity_div_input.value = 1;

			quantity_div.append(quantity_div_input);
			right_div.append(quantity_div);

			var delete_div = document.createElement("div");
			delete_div.className = "col-md-4";
			var delete_div_a = document.createElement("a");
			delete_div_a.id = currentProduct.id;
			delete_div_a.value = currentProduct.variationPrice;
			delete_div_a.onclick = function(e){
				var answer = confirm("Are you sure you want to remove this item from your shopping cart?");
				if(answer)
					deleteProductFromShoppingCart(parseInt(this.id), parseFloat(this.value));
			}
			var delete_div_a_span = document.createElement("span");
			delete_div_a_span.className = "glyphicon glyphicon-trash";
			delete_div_a_span.style.marginTop = "10px";
			delete_div_a.append(delete_div_a_span);
			delete_div.append(delete_div_a);
			right_div.append(delete_div);
			row.append(right_div);

			shoppingModal.append(row);

		}
	}

	get_delivery_types();
	update_total();

}

//Clearing shopping cart
function clearShoppingCart(){
	var emptyArray = [];
	set_cookie("shopping_cart", JSON.stringify(emptyArray));
	$("#shopping_modal_body_content_top").html("");
	$("#dialogBasket").modal("toggle");
	$("#myModal").modal("hide");
}

//Calculating total of products in the shopping cart
function calculate_total(){
	var products = JSON.parse(get_cookie("shopping_cart"));
	var total = 0;

	for(i=0; i<products.length; i++){
		var currentProduct = products[i];
		var currentProductVariationPrice = currentProduct.variationPrice;
		var currentProductQuantity = document.getElementById(currentProduct.quantity_div_input_id).value;
		total += currentProductVariationPrice * currentProductQuantity;
	}

	return total;
}

//Show total of shopping cart
function change_total_text(is_delivery_specified, delivery_price){
	var total_without_shipping = calculate_total();
	total_without_shipping = parseFloat(total_without_shipping).toFixed(2);
	document.getElementById("total_without_shipping").innerHTML = total_without_shipping + " &euro;";
	if(is_delivery_specified){
		var total_with_shipping = total_without_shipping + delivery_price ;
		document.getElementById("total_with_shipping").innerHTML = total_with_shipping + " &euro;";
	}
	else{
		document.getElementById("total_with_shipping").innerHTML = total_without_shipping + " &euro;";
	}

}

//Updating shopping cart total
function update_total(is_delivery_specified = false, delivery_price = 2){
	change_total_text(is_delivery_specified, delivery_price);
}

//Get and append delivey types (Express and Standard)
function get_delivery_types(){
	$.ajax({
		url: "api/delivery/read.php",
		type: "GET",
		dataType: "json",
		success: function(delivery_types){
			append_delivery_types(delivery_types); control_delivery_checkboxes();
		},
		error: function(e){
			console.log("Error occured while getting all delivery types "+e);
		}
	})
}

//Appending delivery types and updating total
function append_delivery_types(delivery_types){
	
	var deliveryType_p = document.getElementById("delivery_type_p");
	deliveryType_p.innerHTML = "";

	for(i=0; i<delivery_types.length; i++){
		var currentDeliveryType = delivery_types[i];
		var label = document.createElement("label");
		label.style.marginRight = "20px";
		var input = document.createElement("input");
		input.id = currentDeliveryType.id;
		input.className = "delivery_type checkbox";
		input.type = "checkbox";
		input.value = currentDeliveryType.price;
		input.onchange = function(e){
			update_total(true, parseFloat(this.value));
		}
		if(currentDeliveryType.name == "Standard")
			label.innerHTML = currentDeliveryType.name + " " + currentDeliveryType.price +  " &euro;";
		else if(currentDeliveryType.name = "Express")
			label.innerHTML = currentDeliveryType.name +" " +currentDeliveryType.price + " &euro; ";
			label.append(input);  
		
		deliveryType_p.append(label);
	}
}

//Making only one checkbox tickable at a time
function control_delivery_checkboxes(){
	$( ".delivery_type" ).click(function() {
	    $( ".delivery_type" ).prop('checked', false);
	    $(this).prop('checked', true);
    });
}

//Deleting chosen product fro shopping cart and updaying the cookie
function deleteProductFromShoppingCart(id, variationPrice){
	var products = JSON.parse(get_cookie("shopping_cart"));
	var index;
	for(i=0; i<products.length; i++){
		if(products[i].id == id && products[i].variationPrice == variationPrice){
			index = i; break
		}
	}

	$.notify(products[index].name+" ( "+ products[index].variationPrice+" € ) has been successfully deleted.", "success");
	products.splice(index, 1);
	set_cookie("shopping_cart", JSON.stringify(products));
	var updatedProducts = JSON.parse(get_cookie("shopping_cart"));
	design_shopping_cart(updatedProducts);
	if(updatedProducts.length > 0)
		$(".nav__cart-count").html(updatedProducts.length);
	else
		$(".nav__cart-count").hide();

	update_total(false);
}


//---------------------------------Make orders------------------------
function is_delivery_checkbox_ok(){
	var deliveryTypeCheckboxes = $(".delivery_type");
	for(i=0; i<deliveryTypeCheckboxes.length; i++){
		if(deliveryTypeCheckboxes[i].checked)
			return true;
	}
	
	return false;
}

function order_now(){
	var isDeliveryOk = is_delivery_checkbox_ok();
	if(!isDeliveryOk)
		$.notify("No delivery type specified. Please select a delivery type.", "warn");
	else{
		var products = JSON.parse(get_cookie("shopping_cart"));
		if(products.length <=0)
			$.notify("There is no product in your shopping cart.", "info");
		else{
			$("#myModal").modal();
			$("#delivery_address_form").submit(function(e){
				e.preventDefault();
				makeOrders();
			})
		}
	}
}

//Make orders by posting shopping cart details to the server
function makeOrders() {
	var parsedProducts = JSON.parse(get_cookie("shopping_cart"));
	var newProducts = [];
	var deliveryInfo = getOrderDeliveryTypeInfo();
	for(i=0; i<parsedProducts.length; i++){
		var currentProduct = parsedProducts[i];
		var currentProductQuantity = document.getElementById(currentProduct.quantity_div_input_id).value;
		currentProduct.quantity = parseInt(currentProductQuantity);
		newProducts.push(currentProduct);
	}

	makeOrderAjax(newProducts);
			
	
}

function getDeliveryAddressInfo(){

	var delivery_address_info ={
		customer_first_name: $("#delivery_customer_name").val(),
		customer_last_name: $("#delivery_customer_surname").val(),
		customer_email: $("#delivery_email").val(),
		customer_country: $("#delivery_country").val(),
		customer_city: $("#delivery_city").val(),
		customer_postal_code: $("#delivery_postal_code").val(),
		customer_credit_card_number: $("#delivery_credit_card_number").val(),
		customer_cvc: $("#delivery_cvc").val(),
		customer_credit_card_expiry_date: $("#delivery_credit_card_expiry_date").val()
	};

	return delivery_address_info;
}

function makeOrderAjax(products){
	var deliveryInfo = getOrderDeliveryTypeInfo();

	var delivery_address_info = getDeliveryAddressInfo();

	var data = {
		products: products,
		delivery_id: deliveryInfo[0],
		delivery_value: deliveryInfo[1],
		delivery_info: delivery_address_info
	};
	$.ajax({
		url: "api/orders/create.php",
		type: "POST",
		data: {order: JSON.stringify(data)},
		dataType: "json",
		success: function(result){
			console.log("order result " +result);
			if(result.is_ok){
				$(".nav__cart-count").hide();
				clearShoppingCart();
				$.notify(result.is_ok_message, "success");
			}
			else
				$.notify("Oups, something went wrong", "error");
		},
		error: function(e){
			console.log("Erroe while making orders");
			$.notify("Oups! Something went wrong", "error");
		}
	});
}

function getOrderDeliveryTypeInfo(){
	var deliveryPrice = parseFloat(document.querySelector('.delivery_type:checked').value);
	var deliveryId = parseInt(document.querySelector('.delivery_type:checked').id);
	var data = [];
	data.push(deliveryId, deliveryPrice);
	return data;
}