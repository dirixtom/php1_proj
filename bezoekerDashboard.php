<?php
	
	session_start(); //Session should always be active
	
	include_once("classes/Datum.class.php");
	include_once("classes/Student.class.php");
	include_once("classes/Boeking.class.php");
	$d = new Datum();
	$data = $d->ShowDate();
	$s = new Student();
	$allStudents = $s->GetAllStudents();
	$allFB = $s->GetAllFB();
	$b = new Boeking();

	if($_POST)
	{
		try 
		{	
			$b->Datum = $_POST['datum'];
			$b->Buddy = $_POST['buddieID'];
			$b->Student = $_POST['studentID'];
			$b->nieuweBoeking();
			$success = "Uw boeking is gelukt!";
		}
		catch(Exception $e)
		{
			$error = $e->getMessage();
		}
	}

	//FACEBOOK LOGIN - NIET AANKOMEN
	
	//session var is still there
	$app_id				= '1378145582515326';  //localhost
	$app_secret 		= '2819b5faff3c55c4808ed979975eb46d';
	$required_scope 	= 'public_profile, publish_actions'; //Permissions required
	$redirect_url 		= 'http://localhost:8888/PHP1/php1_proj/bezoekerDashboard.php'; //FB redirects to this page with a code
	//MySqli details for saving user details
	$mysql_host			= 'localhost';
	$mysql_username		= 'root';
	$mysql_password		= 'root';
	$mysql_db_name		= 'phpproject';
	require_once __DIR__ . "/facebook-php-sdk-v4-4.0-dev/autoload.php"; //include autoload from SDK folder
	//import required class to the current scope
	use Facebook\FacebookSession;
	use Facebook\FacebookRequest;
	use Facebook\GraphUser;
	use Facebook\FacebookRedirectLoginHelper;
	FacebookSession::setDefaultApplication($app_id , $app_secret);
	$helper = new FacebookRedirectLoginHelper($redirect_url);
	try {
	  $session = $helper->getSessionFromRedirect();
	} catch(FacebookRequestException $ex) {
		die(" Error : " . $ex->getMessage());
	} catch(\Exception $ex) {
		die(" Error : " . $ex->getMessage());
	}
	//if user wants to log out
	if(isset($_GET["log-out"]) && $_GET["log-out"]==1){
		unset($_SESSION["fb_user_details"]);
		//session ver is set, redirect user 
		header("location: ". $redirect_url);
	}
	//Test normal login / logout with session
	if ($session){ //if we have the FB session
		//get user data
		$user_profile = (new FacebookRequest($session, 'GET', '/me'))->execute()->getGraphObject(GraphUser::className());
		
		//save session var as array
		$_SESSION["fb_user_details"] = $user_profile->asArray(); 
		
		$user_id = ( isset( $_SESSION["fb_user_details"]["id"] ) )? $_SESSION["fb_user_details"]["id"] : "";
		$user_name = ( isset( $_SESSION["fb_user_details"]["name"] ) )? $_SESSION["fb_user_details"]["name"] : "";
		$user_email = ( isset( $_SESSION["fb_user_details"]["email"] ) )? $_SESSION["fb_user_details"]["email"] : "";
		
		###### connect to user table ########
		$mysqli = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_db_name);
		if ($mysqli->connect_error) {
			die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
		}
		
		//check user exist in table (using Facebook ID)
		$results = $mysqli->query("SELECT COUNT(*) FROM tblstudenten WHERE fbid=".$user_id);
		$get_total_rows = $results->fetch_row();
		
		if(!$get_total_rows[0]){ //no user exist in table, create new user
			$insert_row = $mysqli->query("INSERT INTO tblstudenten (fbid, fullname, email) VALUES(".$user_id.", '".$user_name."', '".$user_email."')");
		}
		
		//session ver is set, redirect user 
		header("location: ". $redirect_url);
		
	}
	/*else
	{ 	
		if(isset($_SESSION["fb_user_details"]))
		{
			//echo 'Hi '.$_SESSION["fb_user_details"]["name"].', you are logged in! [ <a href="?log-out=1">log-out</a> ] ';
			//print '<pre>';
			//print_r($_SESSION["fb_user_details"]);
			//print '</pre>';
			
		}
		else
		{
			//display login url 
			$login_url = $helper->getLoginUrl( array( 'scope' => $required_scope ) );
			echo '<a href="'.$login_url.'">Login with Facebook</a>'; 
		}
	/*if(!isset($_SESSION["fb_user_details"]))
		{
		    header("location:login.php");
		    exit();
		}
	*/
?><!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Welkom <?php echo $_SESSION["fb_user_details"]["name"];?></title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	
	<div class="navbar navbar-default">
   		<div class="navbar-header">
    		<a class="navbar-nav" href="index.php"><img class="logo" src="images/logo2.png" alt="The Rent A Student Logo" width="55%"></a>
       	</div>
      	<ul class="nav navbar-nav">
          	<li><a href="homepage.php">Home</a></li>
          	<li><a href="mijnBoekingen.php">Mijn boekingen</a></li>
          	<li><a href="logout.php">Uitloggen</a></li>
       	</ul>
   	</div>

<div class="container-fluid">
	
	<div class="row intro2">
		<div class="col-md-12">

			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-11">
					<h2><?php echo 'Hallo '.$_SESSION["fb_user_details"]["name"].', Je bent nu ingelogd! ';?></h2>
					<p>Hier kan je een buddy reserveren om samen een dag de richting IMD te ontdekken.<br/>Selecteer eerst een datum en vervolgens een buddy.</p>
					<?php if(isset($error)): ?>
							<div class="error alert alert-danger">
						<?php echo $error;?>
							</div>
						<?php endif; ?>

						<?php if(isset($success)): ?>
							<div class="feedback alert alert-success">
						<?php echo $success;?>
							</div>
						<?php endif; ?>
				</div>
			</div>

			<form action="" method="post">
			
			<div class="row">
				<div class="col-md-1">
				</div>
				<div class="col-md-3">
					<label for="datum">Gelieve de gewenste datum door te geven</label>
				</div>
				<div class="col-md-8">
					<select required name="datum" id="datum">
						<option value=""> Kies je datum </option>
						<?php
							while($datum = $data->fetch(PDO::FETCH_ASSOC))
							{
								echo '<option value="' . $datum['datumID'] . '">' .  $datum['datumDag'] . ' ' . $datum['datumMaand'] . ' ' . $datum['datumJaar'] . '</option>';
							}
						?>
					</select>
				</div>
			</div>

			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-3">
					<label for="Buddy">Kies hier je gewenste buddy:</label>
				</div>
				<div class="col-md-8">
					<ul>
						
						<?php
							//include db configuration file
							include_once("ajax/config.php");
							//MySQL query
							$results = $mysqli->query("SELECT * FROM tblstudenten WHERE fbid = '" . $_SESSION["fb_user_details"]["id"] . "'");
							//get all records
							while($row = $results->fetch_assoc())
							{
							  echo '<input type="hidden" value="' . $row['studentID'] . '" name="studentID" />';
							}
						?>

					

						<?php
							while($buddy = $allStudents->fetch(PDO::FETCH_ASSOC))
							{
								echo '<li class="buddy_list">';
									echo '<img src="' . $buddy['buddieFoto'] . '" class="center-cropped"/>';
									echo '<h3>' . $buddy["buddieVoornaam"] . " " . $buddy["buddieNaam"] . '</h3>';
									echo '<h4>' . $buddy['buddieJaar'] . 'e jaar ' . $buddy['buddieRichting'] . '</h4>';
									//echo '<input type="radio" value="' . $buddy['buddieID'] . '" name="' . $buddy['buddieID'] . '">';
									echo '<input type="hidden" name="buddieID" value="' . $buddy['buddieID'] . '">';
									echo '<button type="submit">Boek ' . $buddy["buddieVoornaam"] .'!</button>';
								echo '</li>';
							}
						?>
					</ul>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-8">
					
				</div>
			</div>
			
			</form>
		</div>
   	</div>

</div>
</body>
</html>