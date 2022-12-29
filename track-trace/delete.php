<?php
 session_start();  
 if(isset($_SESSION["username"])){  
/**
 * Delete an order
 */

require "config.php";
require "common.php";

$success = null;

if (isset($_POST["submit"])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  try {
    $connection = new PDO($dsn, $username, $password, $options);
  
    $id = $_POST["submit"];

    $sql = "DELETE FROM users WHERE id = :id";

    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $success = "Package/Shipment successfully deleted";
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

try {
  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM users";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "public/templates/header.php"; ?>
        
	<div class ="auto-container">
		<div class ="row clearfix">
			<div class="sec-title">
				<h3>Delete <span>Order</span></h3>
				<div class="separater"></div>
			</div>
		</div>
	</div>

<?php if ($success) echo $success; ?>

	<div class ="auto-container">
		<div class ="row clearfix">
			<table class="table table-striped">
				<form method="post" class="delete-single-form">
					<input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
						<table class="table table-striped">
							<thead>
							  <tr>
								<th>Tracking #</th>
								<th>Sender Name</th>
								<th>Reciver Name</th>
								<th>Destination</th>
								<th>Expected Arrival Date</th>
								<th>Shipment Location</th>
								<th>Order Confirmation Date</th>
								<th>Delete</th>
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
								<td><button type="submit" name="submit" value="<?php echo escape($row["id"]); ?>">Delete</button></td>
							  </tr>
							<?php endforeach; ?>
							</tbody>
						  </table>
				</form>
			</table>
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