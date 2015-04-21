<?php
	session_start();
	if(!isset($_SESSION["username"]))
	{
	    header("location:login.php");
	    exit();
	}
	
	include_once("classes/Admin.class.php");

	$a = new Admin();
	$b = new Admin();
	$allAcc = $b->ShowAccounts();

	if(!empty($_POST["FormCreate"]))
	{
		try 
		{	

			$a->Username = $_POST['username'];
			$a->Password = $_POST['password'];
			$a->CreateAccount();

			$succes = "Account is toegevoegd!";

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
                <a class="navbar-brand" href="index.html">Welkom, <?php echo $_SESSION["username"];?>.</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                  
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION["username"] . " ";?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
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
                    <li class="selected">
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
                            <small> Accounts toevoegen</small>
                        </h1>  
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                	<div class="col-sm-6">
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
                			<div class="form-group">
						    	<label for="username" class="col-sm-2 control-label">Username</label>
						    	
						    	<div class="col-sm-10">
						      		<input type="text" id="username" name="username" placeholder="username" class="form-control" />
						    	</div>
						  	</div>
						  	<div class="form-group">
						    	<label for="password" class="col-sm-2 control-label">Password</label>
						    	
						    	<div class="col-sm-10">
						      		<input type="password" id="password" name="password" placeholder="password" class="form-control" />
						    	</div>
						  	</div>
						  	<div class="form-group">
						    	<div class="col-sm-offset-2 col-sm-10">
						      		
						      		<input class="submit" type="submit" value="Account Toevoegen" name='FormCreate'/>
						    	</div>
						 	</div>
                		</form>
                	</div>
                </div>

                <h1 class="page-header">
                    <small>Overzicht van accounts</small>
                </h1>  
                <div class="row">
                	<div class="col-sm-6">
                		<?php
							while($acc = $allAcc->fetch(PDO::FETCH_ASSOC))
							{
								echo "<form method='post' class='form-horizontal'>";
									echo "<div class='form-group'>";
										echo "<div class='col-sm-3'>";
											echo "<label for='username' class='col-sm-2 control-label'>" . $acc["username"] . "</label>";
										echo "</div>";
										echo "<div class='col-sm-6'>";
											echo "<input type='hidden' name='adminID' value='".$acc['id']."'><input type='submit' class='submit' name='FormDel' value='Verwijder Account'><br /><br />";
										echo "</div>";
									echo "</div>";
								echo "</form>";
							}
						?>
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