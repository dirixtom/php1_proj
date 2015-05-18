<?php  
	
	session_start(); //Session should always be active

	include_once("classes/Boeking.class.php");
	
	$b = new Boeking();
	
	if(isset($_POST['FormDel'])) {
		try {	
			
			$b->Id = $_POST['boekingID'];
			$b->deleteBoeking();

			var_dump($_POST['boekingID']);
			
			$succes = "Uw Afspraak is verwijderd!";
		}
		catch(Exception $e) {
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
	include_once("ajax/config.php");
	
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
		$mysqli = new mysqli($hostname, $username, $password, $databasename);
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
          	<li><a href="index.php">Home</a></li>
          	<li><a href="bezoekerDashboard.php">Een afspraak maken</a></li>
          	<li><a href="bezoekerBoekingen.php">Mijn boekingen</a></li>
          	<li><a href="templogin.php">Messenger</a></li>
          	<li><a href="logout.php">Uitloggen</a></li>
       	</ul>
   	</div>
	<div class="container-fluid">
		<div class="row intro2">
			<div class="col-md-12">
				<h3>Je geboekte afspraken</h3>
				<br/>
				<?php
					//include db configuration file
					include_once("ajax/config.php");
					//MySQL query
					$results = $mysqli->query("SELECT * FROM tblboekingen 
												INNER JOIN tblbuddies ON tblboekingen.buddieID= tblbuddies.buddieID 
												INNER JOIN tbldatums ON tblboekingen.datumID= tbldatums.datumID 
												INNER JOIN tblstudenten ON tblboekingen.studentID = tblstudenten.studentID 
											   WHERE tblstudenten.fbid = '" . $_SESSION["fb_user_details"]["id"] . "'");
					//get all records
					while($row = $results->fetch_assoc())
					{
						echo "<p>Je hebt een afspraak met: " . $row['buddieVoornaam'] . " " . $row['buddieNaam'] . "</p>";
						echo "<p>op: " . $row['datumDag'] . " " . $row['datumMaand'] . " " . $row['datumJaar'] . "</p>";
						
						//echo '<input type="text" name="boekingID" value="' . $row['boekingID'] . '" />';
						//echo '<button type="submit" name="FormDel">Boeking verwijderen</button>';
						//echo '</form>';

						echo "<form method='post'>";
                          	echo "<input type='hidden' name='boekingID' value='".$row['boekingID']."'><input type='submit' class='submit' name='FormDel' value='Verwijder boeking'><br /><br />";
                       	echo "</form>";
						
						echo '<br/>';
						echo '<br/>';
					}
				?>
			</div>
		</div>
	</div>
</body>
</html>
		