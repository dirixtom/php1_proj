<?php 

include_once("classes/Student.class.php");
$s = new Student();
$allStudents = $s->GetStudentsIndex();

session_start(); //Session should always be active

$app_id       = '1378145582515326';  //localhost
$app_secret     = '2819b5faff3c55c4808ed979975eb46d';
$required_scope   = 'public_profile, publish_actions'; //Permissions required
$redirect_url     = 'http://localhost:8888/PHP1/php1_proj/bezoekerDashboard.php'; //FB redirects to this page with a code

//MySqli details for saving user details
$mysql_host     = 'localhost';
$mysql_username   = 'root';
$mysql_password   = 'root';
$mysql_db_name    = 'phpproject';

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
  
}else{ 
  
  //session var is still there
  /*if(isset($_SESSION["fb_user_details"]))
  {
    echo 'Hi '.$_SESSION["fb_user_details"]["name"].', you are logged in! [ <a href="?log-out=1">log-out</a> ] ';
    //print '<pre>';
    //print_r($_SESSION["fb_user_details"]);
    //print '</pre>';
    
  }
  /*else
  {
    //display login url 
    $login_url = $helper->getLoginUrl( array( 'scope' => $required_scope ) );
    echo '<a href="'.$login_url.'">Login with Facebook</a>'; 
  }*/
}
  
?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Rent A Student</title>
	
	<link href="css/reset.css" rel="stylesheet" />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet" />
  <script type="text/javascript" src="js/instafeed.min.js"></script>

  <script type="text/javascript">
    var feed = new Instafeed({
        get: 'tagged',
        tagName: 'WeAreIMD',
        clientId: '21eeb5b147ac46159f720b95a59f6ca6',
        filter: function(image) {
            var blockedUsernames = [
            'imtoofabluv'
            ];

            // check for blocked users
            for (var i=0; i<blockedUsernames.length; i++) {
               if (image.user.username === blockedUsernames[i]) {
                 return false;
               }
            }
            return true;
        },
        limit: '20'
    });
    feed.run();

</script>
</head>
<body id="homepage">
	
	<div class="navbar navbar-default">
   		<div class="navbar-header">
    		<a class="navbar-nav" href="#"><img class="logo" src="images/logo2.png" alt="The Rent A Student Logo" width="55%"></a>
       	</div>
      	<ul class="nav navbar-nav">
          	<!-- <li><a href="login.php">Inloggen / Registreren</a></li> -->
       	</ul>
   	</div>

<div class="container-fluid">

   	<div class="row text-left intro">
   		<div class="col-md-5">
       	</div>
       	<div class="col-md-6">
	        <h1>Krijg persoonlijke begeleiding!</h1>
	        <p class="lead">
	        		Huur een student voor een dag. <br />
					Volg mee zijn of haar lessen en leer hoe het echt is om een WeAreIMD-student te zijn! <br /><br />

					<strong>Hoe doe ik dat?</strong><br />
					Het is heel gemakkelijk! Scroll verder naar beneden en zoek uit met welke student jij wel eens een schooldag wilt beleven. <br /><br />
          <?php     
              //display login url 
              $login_url = $helper->getLoginUrl( array( 'scope' => $required_scope ) );
              echo '<a href="'.$login_url.'"><button class="btn btn-default btn-lg ghost-button-transition facebook">Registreer met Facebook hier<br/>en bekijk welke data er vrij zijn!</button></a>'
          ?>
          <p>Ben je reeds IMD-student?<br/>Dan kan je <a href="login.php">hier inloggen</a> of <a href="registreer.php">registreren als buddy!</a></p>
			</p>
		</div>
   	</div>
  	
  	<div class="row text-center quotes">
	  	<div class="col-md-2">
	  		<img class="quotel" src="images/quotel.png" alt="quoteimage">
	  	</div>
	  	<div class="col-md-8">
	  		<h2>Simplicity is the ultimate sophistication</h2>
	  		<p>Leonardo Da Vinci</p>
	  	</div>
	  	<div class="col-md-2">
	  		<img class="quoter" src="images/quoter.png" alt="quoteimage">
	  	</div>
	</div>

  	<div class="row text-center buddies">
			<h2>Meet the most popular Buddies</h2>
		
      <?php
                while($student = $allStudents->fetch(PDO::FETCH_ASSOC))
                {
                  echo '<div class="student col-md-4">';
                    echo '<img src="'. $student["buddieFoto"] .'" alt="Foto ' . $student["buddieVoornaam"] . '" class="center-cropped" />';
                    echo '<h3>' . $student["buddieVoornaam"] . '</h3>';
                    echo '<p>'. $student["buddieJaar"] . 'e jaarstudent</p>';
                  echo '</div>';                  
                }
              ?>
   	</div>

    <div class="row text-center instagram">
      <div class="col-md-12">
        <h2>Share your day on Instagram met onderstaande hashtags!</h2>
        <p>#IMD #openlesdag #rentastudent</p>
      </div>
    </div>

   	<div class="row text-center pictures">
		
		  <div class="student col-md-12" id="instafeed">
      </div>
		
   	</div>

   	<div class="row text-center footer">
		<div class="student col-md-4">
           	<p>Een initiatief van Thomas More Mechelen - IMD</p>
       	</div>
		<div class="student col-md-4">
       	</div>
		<div class="student col-md-4">
           	<img src="images/tmsmr.jpg" width="20%">
           	<img src="images/wrmd.jpg" width="25%">
       	</div>
   	</div>

</div> 
</body>
</html> 