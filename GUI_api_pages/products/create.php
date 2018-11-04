<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
</head>
<body>


	<form class="form-horizontal" method="post" action="../../api/products/create.php" id="add_product_form">
		<fieldset>

			<!-- Form Name -->
			<legend>Create Product</legend>

			<!-- Text input-->
			<div class="form-group">
				<label class="col-md-4 control-label" for="name">Name</label>  
				<div class="col-md-6">
					<input id="name" name="name" type="text" placeholder="product name" class="form-control input-md" required="">

				</div>
			</div>

			<!-- Text input-->
			<div class="form-group">
				<label class="col-md-4 control-label" for="image_url">Image url</label>  
				<div class="col-md-6">
					<input id="image_url" name="image_url" type="text" placeholder="image url" class="form-control input-md" required="">

				</div>
			</div>

			<!-- Select Basic -->
			<div class="form-group">
				<label class="col-md-4 control-label" for="category">Category</label>
				<div class="col-md-6">
					<select id="category" name="category" class="form-control">
					</select>
				</div>
			</div>

			<!-- Text input-->
			<div class="form-group">
				<label class="col-md-4 control-label" for="textinput">Type</label>  
				<div class="col-md-6">
					<select id="type" name="type" class="form-control">
						<option value="tea">Tea</option>
						<option value="infusion">Infusion</option>
					</select>
				</div>
			</div>

			<!-- Text input-->
			<div class="form-group">
				<label class="col-md-4 control-label" for="textinput">Stock Quantity</label>  
				<div class="col-md-6">
					<input id="stock" name="stock" type="number" placeholder="product stock quantity" class="form-control input-md" required="">

				</div>
			</div>

			<!-- Text input-->
			<div class="row">
					<label class="control-label" for="50gr" style="margin-left: 30px; margin-top: 10px; margin-right: 8px; margin-bottom: 10px;">50 Gr</label>  
					<div class="col-md-2">
						<input id="50gr" name="50gr" type="number" placeholder="Enter price for 50 gr" class="form-control input-md" required="">

					</div>
			</div>


			<!-- Text input-->
			<div class="row">
				<label class="control-label" for="50gr" style="margin-left: 30px; margin-top: 10px; margin-bottom: 10px;">100 Gr</label>  
				<div class="col-md-2">
					<input id="100gr" name="50gr" type="number" placeholder="Enter price for 100 gr" class="form-control input-md" required="">

				</div>
			</div>

			<!-- Text input-->
			<div class="row">
				<label class="control-label" for="50gr" style="margin-left: 30px; margin-top: 10px; margin-bottom: 10px;">150 Gr</label>  
				<div class="col-md-2">
					<input id="150gr" name="50gr" type="number" placeholder="Enter price for 150 gr" class="form-control input-md" required="">

				</div>
			</div>




		</fieldset>

		<button id="add_product" name="add_product" class="btn btn-default">Add Product</button>
	</form>

	<script src="../../js/jquery.3.3.1.js"></script>
	<script src="../../js/bootstrap.js"></script> 
	<script type="text/javascript" src="../../js/product.js"></script>


</body>
</html>