
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    
      <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delivery Information</h4>
      </div>
      <div class="modal-body">

        <form action="#" method="post" id="delivery_address_form">

          <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-4">
              <label>First Name : </label>
            </div>
            <div class="col-md-8">
              <input type="text" name="delivery_customer_name" id="delivery_customer_name" value="<?php echo $_SESSION['SESS_USER_FIRST_NAME']; ?>" required>
            </div>
          </div>

          <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-4">
              <label>Surname : </label>
            </div>
            <div class="col-md-8">
              <input type="text" name="delivery_customer_surname" required id="delivery_customer_surname"  value="<?php echo $_SESSION['SESS_USER_LAST_NAME']; ?>">
            </div>
          </div>

          <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-4">
              <label>Email : </label>
            </div>
            <div class="col-md-8">
              <input type="email" name="delivery_email" id="delivery_email" value="<?php echo $_SESSION['SESS_USEREMAIL']; ?>" required>
            </div>
          </div>

          <div id="delivery_address_country_row" class="row" style="margin-bottom: 10px;">
            <div class="col-md-4">
              <label>Country : </label>
            </div>
            <div class="col-md-8">
              <input type="text" name="delivery_country" id="delivery_country" value="<?php echo $_SESSION['SESS_USER_COUNTRY']; ?>" required>
            </div>
          </div>

          <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-4">
              <label>City : </label>
            </div>
            <div class="col-md-8">
              <input type="text" name="delivery_city" id="delivery_city" value="<?php echo $_SESSION['SESS_USER_CITY']; ?>" required>
            </div>
          </div>

          <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-4">
              <label>Postal Code : </label>
            </div>
            <div class="col-md-8">
              <input type="text" name="delivery_postal_code" id="delivery_postal_code" value="<?php echo $_SESSION['SESS_USER_POSTAL_CODE']; ?>" required>
            </div>
          </div>

          <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-4">
              <label>Credit Card Number : </label>
            </div>
            <div class="col-md-5">
              <input type="text" minlength="25" data-mask="0000 - 0000 - 0000 - 0000" placeholder="xxxx - xxxx - xxxx - xxxx" name="delivery_credit_card_number" id="delivery_credit_card_number" value="<?php echo $_SESSION['SESS_USER_CREDIT_CARD_NUMBER']; ?>" required>
            </div>
          </div>

          <div class="row" style="margin-bottom: 10px;">
           <div class="col-md-4">
              <label>CVC : </label>
            </div>
            <div class="col-md-8">
              <input type="number" data-mask="000" placeholder="---" name="delivery_cvc" id="delivery_cvc" minlength="3" value="<?php echo $_SESSION['SESS_USER_CVC']; ?>" required>
            </div>
          </div>

          <div class="row" style="margin-bottom: 10px;">
           <div class="col-md-4">
              <label> Expiry Date : </label>
            </div>
            <div class="col-md-8">
              <input type="text" minlength="10" data-mask="00/00/0000" placeholder="--/--/----" name="delivery_credit_card_expiry_date" id="delivery_credit_card_expiry_date" value="<?php echo $_SESSION['SESS_USER_CREDIT_CARD_EXPIRY_DATE']; ?>" required>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Send</button>
        </div>
      </form>
      </div>
      
    </div>
  </div>
  
</div>