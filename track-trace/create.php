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
    
    $new_user = array(
      "sendername" => $_POST['sendername'],
      "recievername"  => $_POST['recievername'],
      "destination"     => $_POST['destination'],
      "expecteddate"       => $_POST['expecteddate'],
      "location"  => $_POST['location']
    );

    $sql = sprintf(
      "INSERT INTO %s (%s) values (%s)",
      "users",
      implode(", ", array_keys($new_user)),
      ":" . implode(", :", array_keys($new_user))
    );
    
    $statement = $connection->prepare($sql);
    $success = $statement->execute($new_user);

	$tracking_id = 'No Tracking ID';
	
	if($success){
	
		$stmt = $connection->query("SELECT id FROM users where sendername = '".$_POST['sendername']."'");
		while ($row = $stmt->fetch()) {
			$tracking_id = $row['id']; /* If record added successfully, then return the tracking id */
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
			<blockquote><?php echo escape($_POST['sendername']); ?>'s package successfully added in the record for shipment.</blockquote>
			<h2><strong>Tracking Number Assigned:</strong> <span class="theme-clr"><?php echo escape($tracking_id); ?></span></h2>
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
						<label for="sendername">Package Sender Name</label>
						<input type="text" name="sendername" id="sendername" placeholder ="Package Sender Name">
					</div>
					<div class="form-group col-lg-4 col-md-6 col-sm-12">
						<label for="recievername">Package Reciver Name</label>
						<input type="text" name="recievername" id="recievername" placeholder ="Package Reciver Name">
					</div>
					<div class="form-group col-lg-4 col-md-6 col-sm-12">
						<label for="destination">Package Destination</label>
						<input type="text" name="destination" id="destination" placeholder ="Package Destination">
					</div>		
					<div class="form-group col-lg-4 col-md-6 col-sm-12">
						<label for="expecteddate">Expected Date of Package Arrival</label>
						<input type="text" name="expecteddate" id="expecteddate" placeholder ="Expected Date of Package Arrival">
					</div>	
					<div class="form-group col-lg-4 col-md-6 col-sm-12">
						<label for="location">Current Package Location</label>
						<input type="text" name="location" id="location" placeholder ="Current Package Location">
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