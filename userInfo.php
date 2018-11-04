<!DOCTYPE html>
<html>
<head>
  <title>USERINFO</title>
  <meta charset="utf-8">
  <!--<link rel="stylesheet" href="src/bootstrap.3.3.7.css">
  <script src="src/jquery.3.2.1.js"></script>
  <script src="src/bootstrap.3.3.7.js"></script>-->
  
  <!-- Latest compiled and minified CSS -->

<script src="src/bootstrap/jquery.3.2.1.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<link rel="stylesheet" href ="css/header.css"/>
<link rel="stylesheet" href ="src/style/styleUser/styleInfo.css"/>

  <!-- ICON -->
  <link rel="shortcut icon" href="images/LogoPagCrave.png">
</head>
<body >


<?php include "header.php" ;  ?>


<!--  CHANGING ZONE -->
<div id="content" class="btn">
	<!--SEARCH ZONE -->
	<div id="menu">
		<a href="api"><img src="images/Logo.png" alt="logo" width="250px" height="170px" style="margin-top: 50px"></a>
		<div style=" border-color: rgb(0,0,0)">
			<!-- La imagen como boton de la búsqueda-->

		</div>

    <?php if(isset($_SESSION['SESS_LOGGEDIN']))
       include "user_nav_left.php" ; 
    ?>

	</div>

	<!--CHANGING ZONE // USER ACCOUNT INFORMATION--TO RENDER SINCE -->


	<div id="contenido">
		<h3 id="dynamic_content" style="font-family:'Kavivanar';">USER INFORMATION</h3>
	</div>
	<table id="table"  class="table table-striped table-condensed" >
		<tbody><tr>  
			<th>
				<div id="marginSides">
					<div>
						<h4><u>Name</u></h4>
					</div>
				</th>
				<th id="padding">
					<div>
						<h4 id="user_info_name">Ibrahima</h4>
          </div>
        </th>
      </tr>
      <tr>  
      <th>
        <div id="marginSides">
          <div>
            <h4><u>Surname</u></h4>
          </div>
        </th>
        <th id="padding">
          <div>
            <h4 id="user_info_surname">Superstar</h4>
          </div>
        </th>
      </tr>
      
      <tr>  
      <th>
        <div id="marginSides">
          <div>
            <h4><u>Date of birth</u></h4>
          </div>
        </th>
        <th id="padding">
          <div>
            <h4 id="user_info_birthday">20-4-1997</h4>
          </div>
        </th>
      </tr>
       <tr>  
      <th>
        <div id="marginSides">
          <div>
            <h4><u>Credit Card</u></h4>
          </div>
        </th>
        <th id="padding">
          <div>
            <h4 id="user_info_card_number">xxxx-xxxx-xxxx</h4>
            <h4 id="user_info_card_expiry_date">Expire Date : </h4>
            <h4 id="user_info_card_cvc">CVC : </h4>
          </div>
        </th>
      </tr>
      <tr>  
      <th>
        <div id="marginSides">
          <div>
            <h4><u>Email</u></h4>
          </div>
        </th>
        <th id="padding">
          <div>
            <h4 id="user_info_email"></h4>
          </div>
        </th>
      </tr>
       <tr>  
      <th>
        <div id="marginSides">
          <div>
            <h4><u>Address</u></h4>
          </div>
        </th>
        <th id="padding">

          <div class="row">
            <h4 id="user_info_country">Home address</h4>
            <h4 id="user_info_city">Region / Country</h4>
            <h4 id="user_info_street_postal_code">Postal Code</h4>
          </div>
        </th>
      </tr>
      </tbody>

  </table>
  </div> 


  
<!-- FOOTER -->
<?php include "footer.php"; ?>

<script type="text/javascript" src="js/userInfo.js"></script>
<script type="text/javascript">
  $(document).ready(function(){

    var isUserLoggedIn = "<?php echo isset($_SESSION['SESS_LOGGEDIN']); ?>";
    if(isUserLoggedIn){
      var userId = "<?php echo $_SESSION['SESS_USERID']; ?>";
      get_user_info(userId);
    }   
  
});

</script>


</body>
</html>