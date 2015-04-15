<?php
	session_start();
	if(!isset($_SESSION["username"]))
	{
	    header("location:adminlogin.php");
	    exit();
	}
	
	include_once("classes/Datum.class.php");

	$d = new Datum();
	$b = new Datum();
	$allDate = $d->ShowDate();

	if(!empty($_POST['FormCreate']))
	{
		try 
		{	
			
			$d->Dag = $_POST['dag'];
			$d->Maand = $_POST['maand'];
			$d->Jaar = $_POST['jaar'];
			$d->SaveDate();

			$succes = "Datum is toegevoegd!";

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
			
			$b->Id = $_POST['dateID'];
			$b->DeleteDate();

			$succes = "Datum is verwijderd!";

		}
		catch(Exception $e)
		{
			$error = $e->getMessage();
		}
	}
?>
<html>
<head>
	<title>Datums van boekingen toevoegen</title>
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
				<h2>Datums voor boekingen toevoegen</h2>
			</div>
			<div class="col-md-5">	
			</div>
		</div>

	<form method="post" action="">
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-1">
				<label for="dag">Dag</label><br />
			</div>
			<div class="col-md-10">	
				<select name="dag">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
					<option value="25">25</option>
					<option value="26">26</option>
					<option value="27">27</option>
					<option value="28">28</option>
					<option value="29">29</option>
					<option value="30">30</option>
					<option value="31">31</option>
				</select>
			</div>
		</div>

		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-1">
				<label for="maand">Maand</label><br />
			</div>
			<div class="col-md-10">	
				<select name="maand">
					<option value="Januari">Januari</option>
		  			<option value="Februari">Februari</option>
		  			<option value="Maart">Maart</option>
		  			<option value="April">April</option>
		  			<option value="Mei">Mei</option>
		  			<option value="Juni">Juni</option>
		  			<option value="Juli">Juli</option>
		  			<option value="Augustus">Augustus</option>
		  			<option value="September">September</option>
		  			<option value="Oktober">Oktober</option>
		  			<option value="November">November</option>
		  			<option value="December">December</option>
				</select>
			</div>
		</div>

		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-1">
				<label for="jaar">Jaar</label><br />
			</div>
			<div class="col-md-10">	
				<select name="jaar" id="jaar">
		  			<option value="2015">2015</option>
		  			<option value="2016">2016</option>
		  			<option value="2017">2017</option>
				</select>
			</div>
		</div>

		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-4">
				<input class="submit" type="submit" id="btnSubmit" value="toevoegen" name='FormCreate' />
			</div>
			<div class="col-md-7">	
				
			</div>
		</div>
	</form>

		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-5">
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

		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-5">
				<h2>Lijst van datums</h2>
				<?php

					while($date = $allDate->fetch(PDO::FETCH_ASSOC))
					{
						echo "<form method='post'>";
						echo "Vrije datums: " . $date["dag"] . " " . $date["maand"] . " " . $date["jaar"] . 
							"<br /><input type='hidden' name='dateID' value='".$date['id']."'>
							<input type='submit' class='submit' name='FormDel' value='Delete date?'><br /><br />";
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