<?php

session_start();  
if(isset($_SESSION["username"])){
/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */

require "config.php";
require "common.php";

if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  try  {
    $connection = new PDO($dsn, $username, $password, $options);
    
    $new_customer = array(
      "customer_tcode"  => $_POST['customer_tcode'],
      "cust_password"     => $_POST['cust_password'],
      "contact_number"       => $_POST['contact_number']
    );

    $sql = sprintf(
      "INSERT INTO %s (%s) values (%s)",
      "customers",
      implode(", ", array_keys($new_customer)),
      ":" . implode(", :", array_keys($new_customer))
    );
    
    $statement = $connection->prepare($sql);
    $success = $statement->execute($new_customer);

	$customer_id = 'No Customer ID';
	$customer_tracking_code = 'No Code Assigned';
	
	if($success){
	
		$stmt = $connection->query("SELECT cust_id, customer_tcode FROM customers where customer_tcode = '".$_POST['customer_tcode']."'");
		while ($row = $stmt->fetch()) {
			$customer_id = $row['cust_id']; /* If record added successfully, then return the tracking id */
			$customer_tracking_code = $row['customer_tcode'];
		}
	}
	
	
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "public/templates/header.php"; ?>


	<section class="quote-section create-record message">
		<div class="auto-container">
			<?php if (isset($_POST['submit']) && $statement) : ?>
			<blockquote><?php echo escape($_POST['customer_tcode']); ?> successfully added in the record of customers.</blockquote>
			<h2><strong>Customer Tracking Code/Username Assigned:</strong> <span class="theme-clr"><?php echo escape($customer_tracking_code); ?></span></h2>
			<?php endif; ?>
		</div>
		<hr></hr>
	</section>
	  


	<!-- Add Record Section -->
	<section class="quote-section create-record">
		<div class="auto-container">
			<div class="sec-title-two sec-title">
				<h2>Add <span>Shipment</span> Details</h2>
				<div class="separater"></div>
			</div>
			<div class="quote-form-box">
			  <form method="post">
				<div class ="row clearfix">
					<input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
					<div class="form-group col-lg-4 col-md-6 col-sm-12">
						<label for="customer_tcode">Customer Tracking Code</label>
						<input type="text" name="customer_tcode" id="customer_tcode" placeholder ="Customer Tracking Code">
					</div>
					<div class="form-group col-lg-4 col-md-6 col-sm-12">
						<label for="cust_password">Customer Password</label>
						<input type="text" name="cust_password" id="cust_password" placeholder ="Customer Passowrd">
					</div>
					<div class="form-group col-lg-4 col-md-6 col-sm-12">
						<label for="contact_number">Customer Contact Number</label>
						<input type="text" name="contact_number" id="contact_number" placeholder ="Customer Contact Number">
					</div>		
					
					<div class="form-group col-lg-4 col-md-6 col-sm-12">
						<input class="theme-btn btn-style-one" type="submit" name="submit" value="Submit">
					</div>
				</div>
			  </form>
			</div>
		</div>
		<hr></hr>
	</section>
	

	<div class ="row clearfix"><div class ="auto-container"><a class ="back-to-home" href="login_success.php">Back To Home</a></div></div>

<?php include "public/templates/footer.php";
 }  
 else  
 {  
      header("location:pdo_login.php");  
 }  
 ?>  