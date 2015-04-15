<?php
	session_start();
	if(!isset($_SESSION["username"]))
	{
	    header("location:adminlogin.php");
	    exit();
	}

	include_once("classes/Boeking.class.php");

	$b = new Boeking();
	$allStudents = $b->getAllBoekingen();
	$allBoekings = $b->getAllBoekingen();
?>
<html>
<head>
	<title>Boekingen</title>
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
				<h2>Lijst van ingeplande studenten</h2>
				<?php

					while($student = $allStudents->fetch(PDO::FETCH_ASSOC))
					{
						echo "Voornaam: " . $student["voornaam"] . "<br />";
						echo "Naam: " . $student["naam"] . "<br />";
						echo "<br />";
					}
				?>
			</div>
			<div class="col-md-5">	
			</div>
		</div>
	
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-5">
				<h2>Lijst van boekingen</h2>
				<?php

					while($boeking = $allBoekings->fetch(PDO::FETCH_ASSOC))
					{
						echo "Voornaam: " . $boeking["voornaam"] . "<br />";
						echo "Naam: " . $boeking["naam"] . "<br />";
						echo "Datum: " . $boeking["dag"] . " " . $boeking["maand"] . " " . $boeking['jaar'] . "<br />";
						echo "<br />";
					}
				?>
			</div>
			<div class="col-md-5">	
			</div>
		</div>

	</div>
</body>
</html>