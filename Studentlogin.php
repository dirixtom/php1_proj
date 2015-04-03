<?php 
	
	include_once("classes/Login.class.php");

	$l = new Login();

	if(!empty($_POST))
	{
		try 
		{	
			
			$l->Email = $_POST['email'];
			$l->Password = $_POST['password'];

			$l->StudentLogin();

		}
		catch(Exception $e)
		{
			$error = $e->getMessage();
		}
	}
	
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin login</title>
</head>
<body>
<div>
	<h1>Student login</h1>
	
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

	<form method="post" action="">
		<label for="email">Email</label>
		<input class="enlarge" type="text" id="email" name="email" />
			
		<label for="password">Password</label>
		<input class="enlarge" type="password" id="password" name="password" />
		
		<input class="submit" type="submit" id="btnSubmit" value="Login" />
	</form>

</div>
</body>
</html>