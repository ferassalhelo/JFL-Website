<?php
 session_start();  
 if(isset($_SESSION["username"])){  

/**
 * Use an HTML form to edit an entry in the
 * users table.
 *
 */

require "config.php";
require "common.php";

if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $user =[
      "id"        => $_POST['id'],
      "sendername" => $_POST['sendername'],
      "recievername"  => $_POST['recievername'],
      "destination"     => $_POST['destination'],
      "expecteddate"       => $_POST['expecteddate'],
      "location"  => $_POST['location'],
      "date"      => $_POST['date']
    ];

    $sql = "UPDATE users 
            SET id = :id, 
              sendername = :sendername, 
              recievername = :recievername, 
              destination = :destination, 
              expecteddate = :expecteddate, 
              location = :location, 
              date = :date 
            WHERE id = :id";
  
  $statement = $connection->prepare($sql);
  $statement->execute($user);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
  
if (isset($_GET['id'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $id = $_GET['id'];

    $sql = "SELECT * FROM users WHERE id = :id";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();
    
    $user = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php require "public/templates/header.php"; ?>

	<section class="quote-section create-record message">
		<div class="auto-container">
			<?php if (isset($_POST['submit']) && $statement) : ?>
				<blockquote><?php echo escape($_POST['sendername']); ?>'s Package/Shipment successfully updated.</blockquote>
			<?php endif; ?>
		</div>
	</section>

	<div class ="auto-container">
		<div class ="row clearfix">
			<div class="sec-title">
				<h3>Edit <span>Shipment</span> Details</h3>
				<div class="separater"></div>
			</div>
		</div>
	</div>

	<div class ="auto-container">
		<div class ="row clearfix">
			<form method="post" class ="update-single-form">
				<input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
				<?php foreach ($user as $key => $value) : ?>
					<label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
					<input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
				<?php endforeach; ?> 
				<input type="submit" name="submit" value="Submit" class ="back-to-home">
			</form>
		</div>
	</div>

	<br></br>
	<div class ="row clearfix"><div class ="auto-container"><a class ="back-to-home" href="login_success.php">Back To Home</a></div></div>

<?php require "public/templates/footer.php"; 

}  
 else  
 {  
      header("location:pdo_login.php");  
 }
