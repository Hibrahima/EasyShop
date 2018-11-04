$(document).ready(function(){

  validateData();

	var registrationForm = $("#signup_form");
	registrationForm.submit(function(e){
		e.preventDefault();
	})

  var loginForm = $("#signin_form");
  loginForm.submit(function(e){
    e.preventDefault();
    var hashedPassword = hashPassword($("#login_password").val());
    var user_credentials = {
      email: $("#login_email").val(),
      password: hashedPassword
    }
    login(JSON.stringify(user_credentials));
  })

	
});


function registerUser(){
	

	var userPassword = $("#user_password").val();
	var hashedPassword = hashPassword(userPassword);
	var user = {
		firstName: $("#user_first_name").val(),
		surname: $("#user_surname").val(),
		password: hashedPassword,
    passwordConfirm: $("#user_confirm_password").val(),
		email: $("#user_email").val(),
		street: $("#user_street").val(),
		postalCode: $("#user_postal_code").val(),
		city: $("#user_city").val(),
		country: $("#user_country").val(),
		bankAccount: $("#user_bank_account").val(),
		cvc: $("#user_cvc").val(),
		birthday: $("#user_birthday").val(),
		creditCardExpiryDate: $("#user_credit_card_expiry_date").val()
	};

	doAjax(JSON.stringify(user));

}

function hashPassword(password){
	var hashedPassword  = CryptoJS.SHA256(password);
	return String(hashedPassword);
}

function validateData(){

	$("#signup_form").validate({
    debug: true,
    rules: {
      "user[name]": "required",
      "user[lastName]": "required",
      "user_password": "required",
      "user_password2": {
      	required: true,
      	equalTo: "#user_password"
      },
      "user[email]" : {
        required: true,
        email: true
      },
      "user[street]": "required",
      "user[postalCode]": "required",
      "user[city]" : "required",
      "user[country]": "required",
      "user[bankaccount]":{
      	required:  true,
      	minlength: 25
      },
      CVC: {
      	required: true,
      	digits: true,
      	minlength: 3,
      	maxlength: 3

      },
      dateofbirth: {
        required: true,
        minlength: 10
      },
      expiry_date: {
        required: true,
        minlength: 10
      }
    },
    // Specify validation error messages
    messages: {
      "user[name]": "Please, enter your firstname",
      "user[lastName]": "Please, enter your lastname",
      "user_password": "Please, enter  your password",
      "user_password2": {
      	required: "Please, confirm your password",
      	equalTo: "Passwors don't match. Please, try again"
      },
       "user[email]":{
       	required: "Please, enter your email address",
       	email: "Please, enter a valie email address"
       },
       "user[street]": "Please, enter the name of the street you live in",
       "user[postalCode]": "Please, enter your postal code",
      "user[city]" : "Please, enter the name of the city you live in",
      "user[country]": "Please, enter the name of the country you live in",
      "user[bankaccount]":{
      	required:  "Please, enter your bank account",
      	minlength: "Please, enter a valid bank account (min length 25)"
      },
      CVC: {
      	required: "Please, enter the CVC of your credit card",
      	digits: "Please, enter a valid CVC (only numbers are allowed",
      	minlength: "Please, enter a valid CVC (min length 3)",
      	maxlemgth: "Please, enter a valid CVC (max length 3)"

      },
      dateofbirth: {
        required: "Please, indicate your birthday",
        minlength: "Please, enter a valid date (min length 10)"
      },
      expiry_date: {
        required: "Please, indicate the expiry date of your credit card",
        minlength: "Please, enter a valid date (min length 10)"
      }
    },
    // Make sure the form is submitted to the destination defined
    submitHandler: function(form) {
        //form.submit(); 
        registerUser();
    }
  });
	
}



function doAjax(user){

	$.ajax({
		url: "api/users/create.php",
		type: "POST",
		data: {user: user},
    dataType: "json",
		success: function(result){
			console.log("User successfully added "+result);
      if(result.status == "success"){
        $.notify(result.message, "success");
        $("#signup_form")[0].reset();
      }
      else
         $.notify(result.message, "info");
		},
		error: function(e){
			console.log("Error while adding user "+e);
      $.notify("Oups! Something went wrong.", "error");
		}
	})
}

function login(user_credentials){
  $.ajax({
    url: "api/users/login.php",
    type: "POST",
    data: {user_credentials: user_credentials},
    dataType: "json",
    success: function(result){
      console.log("User login result "+result.status);
      if(result.status == true)
        window.location.href = "http://localhost/Project/teas.php";
      else
        $.notify("Login Error - Wrong password or email!", "info");
    },
    error: function(e){
      console.log("Error while trying to log into the system "+JSON.stringify(e));
      $.notify("Oups! Something went wrong.", "error");
    }

  })
}