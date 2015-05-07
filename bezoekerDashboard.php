<?php
session_start(); //Session should always be active
	
	include_once("classes/Datum.class.php");
	include_once("classes/Student.class.php");

	$d = new Datum();
	$data = $d->ShowDate();

	$s = new Student();
	$aStudents = $s->GetAllStudents();

	//$f = new Student();
	//$fStudents = $f->VrijeStudents();

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
	$results = $mysqli->query("SELECT COUNT(*) FROM usertable WHERE fbid=".$user_id);
	$get_total_rows = $results->fetch_row();
	
	if(!$get_total_rows[0]){ //no user exist in table, create new user
		$insert_row = $mysqli->query("INSERT INTO usertable (fbid, fullname, email) VALUES(".$user_id.", '".$user_name."', '".$user_email."')");
	}
	
	//session ver is set, redirect user 
	header("location: ". $redirect_url);
	
}

else
{ 	
	if(isset($_SESSION["fb_user_details"]))
	{
		echo 'Hi '.$_SESSION["fb_user_details"]["name"].', you are logged in! [ <a href="?log-out=1">log-out</a> ] ';
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
    		<a class="navbar-nav" href="#"><img class="logo" src="images/logo2.png" alt="The Rent A Student Logo" width="55%"></a>
       	</div>
      	<ul class="nav navbar-nav">
          	<li><a href="homepage.php">Home</a></li>
          	<li><a href="login.php">Boeken</a></li>
       	</ul>
   	</div>

<div class="container-fluid">
	
	<div class="row intro2">
		<div class="col-md-12">

			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-11">
					<h2><?php echo 'Hi '.$_SESSION["fb_user_details"]["name"].', you are logged in! [ <a href="logout.php">Log-out</a> ] ';?></h2>
				</div>
			</div>

			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-11">
					<h3>Hier kan je je Buddie reserveren!</h3>
				</div>
			</div>

			<form action="" method="post">
			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-3">
					<label for="datum">Gelieve de gewenste datum door te geven</label>
				</div>
				<div class="col-md-8">
					<form action="" method="post">
					<select required name="datum" id="datum" onchange="getData(this.value)">
						<option value=""> Kies je datum </option>
						<?php foreach ($data as $d): ?>
						<option value="<?php echo $d['Id'] ;?>"><?php echo $d['datumDag'] . " " . $d['datumMaand'] . " " . $d['datumJaar'] ;?></option>
						<?php endforeach;?>
					</select>
					<input type="submit">
					</form>
				</div>
			</div>

			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-3">
					<label for="Buddy">Kies hier je gewenste buddy:</label>
				</div>
				<div class="col-md-8">
					<ul>
						<?php foreach ($aStudents as $s): ?>
						<li class="buddy">
							<img src="<?php echo $s['buddieFoto'] ?>" alt="<?php echo "photo" . " " . $s['buddieNaam'];  ?>"/>
							<h3><?php echo $s['buddieVoornaam'] . " " . $s['buddieNaam']; ?></h3>
							<h4><?php echo $s['buddieJaar'] . "e jaar " . $s['buddieRichting'];  ?></h4>
							<input type="radio" value="<?php echo $s['buddieID'] ;?>">
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>

			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-11">
					<br/><button type="submit">Boeken</button>
				</div>
			</div>
			</form>

			<div class="row afspraak">
				<div class="col-md-1"></div>
				<div class="col-md-11">
					<h3>Jouw Afspraak</h3>
					<p>Je hebt een afspraak met: <?php echo $s['buddieVoornaam'] . " " . $s['buddieNaam']; ?></p>
					<p>op: <?php echo $d['datumDag'] . " " . $d['datumMaand'] . " " . $d['datumJaar'] ;?></p>
				</div>
			</div>
		</div>
   	</div>

</div>
</body>
</html>