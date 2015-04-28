<?php 
	
	include_once("classes/Admin.class.php");
	include_once("classes/Student.class.php");
	
	$a = new Admin();
	$s = new Student();

	if(!empty($_POST['AdminLogin']))
	{
		try 
		{	
			
			$a->Email = $_POST['email'];
			$a->Password = $_POST['password'];

			$a->Login();

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
			
			$s->Email = $_POST['email'];
			$s->Password = $_POST['password'];

			$s->login();

		}
		catch(Exception $e)
		{
			$errorstudent = $e->getMessage();
		}
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
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
          	<li><a href="login.php">Inloggen</a></li>
          	<li><a href="register.php">Registreren</a></li>
       	</ul>
   	</div>

<div class="container-fluid">

   	<div class="row text-center intro">
   		<div class="col-md-6">
   			<form method="post" class="formulier">
			<div class="row">
				<div class="col-md-12">
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
				<div class="col-md-3">
					<label for="email">Email:</label>	
				</div>
				<div class="col-md-9">
					<input type="text" id="email" name="email" placeholder="email" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-3">
					<label for="password">Password:</label>
				</div>
				<div class="col-md-9">
					<input type="password" id="password" name="password" placeholder="password" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<input class="submit" type="submit" value="Login" name="StudentLogin" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-5">
				<br/><p>Nog geen account? <a href="register.php">Registreer hier</a></p>
				</div>
				
		</div>

			</form>
       	</div>
       	
       	<!-- 2de formulier begint hier -->
       	
       	<div class="col-md-6">
		    <form method="post" class="formulier">
			
			<div class="row">
				<div class="col-md-12">
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
				<div class="col-md-3">
					<label for="email">Email:</label>
				</div>
				<div class="col-md-9">
					<input type="text" id="email" name="email" placeholder="email" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-3">
					<label for="password">Password:</label>
				</div>
				<div class="col-md-9">
					<input type="password" id="password" name="password" placeholder="password" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<input class="submit" type="submit" value="Login" name="AdminLogin" />
				</div>
			</div>

			</form> 

		</div>
   	</div>

</div>
</body>
</html>
