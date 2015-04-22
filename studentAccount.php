<?php
	session_start();
	if(!isset($_SESSION["email"]))
	{
	    header("location:login.php");
	    exit();
	}
	
	include_once("classes/Student.class.php");

	$b = new Student();
	$showAcc = $b->ShowAccount();

	if(!empty($_POST["FormDel"]))
	{
		try 
		{	
			
			$b->Id = $_POST['studentID'];
			$b->DeleteAccount();

			header("location:login.php");

		}
		catch(Exception $e)
		{
			$error = $e->getMessage();
		}
	}

	if(!empty($_POST["FormUpdate"]))
	{
		try 
		{	
			
			$b->Twitter = $_POST['twitter'];
			$b->Password = $_POST['password'];
			$b->Id = $_POST['studentID'];
			$b->CPassword = $_POST['cpassword'];
			
			$b->UpdateAccount();

			//header("location:login.php");

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
                <a class="navbar-brand" href="index.html">Welkom.</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                  
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION["email"] ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="studentaanpassen.php"><i class="fa fa-fw fa-user"></i> Profile</a>
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
                        <a href="studentDashboard.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <!-- <li>
                        <a href="adminboekingen.php"><i class="fa fa-fw fa-bar-chart-o"></i> Boekingen</a>
                    </li>
                    <li>
                        <a href="admindatums.php"><i class="fa fa-fw fa-edit"></i> Datums</a>
                    </li>
                    <li>
                        <a href="adminreacties.php"><i class="fa fa-fw fa-desktop"></i> Reacties</a>
                    </li>-->
                    <li>
                        <a href="#"><i class="fa fa-fw fa-table"></i> Messenger</a>
                    </li> 
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">
  
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-6">
                        <h1 class="page-header">
                            <small>Account aanpassen</small>
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

						<?php if(isset($succes)): ?>
							<div class="feedback alert alert-success">
						<?php echo $succes;?>
							</div>
						<?php endif; ?>

                		<form method="post" action="" class="form-horizontal">

	                		<?php
								while($acc = $showAcc->fetch(PDO::FETCH_ASSOC))
								{
									echo '<div class="form-group">';
						    			echo '<label for="email" class="col-sm-2 control-label">Email</label>';
						    	
						    			echo '<div class="col-sm-4">';
						      				echo '<input type="text" disabled id="email" name="email" placeholder="email" class="form-control" value="'.$acc['buddieEmail'].'" />';
						    			echo '</div>';
						  			echo '</div>';

						  			echo '<div class="form-group">';
						    			echo '<label for="password" class="col-sm-2 control-label">Wachtwoord</label>';
						    	
						    			echo '<div class="col-sm-4">';
						      				echo '<input type="password" id="password" name="password" placeholder="Nieuw wachtwoord" class="form-control" />';
						    			echo '</div>';
						  			echo '</div>';

						  			echo '<div class="form-group">';
						    			echo '<label for="password" class="col-sm-2 control-label"></label>';
						    	
						    			echo '<div class="col-sm-4">';
						      				echo '<input type="password" id="cpassword" name="cpassword" placeholder="Confirmeer nieuw wachtwoord" class="form-control" />';
						    			echo '</div>';
						  			echo '</div>';

						  			echo '<div class="form-group">';
						    			echo '<label for="twitter" class="col-sm-2 control-label">Twitter</label>';
						    	
						    			echo '<div class="col-sm-4">';
						      				echo '<input type="text" id="twitter" name="twitter" placeholder="@twitter" class="form-control" value="' . $acc['buddieTwitter'] . '" />';
						    			echo '</div>';
						  			echo '</div>';

						  			//echo '<div class="form-group">';
						    		//	echo '<label for="image" class="col-sm-2 control-label">Foto</label>';
						    		//
						    		//	echo '<div class="col-sm-4">';
						      		//		echo '<img src="' . $acc['buddieFoto'] . '"/>';
						    		//	echo '</div>';
						  			//echo '</div>';
									
									echo '<div class="form-group">';
						    			echo '<label for="" class="col-sm-2 control-label"></label>';
						    	
						    			echo '<div class="col-sm-4">';
						      				echo '<input type="hidden" name="studentID" value="'.$acc['buddieID'].'"/><input type="submit" class="submit" name="FormUpdate" value="Wijzig uw account">';
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