<?php
	session_start();
	if(!isset($_SESSION["username"]))
	{
	    header("location:adminlogin.php");
	    exit();
	}
	
	include_once("classes/Datum.class.php");
	include_once("classes/Admin.class.php");

	$d = new Datum();
	$a = new Admin();
	
	if(!empty($_POST))
	{
		try 
		{			
			$d->Dag = $_POST['dag'];
			$d->Maand = $_POST['maand'];
			$d->Jaar = $_POST['jaar'];
			$d->SaveDate();

			$a->Username = $_POST['username'];
			$a->Password = $_POST['password'];
			$a->CreateAccount();

			$succes = "Datum is toegevoegd!";
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
	<title>Welcome <?php echo $_SESSION["username"];?></title>
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
			<div class="col-md-4">
				<?php
					echo "<h1>Hello " . $_SESSION["username"] . ".</h1><br>";
				?>
			</div>
			<div class="col-md-7">	
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-4">
				<a href="adminboekingen.php">Boekingen bekijken</a><br/>
				<a href="adminaccounts.php">Admin accounts beheren</a><br/>
				<a href="adminDatums.php">Boeking datums toevoegen</a>
			</div>
			<div class="col-md-7">	
			</div>
		</div>

	</div>
</body>
</html>