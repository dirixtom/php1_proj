<?php  
	include_once("classes/Datum.class.php");
	include_once("classes/Student.class.php");
	include_once("classes/Boeking.class.php");
	
	$b = new Boeking();
	$singleBoeking = $b->getSingleBoeking();
	$geboekt = false;

	if($_POST) {
		try {	
			$geboekt = true;
		}
		catch(Exception $e) {
			$error = $e->getMessage();
		}
	}

	if(!empty($_POST["FormDel"])) {
		try {	
			$b->Id = $_POST['boekingID'];
			$b->deleteBoeking();
			$succes = "Uw Afspraak is verwijderd!";
		}
		catch(Exception $e) {
			$error = $e->getMessage();
		}
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Welkom <?php echo $_SESSION["fb_user_details"]["name"];?></title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">	

  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>

<body>
	<div class="navbar navbar-default">
   		<div class="navbar-header">
    		<a class="navbar-nav" href="index.php"><img class="logo" src="images/logo2.png" alt="The Rent A Student Logo" width="55%"></a>
       	</div>
      	<ul class="nav navbar-nav">
          	<li><a href="homepage.php">Home</a></li>
          	<li><a href="mijBoekingen.php">Mijn boekingen</a></li>
          	<li><a href="logout.php">Uitloggen</a></li>
       	</ul>
   	</div>
	<div class="container-fluid">
		<div class="row intro2">
			<div class="col-md-12">
				<?php 
					$buddy = $singleBoeking->fetch(PDO::FETCH_ASSOC);
					$datum = $singleBoeking->fetch(PDO::FETCH_ASSOC);
					$boeking = $singleBoeking->fetch(PDO::FETCH_ASSOC);
					if($geboekt == true): ?>
						<div class="row afspraak">
							<div class="col-md-1"></div>
							<div class="col-md-11">
								<h3>Jouw Afspraak</h3>
								<p>Je hebt een afspraak met: <?php echo $buddy['buddieVoornaam'] . " " . $buddy['buddieNaam']; ?></p>
								<p>op: <?php echo $datum['datumDag'] . "-" . $datum['datumMaand'] . "-" . $datum['datumJaar'] ;?></p>
							</div>
						</div>
						<div class="row annuleerafspraak">
							<div class="col-md-1"></div>
							<div class="col-md-11">
								<form action="" method="post">
									<input type="hidden" name="boekingID" value=" <?php  $boeking['boekingID'] ?>">
									<button name="FormDel" type="submit">Annuleer Afspraak</button>
								</form>
							</div>
						</div>
				<?php endif; ?>	
			</div>
		</div>
	</div>
</body>
</html>
		