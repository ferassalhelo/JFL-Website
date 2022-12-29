<?php  
 //login_success.php  
 session_start();  
 if(isset($_SESSION["username"]))  
 {  
	include "public/templates/header.php"; ?>

	<section class="quote-section create-record">
		<div class="auto-container">
			<h2><strong>Welcome Admin,</strong></h2>
			<p><span class="theme-clr">You can access whole system from here; Create, Find, Update or Delete shipment information.</span></p>
			<a href="logout.php" class="theme-btn btn-style-one">Logout</a>
		</div>
		<hr></hr>
	</section>
	
	<section class="fullwidth-section">
		<div class="outer-container">
			<div class="clearfix">
				
				<!-- Left Column -->
				<div class="left-column">
					<div class="inner-column">
						<h3>Place New Order</h3>
						<div class="text">Click below to place new order here, This must only be used by System Administrator</div>
						<a href="create.php" class="theme-btn btn-style-one">Add New Shipment</a>
					</div>
				</div>
				
				<!-- Right Column -->
				<div class="right-column" style="background-image:url(../../images/background/6.jpg)">
					<div class="inner-column">
						<h3>Update Any Order</h3>
						<div class="text">Click below to update any order placed before. This must only be used by System Administrator</div>
						<a href="update.php" class="theme-btn btn-style-two">Update Order</a>
					</div>
				</div>
				
			</div>
		</div>
	</section>

<?php include "public/templates/footer.php";
 }  
 else  
 {  
      header("location:pdo_login.php");  
 }  
 ?>  