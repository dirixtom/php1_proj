<?php 
	
	include_once("classes/Admin.class.php");
	
	$l = new Admin();

	if(!empty($_POST))
	{
		try 
		{	
			
			$l->Username = $_POST['username'];
			$l->Password = $_POST['password'];

			//$l1->Save();
			$l->login();

			//$succes = "Thank you for registering!";


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
<title>Admin login</title>
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
				<input class="submit" type="submit" value="Login" />
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

	</div>
</body>
</html>
