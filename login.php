<?php 
	
	include_once("classes/Admin.class.php");
	include_once("classes/Student.class.php");
	
	$a = new Admin();
	$s = new Student();

	if(!empty($_POST['AdminLogin']))
	{
		try 
		{	
			$conn = Db::getInstance();
			$statement = $conn->prepare("SELECT * FROM tbladmin WHERE adminEmail=?");
			$statement->execute(array($_POST['email']));
        	$row = $statement->fetch(PDO::FETCH_ASSOC);

        	if (password_verify($_POST['password'], $row['adminPassword']))
        	{
				session_start();
				$_SESSION["email"] = $_POST['email'];
				header("Location: studentDashboard.php");
			}
			elseif (!isset($row['adminPassword']))
	        {
	            throw new Exception('Ongeldig emailadres!');
	        } else {
	            throw new Exception("Ongeldig wachtwoord!");
	        }
		}
		catch(Exception $e)
		{
			$erroradmin = $e->getMessage();
		}
	}

	if(!empty($_POST['StudentLogin']))
	{
		try 
		{	
			$conn = Db::getInstance();
			$statement = $conn->prepare("SELECT * FROM tblbuddies WHERE buddieEmail=?");
			$statement->execute(array($_POST['email']));
        	$row = $statement->fetch(PDO::FETCH_ASSOC);

        	if (password_verify($_POST['password'], $row['buddiePassword']))
        	{
				session_start();
				$_SESSION["buddyemail"] = $_POST['email'];
				header("Location: studentDashboard.php");
			}
			elseif (!isset($row['buddiePassword']))
	        {
	            throw new Exception('Ongeldig emailadres!');
	        } else {
	            throw new Exception("Ongeldig wachtwoord!");
	        }
		}
		catch(Exception $e)
		{
			$errorstudent = $e->getMessage();
		}
	}

?><!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Rent a student - Login</title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	
	<div class="navbar navbar-default">
   		<div class="navbar-header">
    		<a class="navbar-nav" href="#"><img class="logo" src="images/logo2.png" alt="The Rent A Student Logo" width="55%"></a>
       	</div>
      	<ul class="nav navbar-nav">
          	<li><a href="homepage.php">Home</a></li>
       	</ul>
   	</div>

<div class="container-fluid">

   
   	<div class="row intro2">
   		<div class="col-md-6">
   			
   			<form method="post" class="formulier">
			
			<div class="row">
				<div class="col-md-1">	
				</div>
				<div class="col-md-11">
					<legend>Student login</legend>
					<?php if(isset($errorstudent)): ?>
						<div class="error">
					<?php echo $errorstudent;?>
						</div>
					<?php endif; ?>
					<?php if(isset($succes)): ?>
						<div class="feedback">
					<?php echo $succes;?>
						</div>
					<?php endif; ?>
					<br />
				</div>
			</div>

			<div class="row">
				<div class="col-md-1">	
				</div>
				<div class="col-md-2">
					<label for="email">Email:</label>	
				</div>
				<div class="col-md-9">
					<input type="text" id="email" name="email" placeholder="email" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-1">	
				</div>
				<div class="col-md-2">
					<label for="password">Password:</label>
				</div>
				<div class="col-md-9">
					<input type="password" id="password" name="password" placeholder="password" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-3">	
				</div>
				<div class="col-md-9">
					<input class="submit" type="submit" value="Login" name="StudentLogin" />
				</div>
			</div>

			</form>

			<form method="post" class="formulier">
			
			<div class="row">
				<div class="col-md-1">	
				</div>
				<div class="col-md-11">
					<legend>Admin login</legend>
					<?php if(isset($erroradmin)): ?>
						<div class="error"><br/>
					<?php echo $erroradmin;?>
						</div>
					<?php endif; ?>
					<?php if(isset($succes)): ?>
						<div class="feedback">
					<?php echo $succes;?>
						</div>
					<?php endif; ?>
					<br/>
				</div>
			</div>

			<div class="row">
				<div class="col-md-1">	
				</div>
				<div class="col-md-2">
					<label for="email">Email:</label>
				</div>
				<div class="col-md-9">
					<input type="text" id="email" name="email" placeholder="email" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-1">	
				</div>
				<div class="col-md-2">
					<label for="password">Password:</label>
				</div>
				<div class="col-md-9">
					<input type="password" id="password" name="password" placeholder="password" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-3">	
				</div>
				<div class="col-md-9">
					<input class="submit" type="submit" value="Login" name="AdminLogin" />
				</div>
			</div>

			</form> 
       	</div>
	</div>
</body>
</html>
