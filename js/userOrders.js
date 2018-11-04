var userOrders;
function getUserOrders(userId){
	userId = userId;
	$.ajax({
		url: "api/orders/user_orders.php/?id="+userId,
		type: "GET",
		dataType: "json",
		success: function(orders){
			userOrders = orders;
			appendOrders(orders);
		},
		error: function(e){
			console.log("Error while geting user's orders "+e);
			$.notify("Error while geting user's orders", "error");
		}
	})
}


function appendOrders(orders){
	var parentTable = document.getElementById("table");
	parentTable.innerHTML ="";
	for(i=0; i<orders.length; i++){
		var currentOrderItem = orders[i];
		var tr = document.createElement("tr");
		var th = document.createElement("th");

		var th_div_row = document.createElement("div");
		th_div_row.className = "row";
		var th_div_img_div = document.createElement("div");
		th_div_img_div.className = "col-xs-3";
		var th_div_img_div_img = document.createElement("img");
		th_div_img_div_img.className = "img-responsive";
		th_div_img_div_img.src = currentOrderItem.prod_image_url;
		th_div_img_div_img.style.width = "120px";
		th_div_img_div.append(th_div_img_div_img);
		th_div_row.append(th_div_img_div);

		var th_div_prod_name = document.createElement("div");
		th_div_prod_name.className = "col-xs-6";
		var th_div_prod_name_h4_1 = document.createElement("h4");
		th_div_prod_name_h4_1.className = "product-name";
		var th_div_prod_name_h4_1_strong = document.createElement("strong");
		th_div_prod_name_h4_1_strong.innerHTML = currentOrderItem.prod_name;
		th_div_prod_name_h4_1.append(th_div_prod_name_h4_1_strong);
		var th_div_prod_name_h4_2 = document.createElement("h4");
		th_div_prod_name_h4_2_small = document.createElement("small");
		var delivery_cost = parseFloat(currentOrderItem.delivery_cost);
		th_div_prod_name_h4_2_small.innerHTML = "Delivery Type : "+currentOrderItem.delivery_type +" <br/> <br/>Delivery cost : " + delivery_cost+ " &euro;";
		th_div_prod_name_h4_2.append(th_div_prod_name_h4_2_small);
		th_div_prod_name.append(th_div_prod_name_h4_1);
		th_div_prod_name.append(th_div_prod_name_h4_2);
		th_div_row.append(th_div_prod_name);

		var th_div_quantity_and_price = document.createElement("div");
		th_div_quantity_and_price.className = "col-xs-3";
		var th_div_quantity_and_price_right = document.createElement('div');
		th_div_quantity_and_price_right.className = "col-xs-6 text-right";
		var th_div_quantity_and_price_h6 = document.createElement("h6");
		var th_div_quantity_and_price_h6_strong = document.createElement("strong");
		var ProductTotalPrice = currentOrderItem.quantity * currentOrderItem.unit_price;
		ProductTotalPrice = parseFloat(ProductTotalPrice).toFixed(2);
		th_div_quantity_and_price_h6_strong.innerHTML = currentOrderItem.quantity +" X " + currentOrderItem.unit_price + " = " + ProductTotalPrice + " &euro;";
		th_div_quantity_and_price_h6.append(th_div_quantity_and_price_h6_strong);
		th_div_quantity_and_price_right.append(th_div_quantity_and_price_h6);
		th_div_quantity_and_price.append(th_div_quantity_and_price_right);
		th_div_row.append(th_div_quantity_and_price);

		var th_div_row_2 = document.createElement("div");
		th_div_row_2.className = "row";
		var th_div_row_2_order_again_button_div = document.createElement("div");
		th_div_row_2_order_again_button_div.className = "col-xs-3";
		var th_div_row_2_order_again_button = document.createElement("button");
		th_div_row_2_order_again_button.id = currentOrderItem.prod_id;
		th_div_row_2_order_again_button.value = currentOrderItem.prod_type+" "+currentOrderItem.unit_price;
		th_div_row_2_order_again_button.className = "btn btn-danger orderBasket";
		th_div_row_2_order_again_button.onclick = function(e){
			var api_url;
			var valueArray = this.value.split(" ");
			var producyType = valueArray[0];
			var productPrice = valueArray[1];
			switch(producyType){
				case "accesory":
					api_url = "api/accesories/read_single_accesory.php";
					break;
				default:
					api_url = "api/products/read_single_product.php";
					break;
			}

			add_to_shoppingCart(api_url, this.id, productPrice); 

		}; 


		th_div_row_2_order_again_button.innerHTML = "Order again";
		th_div_row_2_order_again_button.style.fontSize = "10px";
		th_div_row_2_order_again_button_div.append(th_div_row_2_order_again_button);
		th_div_row_2.append(th_div_row_2_order_again_button_div);

		var th_div_row_2_delivery_div = document.createElement("div");
		th_div_row_2_delivery_div.className = "col-xs-6";
		var th_div_row_2_delivery_div_h4_1 = document.createElement("h4");
		var th_div_row_2_delivery_div_h4_1_strong = document.createElement("strong");
		th_div_row_2_delivery_div_h4_1_strong.innerHTML = "Delivery Address";
		th_div_row_2_delivery_div_h4_1.append(th_div_row_2_delivery_div_h4_1_strong);
		var th_div_row_2_delivery_div_h4_2 = document.createElement("h4");
		th_div_row_2_delivery_div_h4_2_small = document.createElement("small");
		th_div_row_2_delivery_div_h4_2_small.innerHTML = currentOrderItem.postal_code + " - " + currentOrderItem.city + " ( " + currentOrderItem.country + " )";
		th_div_row_2_delivery_div_h4_2.append(th_div_row_2_delivery_div_h4_2_small);
		th_div_row_2_delivery_div.append(th_div_row_2_delivery_div_h4_1);
		th_div_row_2_delivery_div.append(th_div_row_2_delivery_div_h4_2);
		th_div_row_2.append(th_div_row_2_delivery_div);

		var th_div_order_date_total_and_status_div = document.createElement("div");
		th_div_order_date_total_and_status_div.className = "col-xs-3";
		var th_div_order_date_total_and_status_div_right = document.createElement("div");
		th_div_order_date_total_and_status_div_right.className = "col-xs-3 text-right";

		var th_div_order_date_total_and_status_div_right_h6_1 = document.createElement("h6");
		var th_div_order_date_total_and_status_div_right_h6_1_strong = document.createElement("strong");
		th_div_order_date_total_and_status_div_right_h6_1_strong.style.marginLeft = "-70px";
		th_div_order_date_total_and_status_div_right_h6_1_strong.innerHTML = "DATE : "+currentOrderItem.order_date;
		th_div_order_date_total_and_status_div_right_h6_1.append(th_div_order_date_total_and_status_div_right_h6_1_strong);
		
		var th_div_order_date_total_and_status_div_right_h6_2 = document.createElement("h6");
		var th_div_order_date_total_and_status_div_right_h6_2_strong = document.createElement("strong");
		th_div_order_date_total_and_status_div_right_h6_2_strong.style.marginLeft = "-70px";
		th_div_order_date_total_and_status_div_right_h6_2_strong.innerHTML = "Product Total : "+ ProductTotalPrice + " &euro;";

		var th_div_order_date_total_and_status_div_right_h6_3 = document.createElement("h6");
		var th_div_order_date_total_and_status_div_right_h6_3_strong = document.createElement("strong");
		th_div_order_date_total_and_status_div_right_h6_3_strong.style.marginLeft = "-70px";
		th_div_order_date_total_and_status_div_right_h6_3_strong.innerHTML = "Order Total : " + currentOrderItem.total + " &euro;";
		th_div_order_date_total_and_status_div_right_h6_3.append(th_div_order_date_total_and_status_div_right_h6_3_strong);


		
		th_div_order_date_total_and_status_div_right_h6_2.append(th_div_order_date_total_and_status_div_right_h6_2_strong);
		th_div_order_date_total_and_status_div_right.append(th_div_order_date_total_and_status_div_right_h6_1);
		th_div_order_date_total_and_status_div_right.append(th_div_order_date_total_and_status_div_right_h6_2);
		th_div_order_date_total_and_status_div_right.append(th_div_order_date_total_and_status_div_right_h6_3);
		th_div_order_date_total_and_status_div.append(th_div_order_date_total_and_status_div_right);
		th_div_row_2.append(th_div_order_date_total_and_status_div);

		th.append(th_div_row); th.append(th_div_row_2); th.append(document.createElement("hr"));
		th.className = "th_"+currentOrderItem.prod_type+" product_th";
		tr.append(th);
		parentTable.append(tr);

	}

}

function filterOrdersByDate(){
	var date = $("#filter_order_date").val();
	var reversedDate = reverseDate(date);
	var mathedOrders = [];
	var table = $("#table");
	if(date != null && date != "" && date != undefined){
		for(i=0; i<userOrders.length; i++){
			var currentOrderItem = userOrders[i];
			if(currentOrderItem.order_date == reversedDate){
				mathedOrders.push(currentOrderItem);
			}
		}

		table.html("");
		appendOrders(mathedOrders);
	}
	else
		$.notify("Invalid date!", "error");
	
}

function reverseDate(date){
	//2018-05-31
	var day = date.substring(8, date.length);
	var month = date.substring(5, 7);
	var year = date.substring(0, 4);
	reversedDate = day+"-"+month+"-"+year;
	return reversedDate;
}

function filterOrdersByType(){
	var $tabs = $(".tab__item");
	$tabs.click(function(e){
		$(".product_th").hide();
		var $that = $(this);
		var filter = $that.attr("data-filter");
		if(filter == "all"){
			$(".product_th").show();
		}
		$tabs.attr("data-state", "none");
		$that.attr("data-state", "selected");
		$(".th_"+filter).show();
	})
}



