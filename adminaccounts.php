<?php
	session_start();
	if(!isset($_SESSION["username"]))
	{
	    header("location:adminlogin.php");
	    exit();
	}
	
	include_once("classes/Admin.class.php");

	$a = new Admin();
	$b = new Admin();
	$allAcc = $b->ShowAccounts();

	if(!empty($_POST["FormCreate"]))
	{
		try 
		{	

			$a->Username = $_POST['username'];
			$a->Password = $_POST['password'];
			$a->CreateAccount();

			$succes = "Account is toegevoegd!";

		}
		catch(Exception $e)
		{
			$error = $e->getMessage();
		}
	}

	if(!empty($_POST["FormDel"]))
	{
		try 
		{	
			
			$b->Id = $_POST['adminID'];
			$b->DeleteAccount();

			$succes = "Account is verwijderd!";

		}
		catch(Exception $e)
		{
			$error = $e->getMessage();
		}
	}
?>
<html>
<head>
	<title>Accounts beheren</title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="container-fluid">
		
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-2">
				<a href="adminbeheer.php">Back</a>
			</div>
			<div class="col-md-7">	
			</div>
			<div class="col-md-1">
				<a href="logout.php">Uitloggen?</a>
			</div>
		</div>

		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-5">
				<h2>Admin accounts toevoegen</h2>
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

	<form method="post" action="">
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-1">
				<label for="username">Username</label><br/>
			</div>
			<div class="col-md-10">	
				<input type="text" id="username" name="username" placeholder="username" />
			</div>
		</div>

		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-1">
				<label for="password">Password</label><br />
			</div>
			<div class="col-md-10">	
				<input type="password" id="password" name="password" placeholder="password" />
			</div>
		</div>

		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-2">
				<input class="submit" type="submit" value="toevoegen" name='FormCreate'/>
			</div>
			<div class="col-md-9">	
			</div>
		</div>	
	</form>

		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-5">
				<h2>Lijst van geregistreerde accounts</h2>
				<?php
					while($acc = $allAcc->fetch(PDO::FETCH_ASSOC))
					{
						echo "<form method='post'>";
						echo "Username: " . $acc["username"] . "<br /><input type='hidden' name='adminID' value='".$acc['id']."'><input type='submit' class='submit' name='FormDel' value='Delete account?'><br /><br />";
						echo "<br />";
						echo "</form>";
					}
				?>
			</div>
			<div class="col-md-8">
			</div>
		</div>

	</div>
</body>
</html>