<?php
	session_start();
	if(!isset($_SESSION["email"]))
	{
	    header("location:login.php");
	    exit();
	}
	
	include_once("classes/Admin.class.php");

	$a = new Admin();
	$b = new Admin();
	$showAcc = $b->ShowAccount();

	if(!empty($_POST["FormUpdate"]))
	{
		try 
		{	
			
			$a->Name = $_POST['naam'];
			$a->Firstname = $_POST['voornaam'];			
			$a->Email = $_POST['email'];
			$a->Password = $_POST['password'];
			$a->Id = $_POST['adminID'];
			$a->UpdateAccount();

			$succes = "Account is gewijzigd!";

		}
		catch(Exception $e)
		{
			$error = $e->getMessage();
		}
	}

	if(!empty($_POST["FormDelete"]))
	{
		try 
		{	
			
			$b->Id = $_POST['adminID'];
			$b->DeleteAccount();

			$succes = "Account is verwijderd!";

		}
		catch(Exception $e)
		{
			$error = $e->getMessage();
		}
	}
?>
<html>
<head>
	<title>Accounts beheren</title>
	
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
                    <li>
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
                            <small>Profiel aanpassen</small>
                        </h1>  
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                	<div class="col-sm-10">
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

                		<form method="post" action="" class="form-horizontal">

	                		<?php
								while($acc = $showAcc->fetch(PDO::FETCH_ASSOC))
								{
									echo '<div class="form-group">';
						    			echo '<label for="naam" class="col-sm-2 control-label">Naam</label>';
						    	
						    			echo '<div class="col-sm-4">';
						      				echo '<input type="text" id="naam" name="naam" placeholder="Naam" class="form-control" value="'.$acc['adminNaam'].'" />';
						    			echo '</div>';
						  			echo '</div>';

						  			echo '<div class="form-group">';
						    			echo '<label for="voornaam" class="col-sm-2 control-label">Voornaam</label>';
						    	
						    			echo '<div class="col-sm-4">';
						      				echo '<input type="text" id="voornaam" name="voornaam" placeholder="Voornaam" class="form-control" value="'.$acc['adminVoornaam'].'" />';
						    			echo '</div>';
						  			echo '</div>';

									echo '<div class="form-group">';
						    			echo '<label for="email" class="col-sm-2 control-label">Email</label>';
						    	
						    			echo '<div class="col-sm-4">';
						      				echo '<input type="text" id="email" name="email" placeholder="email" class="form-control" value="'.$acc['adminEmail'].'" />';
						    			echo '</div>';
						  			echo '</div>';

						  			echo '<div class="form-group">';
						    			echo '<label for="password" class="col-sm-2 control-label">Wachtwoord</label>';
						    	
						    			echo '<div class="col-sm-4">';
						      				echo '<input type="password" id="password" name="password" placeholder="Nieuw wachtwoord" class="form-control" />';
						    			echo '</div>';
						  			echo '</div>';

						  			echo '<div class="form-group">';
						    			echo '<label for="" class="col-sm-2 control-label"></label>';
						    	
						    			echo '<div class="col-sm-4">';
						      				echo '	<input type="hidden" name="adminID" value="'.$acc['adminID'].'"/>
						      						<input type="submit" class="submit" name="FormUpdate" value="Wijzig uw account"><br/><br/><br/><br/>
						      						';
						    			echo '</div>';
						  			echo '</div>';

						  			echo '<div class="form-group">';
						    			echo '<br/><br/><br/><br/><input type="submit" class="submit col-sm-3" name="FormDelete" value="Verwijder uw account">';
						    	
						    			echo '<div class="col-sm-4">';
						      				
						    			echo '</div>';
						  			echo '</div>';
								}
							?>
						</form>
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