function get_user_info(id){
	$.ajax({
		url: "api/users/read_single_user.php/?id="+id,
		type: "GET",
		dataType: "json",
		success: function(user){
			updateUserInfo(user);
		},
		error: function(e){
			console.log("Error occured while getting user info with id "+id+" " +e);
			$.notify("Error occured while getting user info  with id "+id, "error");
		}
	})
}


function updateUserInfo(user){

	var username_h4 = document.getElementById("user_info_name");
	username_h4.innerHTML = user.first_name;
	var userSurname_h4 = document.getElementById("user_info_surname");
	userSurname_h4.innerHTML = user.last_name;
	var userBirthday_h4 = document.getElementById("user_info_birthday");
	userBirthday_h4.innerHTML = user.birthday;
	var userCardNumber_h4 = document.getElementById("user_info_card_number");
	userCardNumber_h4.innerHTML = user.credit_card_number;
	var userCardExpiryDate_h4 = document.getElementById("user_info_card_expiry_date");
	userCardExpiryDate_h4.innerHTML += user.credit_card_expiry_date;
	var userCardCVC_h4 = document.getElementById("user_info_card_cvc");
	userCardCVC_h4.innerHTML += user.cvc;
	var userEmail_h4 = document.getElementById("user_info_email");
	userEmail_h4.innerHTML = user.email;
	var userCountry_h4 = document.getElementById("user_info_country");
	userCountry_h4.innerHTML = user.country;
	var userCity_h4 = document.getElementById("user_info_city");
	userCity_h4.innerHTML = user.city;
	var userStreetPostalCode_h4 = document.getElementById("user_info_street_postal_code");
	userStreetPostalCode_h4.innerHTML = user.street+" - " + user.postal_code;



}