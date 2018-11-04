<!DOCTYPE html>
<html>
<head>
  <title>USERORDERS</title>
  <meta charset="utf-8">
  <!-- Latest compiled and minified CSS -->

<script src="src/bootstrap/jquery.3.2.1.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<link rel="stylesheet" href ="css/header.css"/>
<link rel="stylesheet" href ="src/style/styleUser/styleMyOrders.css"/>
  <!-- ICON -->
  <!--<link rel="shortcut icon" href="img/icon.png">-->
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
    
    <!-- LATERAL NAVBAR -->

    <?php if(isset($_SESSION['SESS_LOGGEDIN']))
       include "user_nav_left.php" ; 
    ?>

    </div>

    <!-- END LATERAL NAV -->

  <!--CHANGING ZONE-->
    
  <div id="contenido">
    <h3 id="dynamic_content" style=" font-family: 'Open Sans' , sans-serif;">SHIPPING RECORD</h3>

    
     ✺Filter by date: <input type="date" id="filter_order_date" name="q"
        style="margin-top: 20px" value:"Search"><img src="images/search.png" alt="logo" width="25px" height="25px" style="margin-top: 0px" onclick="filterOrdersByDate();"><br>
     
     <div data-state="selected" data-filter="all" class="tab__item" style="margin-left: 100px;">ALL</div>
     <div data-filter="tea" class="tab__item">TEAS</div>
     <div data-filter="infusion" class="tab__item">INFUSIONS</div>
     <div data-filter="accesory" class="tab__item">ACCESORIES</div>
  </div>

   
  <table id="table"  class="table table-striped table-condensed" ></table>
  </div> 


<!-- FOOTER -->
<?php include "footer.php"; ?>


<script type="text/javascript" src="js/userOrders.js"></script>
<script type="text/javascript">
  $(document).ready(function(){

    var isUserLoggedIn = "<?php echo isset($_SESSION['SESS_LOGGEDIN']); ?>";
    if(isUserLoggedIn){
      var userId = "<?php echo $_SESSION['SESS_USERID']; ?>";
      getUserOrders(userId);
    } 

    filterOrdersByType();  
  
});

</script>


</body>
</html>