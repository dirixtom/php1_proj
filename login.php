<?php 
	
	include_once("classes/Admin.class.php");
	include_once("classes/Student.class.php");
	
	$a = new Admin();
	$s = new Student();

	if(!empty($_POST['AdminLogin']))
	{
		try 
		{	
			
			$a->Username = $_POST['username'];
			$a->Password = $_POST['password'];

			$a->login();

		}
		catch(Exception $e)
		{
			$error = $e->getMessage();
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
			$error = $e->getMessage();
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
	<div class="container-fluid">
		
		<form method="post" class="formulier">
		
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-2">
				<legend>Admin login</legend>
			</div>
			<div class="col-md-9">	
			</div>
		</div>

		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-1">
				<label for="username">Username:</label>	
			</div>
			<div class="col-md-10">
				<input type="text" id="username" name="username" placeholder="username" />
			</div>
		</div>

		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-1">
				<label for="password">Password:</label>
			</div>
			<div class="col-md-10">
				<input type="password" id="password" name="password" placeholder="password" />
			</div>
		</div>

		<div class="row">
			<div class="col-md-1">	
			</div>
			<div class="col-md-2">
				<input class="submit" type="submit" value="Login" name="AdminLogin" />
			</div>
			<div class="col-md-9">
			</div>
		</div>

		</form>  	

		<div class="row">
			<div class="col-md-1">	
			</div>
			<div class="col-md-2">
				<?php if(isset($error)): ?>
					<div class="error">
				<?php echo $error;?>
					</div>
				<?php endif; ?>

				<?php if(isset($succes)): ?>
					<div class="feedback">
				<?php echo $succes;?>
					</div>
				<?php endif; ?>
			</div>
			<div class="col-md-9">
			</div>
		</div>

		<!-- 2de formulier begint hier -->

		<form method="post" class="formulier">
		
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-2">
				<legend>Student login</legend>
			</div>
			<div class="col-md-9">	
			</div>
		</div>

		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-1">
				<label for="email">Email:</label>	
			</div>
			<div class="col-md-10">
				<input type="text" id="email" name="email" placeholder="email" />
			</div>
		</div>

		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-1">
				<label for="password">Password:</label>
			</div>
			<div class="col-md-10">
				<input type="password" id="password" name="password" placeholder="password" />
			</div>
		</div>

		<div class="row">
			<div class="col-md-1">	
			</div>
			<div class="col-md-2">
				<input class="submit" type="submit" value="Login" name="StudentLogin" />
			</div>
			<div class="col-md-9">
			</div>
		</div>

		</form>  	

		<div class="row">
			<div class="col-md-1">	
			</div>
			<div class="col-md-5">
				<br/><p>Nog geen account? <a href="studentregister.php">Registreer hier</a></p>
			</div>
			<div class="col-md-6">
			</div>
		</div>

		<div class="row">
			<div class="col-md-1">	
			</div>
			<div class="col-md-2">
				<?php if(isset($error)): ?>
					<div class="error">
				<?php echo $error;?>
					</div>
				<?php endif; ?>

				<?php if(isset($succes)): ?>
					<div class="feedback">
				<?php echo $succes;?>
					</div>
				<?php endif; ?>
			</div>
			<div class="col-md-9">
			</div>
		</div>

	</div>
</body>
</html>
