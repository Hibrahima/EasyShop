<!DOCTYPE html>
<html>
<head>
  <title>INFUSIONS PAGE</title>
  <meta charset="utf-8">
  <!--<link rel="stylesheet" href="src/bootstrap.3.3.7.css">
  <script src="src/jquery.3.2.1.js"></script>
  <script src="src/bootstrap.3.3.7.js"></script>
  <link rel="stylesheet" href ="src/styleInfusions.css"/>-->
  
  <!-- Latest compiled and minified CSS -->

<script src="src/bootstrap/jquery.3.2.1.js"></script> 
<!--<script src="js/jquery.js" type="text/javascript"></script> 
    <script src="js/spy.js" type="text/javascript"></script> -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<link rel="stylesheet" href ="css/header.css"/>
<link rel="stylesheet" href ="src/style/styleInfusions.css"/>
  <!-- ICON -->
  <link rel="shortcut icon" href="images/LogoPagCrave.png">
</head>

<body >


<?php include "header.php" ;  ?>

   <!--  CHANGING ZONE -->
  <div id="content" class="btn">
    
   <!-- SEARCH ZONE  -->




 
  <div id="menu">
    <a href="api"><img src="images/Logo.png" alt="logo" width="190px" height="150px" style="margin-top: 50px"></a>

    <?php include "nav_left_online_users.php"; ?>
  </div>
 
 <!-- INFUSIONS INFORMATION AND SELECTION -->
  <div id="contenido">
    <h3 id="dynamic_content" style="font-family:'Kavivanar';">~INFUSIONS~</h3>
  </div>
   <table id="table" class="table table-striped table-condensed"></table>
    
    
  </div>  


<!-- FOOTER -->
<?php include "footer.php"; ?>

<script type="text/javascript" src="js/infusion.js"></script>



</body>
</html>