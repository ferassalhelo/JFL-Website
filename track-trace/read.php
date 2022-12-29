<?php

 //login_success.php  
 session_start();  
 if(isset($_SESSION["username"])){  
      //echo '<h3>Login Success, Welcome - '.$_SESSION["username"].'</h3>';  
      //echo '<br /><br /><a href="logout.php">Logout</a>';  

/**
 * Function to query information based on 
 * a parameter: in this case, tracking Number => ID.
 *
 */

require "config.php";
require "common.php";

if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  try  {
    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT * 
            FROM users
            WHERE id = :id";

    $location = $_POST['id'];
    $statement = $connection->prepare($sql);
    $statement->bindParam(':id', $location, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "public/templates/header.php"; ?>
        
<?php  
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    
	
	<div class ="auto-container">
		<div class ="row clearfix">
			<div class="sec-title">
				<h3>Tracking <span>Result</span></h3>
				<div class="separater"></div>
			</div>
		</div>
	</div>

    <div class ="auto-container">
		<div class ="row clearfix" style="overflow-x:auto;">
			<table class="table table-striped">
			  <thead>
				<tr>
				  <th>Tracking #</th>
				  <th>Sender Name</th>
				  <th>Receiver Name</th>
				  <th>Destination</th>
				  <th>Expected Arrival Date</th>
				  <th>Shipment Location</th>
				  <th>Order Confirmation Date</th>
				</tr>
			  </thead>
			  <tbody>
			  <?php foreach ($result as $row) : ?>
				<tr>
				  <td><?php echo escape($row["id"]); ?></td>
				  <td><?php echo escape($row["sendername"]); ?></td>
				  <td><?php echo escape($row["recievername"]); ?></td>
				  <td><?php echo escape($row["destination"]); ?></td>
				  <td><?php echo escape($row["expecteddate"]); ?></td>
				  <td><?php echo escape($row["location"]); ?></td>
				  <td><?php echo escape($row["date"]); ?> </td>
				</tr>
			  <?php endforeach; ?>
			  </tbody>
			</table>
		</div>
	</div>
	<hr></hr>
    <?php } else { ?>
      <blockquote>No results found for <?php echo escape($_POST['id']); ?>.</blockquote>
    <?php } 
} ?> 

<!-- Place HTML HERE --->


	<div class ="auto-container">
		<div class ="row clearfix">
			<div class="sec-title">
				<h3>Track <span>Your</span> Shipment</h3>
				<div class="separater"></div>
				<p>Track your shipment order from here, add your tracking ID in the form and click submit.</p>
			</div>
		</div>
	</div>
	
	<section class="counter-section" style="background-image:url(images/background/3.jpg)">
		<div class="auto-container">
			<div class="row clearfix">
				
				<!-- Order Column -->
				<div class="order-column col-lg-6 col-md-12 col-sm-12">
					<div class="inner-column" style="background-image:url(images/background/4.png)">
						<div class="icon-box">
							<span class="icon flaticon-fast-delivery"></span>
						</div>
						<h2>Track Your Order</h2>
						<div class="text">Enter your Track Id For Instant Search</div>
						
						<!--Track Form-->
						<div class="track-form readit">
							<form method="post">
								<div class="form-group">
								  <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
								  <input type="text" id="id" name="id" placeholder="Tracking ID" required="">
								  <input type="submit" name="submit" value="View Results">
								</div>
							</form>
                        </div>
						
						<!-- Social Box -->
						<div class="social-box">
							<a href="#" class="fa fa-twitter"></a>
							<a href="#" class="fa fa-facebook"></a>
							<a href="#" class="fa fa-linkedin"></a>
							<a href="#" class="fa fa-google-plus"></a>
						</div>
						
					</div>
				</div>
				
				<!-- Counter Column -->
				<div class="counter-column col-lg-6 col-md-12 col-sm-12">
					<div class="inner-column">
						
						<div class="fact-counter">
							<div class="clearfix">
								<!--Column-->
								<div class="column counter-column col-lg-6 col-md-6 col-sm-12">
									<div class="inner">
										<div class="content">
											<div class="count-outer count-box counted">
												<span class="count-text" data-speed="2000" data-stop="61">61</span>
											</div>
											<h4 class="counter-title">Years of Experience</h4>
										</div>
									</div>
								</div>

								<!--Column-->
								<div class="column counter-column col-lg-6 col-md-6 col-sm-12">
									<div class="inner">
										<div class="content">
											<div class="count-outer count-box alternate counted">
												<span class="count-text" data-speed="2800" data-stop="2500">2500</span>+
											</div>
											<h4 class="counter-title">Professional Workers</h4>
										</div>
									</div>
								</div>

								<!--Column-->
								<div class="column counter-column col-lg-6 col-md-6 col-sm-12">
									<div class="inner">
										<div class="content">
											<div class="count-outer count-box counted">
												<span class="count-text" data-speed="2500" data-stop="79">79</span>%
											</div>
											<h4 class="counter-title">Areas Covered</h4>
										</div>
									</div>
								</div>
								
								<!--Column-->
								<div class="column counter-column col-lg-6 col-md-6 col-sm-12">
									<div class="inner">
										<div class="content">
											<div class="count-outer count-box counted">
												<span class="count-text" data-speed="2000" data-stop="207">207</span>+
											</div>
											<h4 class="counter-title">Countries Covered</h4>
										</div>
									</div>
								</div>
								
								<!--Column-->
								<div class="column counter-column col-lg-6 col-md-6 col-sm-12">
									<div class="inner">
										<div class="content">
											<div class="count-outer count-box counted">
												<span class="count-text" data-speed="2000" data-stop="186">186</span>+
											</div>
											<h4 class="counter-title">Corporate Clients</h4>
										</div>
									</div>
								</div>
								
								<!--Column-->
								<div class="column counter-column col-lg-6 col-md-6 col-sm-12">
									<div class="inner">
										<div class="content">
											<div class="count-outer count-box counted">
												<span class="count-text" data-speed="2000" data-stop="450">450</span>+
											</div>
											<h4 class="counter-title">Owned Vehicles</h4>
										</div>
									</div>
								</div>
								
							</div>
						</div>

						
					</div>
				</div>
				
			</div>
		</div>
	</section>
	<br></br>
	<div class ="row clearfix"><div class ="auto-container"><a class ="back-to-home" href="login_success.php">Back To Home</a></div></div>

<?php require "public/templates/footer.php"; 

}  
 else  
 {  
      header("location:pdo_login.php");  
 }