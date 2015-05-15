<?php
	session_start();
	if(!isset($_SESSION["email"]))
	{
	    header("location:login.php");
	    exit();
	}
	
    include_once("classes/Boeking.class.php");
    include_once("classes/Datum.class.php");
    include_once("classes/Reacties.class.php");

    $b = new Buddy();
    $allStudents = $b->getAllStudents();

    $r = new Reactie();
	

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Rate je buddy!</title>
  <script src="js/rating.js"></script>
</head>
<body>
<h1>Rate je buddy</h1>
<div class="col-lg-6">
                        <h1 class="page-header">
                            <small>onze buddies</small>
                        </h1>
                        <ul class="list-group"> 
                            <?php

                                while($b = $allStudents->fetch(PDO::FETCH_ASSOC))
                                {
                                    echo "<li class='list-group-item'>" . $b["buddieVoornaam"] . "<br />";
                                    echo "Naam: " . $b["buddieNaam"] . "<br />";
                                    echo "Datum: " . $b["buddieFoto"] . " " . $b["buddieRating"];
                                    
                                    echo "<span class="star-rating">
 										<input type="radio" name="rating" value="1"><i></i>
  										<input type="radio" name="rating" value="2"><i></i>
  										<input type="radio" name="rating" value="3"><i></i>
  										<input type="radio" name="rating" value="4"><i></i>
  										<input type="radio" name="rating" value="5"><i></i>
										</span>
										<strong class="choice">Choose a rating</strong>"
									echo "</li>";
                                }
                            ?>
                        </ul>
                    </div>
    <div class="col-lg-6">
    	<h2>Heb je een leuke quote die je graag wil delen?</h2>
    	
    	<form action="" method="post">
    		<input type="text" placeholder="Laat het ons weten!">

    	</form>
    </div>
</body>
</html>