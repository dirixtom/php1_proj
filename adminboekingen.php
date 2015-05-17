<?php
	session_start();
	if(!isset($_SESSION["email"]))
	{
	    header("location:login.php");
	    exit();
	}

	include_once("classes/Boeking.class.php");

	$b = new Boeking();
	$allBoekings = $b->getAllBoekingen();
?>
<html>
<head>
	<title>Boekingen</title>
	
	<!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
</head>
<body>
	
	<div id="wrapper">

		<!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Welkom, <?php echo $_SESSION["email"];?>.</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                  
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION["email"] . " ";?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="adminAccount.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>                       
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="admindashboard.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="selected">
                        <a href="adminboekingen.php"><i class="fa fa-fw fa-bar-chart-o"></i> Boekingen</a>
                    </li>
                    <li>
                        <a href="admindatums.php"><i class="fa fa-fw fa-edit"></i> Datums</a>
                    </li>
                    <li>
                        <a href="adminreacties.php"><i class="fa fa-fw fa-desktop"></i> Reacties</a>
                    </li>
                    <li>
                        <a href="adminaccounts.php"><i class="fa fa-fw fa-table"></i> Accounts</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <small>Overzicht van alle boekingen</small>
                        </h1>  
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                	<div class="col-sm-6">
                       	<ul class="list-group"> 
							<?php

								while($boeking = $allBoekings->fetch(PDO::FETCH_ASSOC))
								{
									echo "<li class='list-group-item'>Voornaam: " . $boeking["buddieVoornaam"] . "<br />";
									echo "Naam: " . $boeking["buddieNaam"] . "<br />";
									echo "Datum: " . $boeking["datumDag"] . " " . $boeking["datumMaand"] . " " . $boeking['datumJaar'] . "<br /><br />";
                                    echo "Geboekt door: " . $boeking["fullname"] . "<br />";
									
                                    $datumvandaag = date('d-m-Y');

                                    echo 'Datum vandaag: ' . $datumvandaag;

                                    $datumafspraak = $boeking["datumDag"] . "-" . $boeking["datumMaand"] . "-" . $boeking['datumJaar'];
                                    if($datumafspraak < $datumvandaag) {
                                        

                                        $contactemail = "rentastudentthomasmore@gmail.com";
                                        $email = $boeking["email"];
                                       
                                        $to = $email; 
                                        $bcc = $contactemail; 

                                        $subject = "Rate your buddy and leave some feedback."; 
                                        $message = "Lorem ipsumtekstje"; 


                                        $headers = 'From: rentastudentthomasmore@gmail.com' . "\r\n" .
                                                   'Reply-to: rentastudentthomasmore@gmail.com' ; 

                                        mail('noe.baeten@gmail.com', $subject, $message, $headers); 
                                        mail($bcc, $subject, $message, $headers); 
                                    } 
                                    else {
                                        echo "niet gelukt";
                                    }
                                    echo "</li>";
								}
							?>
                        </ul>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

        <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
		
	</div>
	</div>

</body>
</html>