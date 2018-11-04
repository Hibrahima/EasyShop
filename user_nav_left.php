<?php $logout = "/Project/api/users/logout.php"; ?>
<div id="navBarLeft">
	<h5>My details</h5>
	<div id="sidebar-nav">
		<ul class="sidebar-nav">
			<li>
				<a href="userInfo.php"> <span class="glyphicon glyphicon-user"></span>Account Information</a> 
			</li>
			<li>
				<a href="userMyOrders.php" > <span class="glyphicon glyphicon-book"></span> My Orders</a> 
			</li>
			<li>
				<a href="<?php echo $logout; ?>"> <span class="glyphicon glyphicon-log-out"></span> Log out</a>
			</li>
		</ul>
	</div>
</div>

<?php include "nav_left_online_users.php"; ?>