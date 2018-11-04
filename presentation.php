<?php
session_start();
require("api/config/config.php");
if(isset($_SESSION["SESS_LOGGEDIN"])){
echo "basedir ".$config_basedir;
header("Location: ".$config_basedir);
}
?>
<!DOCTYPE html>
<html>
<head>
<title>PRESENTATION</title>
<meta charset="utf-8">
<!--<link rel="stylesheet" href="src/bootstrap.3.3.7.css">
<script src="src/jquery.3.2.1.js"></script>
<script src="src/bootstrap.3.3.7.js"></script>
<link rel="stylesheet" href ="src/style.css"/>

<!-- Latest compiled and minified CSS -->

<script src="src/bootstrap/jquery.3.2.1.js"></script>
<link href='http://fonts.googleapis.com/css?family=Oleo+Script:400,700' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<link rel="stylesheet" href ="src/style/style.css"/>
<!-- ICON -->
<link rel="shortcut icon" href="images/LogoPagCrave.png">
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">


<section id="myCarousel" class="carousel slide carousel-fade">
<!-- Indicators -->
<ol class="carousel-indicators">
<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
<li data-target="#myCarousel" data-slide-to="1"></li>

</ol>


<div class="carousel-inner">
<div class="item active">

<!--  FIRST PAGE -->
<div class="fill" style="background-image:url('https://www.majestymaps.com/wp-content/uploads/2017/06/1847-world-map-majesty-maps.jpg');background-repeat: no-repeat;background-size:2000px" ></div>


<div class="carousel-caption">
  <div class="content wow fadeInRight">
      <img src="images/ImagPresentation.png" style="margin-left: -36px; height: 500px ; width: 800px">
     <p style="color: rgb(0,0,0); text-align: center; font-family: 'Kavivanar';);
        "><b><i>"WELCOME TO TEA CULTURE" </i></b></p><br> 
     <article style="text-align: center; font-size: 20px;font-family: 'Kavivanar'; color:black"><b><i>Fruit of the earth, cultivated with ancestral techniques that have evolved over time. Enjoy it by sharing moments that enrich your soul and spirit.</i></b></article>
          
  </div>
</div>
</div>

<div class="item">

<!-- USER PAGE -->
<div class="fill" style="background-image:url('https://www.majestymaps.com/wp-content/uploads/2017/07/mappe-monde-1720-majesty-maps-map.jpg');opacity: 0.7;" ></div>
<div class="carousel-caption">
  <div class="content wow fadeInRight">

  
<div class="container" style="margin-top: -50px;">
	<div class="col-md-4">
		<h2 id="title" style="font-family:'Kavivanar';">Sign Up</h2>

		<div id="logbox">
			<form id="signup_form" class="signIn">
				
				
				<div class="col-md-6"><input type="text" id="user_first_name" name="user[name]" placeholder="First Name" class="input pass" style="width: 78%; margin-right: 5px;margin-top: 10px;"></div>
				<div class="col-md-6">
				<input type="text" id="user_surname" name="user[lastName]" placeholder="Surame" class="input pass" style="width: 78%; margin-left: 5px; margin-top: 10px;"></div>
				<div class="col-md-6"><input type="password" id="user_password" name="user_password" placeholder="Password" class="input pass" style="width: 78%; margin-right: 5px;"></div>
				<div class="col-md-6">
				<input type="password" id="user_confirm_password" name="user_password2" placeholder="Confirm it" class="input pass" style="width: 78%; margin-left: 5px;"></div>
				<input name="user[email]" type="email" id="user_email" placeholder="Email address" class="input pass"/>
				<input type="text" id="user_street" name="user[street]" class="input pass" placeholder="Street">
				<input type="text" id="user_postal_code" name="user[postalCode]" placeholder="Postal Code" class="input pass">
				<div class="col-md-6"><input type="text" id="user_city" name="user[city]" placeholder="City" class="input pass" style="width: 78%; margin-right: 5px;"></div>
				<div class="col-md-6">
				<input type="text" id="user_country" name="user[country]" placeholder="Country" class="input pass" style="width: 78%; margin-left: 5px;"></div>

				<input type="text" id="user_bank_account" data-mask="0000 - 0000 - 0000 - 0000" name="user[bankaccount]" placeholder="Credit card number" class="input pass">
				<input type="text" data-mask="000" placeholder=" CVC ---" id="user_cvc" name="CVC" placeholder="CVC" class="input pass">

				<p style="color: grey; font-size:14px; padding-left:15%">&#9658;Date of birth: <input type="text" id="user_birthday" data-mask="00/00/0000" class="input pass" name="dateofbirth" placeholder="--/--/----" style="width: 63%; margin-left:2.5px;"></p>
				<p style="color: grey; font-size:14px; padding-left:15%">&#9658;CC Expiring Date: <input type="text" id="user_credit_card_expiry_date" data-mask="00/00/0000" placeholder="--/--/----" class="input pass" name="expiry_date" style="width: 63%; margin-left:2.5px;"></p>


				<input type="submit" value="Sign me up!" class="inputButton"/>
			
			</form>
		</div>
	</div>

<div class="col-md-4">
	<h2 id="title" style="font-family:'Kavivanar';">Log In</h2>

<div id="logbox">
			<!-- ID sign up is for style, don't touch it! class identify it! -->
			<form id="signin_form" class="logIn">
				
				<input id="login_email" name="user[email]" type="email" placeholder="Email address" class="input pass" style="margin-top: 10px;" />
				
				<input id="login_password" name="user[password]" type="password" placeholder="Introduce your password" required="required" class="input pass"/>
				
				<input type="submit" value="Log me up!" class="inputButton"/>
			
			</form>
		</div>

		<a   href="teas.php" id="continue" type="submit" class="inputButton" role="button" style="height: 50px; width: 270px; text-align: center;margin-top: 33%; ">Continue<br>without registering</a>

	</div>
  

</div>


	
  
  </div>              
</div>
</div>
</section>

<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/core.js"></script>
<script type="text/javascript" src="js/enc-base64.js"></script>
<script type="text/javascript" src="js/sha256.js"></script>
<script type="text/javascript" src="js/sha1.js"></script>
<script type="text/javascript" src="js/aes.js"></script>
<script type="text/javascript" src="js/user.js"></script>
<script type="text/javascript" src="js/notify.js"></script>
<script type="text/javascript" src="js/jquery.mask.js"></script>

</body>
</html>
