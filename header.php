
<?php 
session_start();
if(isset($_SESSION["SESS_CHANGEID"])){
  session_unset();
  session_regenerate_id();
}
?>
<script type="text/javascript" src="js/shoppingCart.js"></script>
<header>

  <nav class="btn navbar navbar-default" role="navigation" id="navigator" >
    <div class="collapse navbar-collapse" id="navbar-collapse" >
      <ul class="nav navbar-nav">

        <li>
          <img src="images/LogoPagCrave.png" alt="logo" width="200px" height="130px" id="logo">
          <a id="textNav" href="#">WHAT DO YOU  <br> CRAVE TODAY?</a>
        </li>
        <li><a id="textNav" href="teas.php">Tea</a></li>
        <li ><a id="textNav" href="infusions.php">Infusions</a></li>
        <li ><a id="textNav" href="accesories.php">Accesories</a></li>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php 
        if(isset($_SESSION["SESS_LOGGEDIN"])){
          ?>
          <li >
            <!--<button id="shopButton"  class="btn btn-default"  href="userInfo.html" ><span class="glyphicon glyphicon-user"></span>USER ACCOUNT</p> </button>-->
            <a href="userInfo.php" class="btn btn-default" role="button" id="userButton"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['SESS_USERNAME']; ?></a>
          </li>
        <?php } 
          else{ ?>
             <li >
            <!--<button id="shopButton"  class="btn btn-default"  href="userInfo.html" ><span class="glyphicon glyphicon-user"></span>USER ACCOUNT</p> </button>-->
            <a href="presentation.php" class="btn btn-default" role="button" id="loginButton"><span class="glyphicon glyphicon-log-in"></span> Login</a>
          </li>
         <?php }?>

        <li>
          <button id="shopButton" type="button" class="btn btn-default" data-toggle="modal" data-target="#dialogBasket"><span class="nav__cart-count" style="display: none;"></span><span class="glyphicon glyphicon-shopping-cart"></span>SHOPPING BASKET </button>
        </li>


        <!-- START DIALOG -->

        <!-- Modal -->
        <div class="modal fade" id="dialogBasket" role="dialog">
          <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Shopping cart</h4>
              </div>
              <div class="modal-body">
                <div class="container">
                  <div class="row">
                    <div class="col-md-8">
                      <div class="panel panel-info">
                        <div class="panel-heading">
                          <div class="panel-title">
                            <div class="row">

                              <div class="col-md-6">
<!--<button type="button" class="btn btn-success btn-sm btn-block" style="margin-left: 200px;">Continu shopping
</button>-->
<a   href="teas.php" class="btn btn-success btn-sm btn-block" role="button" style=" margin-left: 50%;
border-radius: 30px;">Continue shopping</a>
</div>
</div>
</div>
</div>
<!-- START PANEL- BODY -->
<div class="panel-body" id="shopping_modal_body">
 
<div id="shopping_modal_body_content_top"></div>
  <!--END OF THE PRODUCT SHIPPING -->
  <hr>
  <div class="row" style="height: auto;">
    <div class="text-center">
      <div class="col-md-9">
        <p class="text-right" style="padding-top: 30%; font-size: 20px"><b>Purchase finished?</b></p>
      </div>


      <div class="col-md-3" style="height: auto;">
        <div>
          <p style="margin-left:-200%;"><b> Total (without shipping): <span id="total_without_shipping"></span></b></p>
          <p style="margin-left:-150%;" id="delivery_type_p">
          </p>

          <p style="margin-left:-200%;"><b>Total (with shipping): <span id="total_with_shipping"></span></b></p>
        </div>

        <button type="button" id="pay_now_button" class="btn btn-warning" style="width:70px; position: relative; margin-top:60px;">Pay</button>

      </div>
    </div>
  </div>
  <!-- END PANEL BODY -->
</div>
</div>
</div>
</div>

</div>

</div>
</div>
<!-- END DIALOG -->
</li>
</ul>
</div>

</nav>
</header> 

<?php include "delivery_address_popup.php"; ?>

<script type="text/javascript" src="js/header.js"></script>
<script type="text/javascript" src="js/notify.js"></script>
<script type="text/javascript" src="js/jquery.mask.js"></script>
<script type="text/javascript">

  $(document).ready(function(){

    if(get_cookie("shopping_cart")){
      var products_from_cookie = JSON.parse(get_cookie("shopping_cart"));
      if(products_from_cookie.length > 0){
        $(".nav__cart-count").html(products_from_cookie.length);
        $(".nav__cart-count").show();
        design_shopping_cart(products_from_cookie);
      }
    }
    
     setInterval(getOnlineUsers, 3000);

     $("#pay_now_button").click(function(e){
        order_now();
     });

  
});

  
</script>
