<?php

session_start();  
if(isset($_SESSION["username"])){
/**
 * List all shipments with a link to edit
 */

require "config.php";
require "common.php";

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
				<h3>All <span>Shipments</span></h3>
				<div class="separater"></div>
			</div>
		</div>
	</div>

	<div class ="auto-container">
		<div class ="row clearfix">
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
						<th>Edit</th>
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
						<td><a href="update-single.php?id=<?php echo escape($row["id"]); ?>">Edit</a></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
	<br></br>
	<div class ="row clearfix"><div class ="auto-container"><a class ="back-to-home" href="login_success.php">Back To Home</a></div></div>

<?php include "public/templates/footer.php";
 }  
 else  
 {  
      header("location:pdo_login.php");  
 }  
 ?> 