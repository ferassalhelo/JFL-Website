 <?php  
 session_start();  
 $host = "localhost";  
 $username = "root";  	/* Add Database Username Here */
 $password = "";		/* Add Database User Password Here */
 $database = "test";  	/* Add Database Name Here */
 $message = "";  
 try  
 {  
      $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);  
      $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
      if(isset($_POST["login"]))  
      {  
           if(empty($_POST["username"]) || empty($_POST["password"]))  
           {  
                $message = '<label>All fields are required</label>';  
           }  
           else  
           {  
                $query = "SELECT * FROM admins WHERE username = :username AND password = :password";  
                $statement = $connect->prepare($query);  
                $statement->execute(  
                     array(  
                          'username'     =>     $_POST["username"],  
                          'password'     =>     $_POST["password"]  
                     )  
                );  
                $count = $statement->rowCount();  
                if($count > 0)  
                {  
                     $_SESSION["username"] = $_POST["username"];  
                     header("location:login_success.php");  
                }  
                else  
                {  
                     $message = '<label>Wrong Data</label>';  
                }  
           }  
      }  
 }  
 catch(PDOException $error)  
 {  
      $message = $error->getMessage();  
 }  

 require "public/templates/header.php"; ?>

	<div class = "login-form">
	   <div class="container" style="width:500px;">  
			<?php  
			if(isset($message))  
			{  
				 echo '<label class="text-danger">'.$message.'</label>';  
			}  
			?>  
			<h3 align="">Please Login To Verify</h3><br />  
			<form method="post">  
				 <label>Username</label>  
				 <input type="text" name="username" class="form-control" />  
				 <br />  
				 <label>Password</label>  
				 <input type="password" name="password" class="form-control" />  
				 <br />  
				 <input type="submit" name="login" class="btn btn-info" value="Login" />  
			</form> 
			<p><strong>For Demo Purposes:</strong> Username: admin Password: admin</p>
	   </div> 
	</div>
	   
<?php require "public/templates/footer.php"; 