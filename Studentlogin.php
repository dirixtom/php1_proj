<?php 
	session_start();
	include_once("classes/Student.class.php");
	
	$l = new Student();

	if(!empty($_POST))
	{
		try 
		{	
			
			$l->Email = $_POST['email'];
			$l->Password = $_POST['password'];

			$l->login();

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
<title>Student login</title>
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
			<div class="col-md-3">
				<h1>Student login</h1>
			</div>
			<div class="col-md-8">	
			</div>
		</div>

		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-1">
				<label for="email">email:</label>	
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
				<input class="submit" type="submit" value="Login" />
			</div>
			<div class="col-md-9">
			</div>
		</div>

		</form>  	

		<div class="row">
			<div class="col-md-1">	
			</div>
			<div class="col-md-6">
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
			<div class="col-md-5">
			</div>
		</div>

	</div>
</body>
</html>
