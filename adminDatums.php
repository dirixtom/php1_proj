<?php
	session_start();
	if(!isset($_SESSION["email"]))
	{
	    header("location:login.php");
	    exit();
	}
	
	include_once("classes/Datum.class.php");

	$d = new Datum();
	$b = new Datum();
	$allDate = $d->ShowDate();

	if(!empty($_POST['FormCreate']))
	{
		try 
		{	
			
			$d->Dag = $_POST['dag'];
			$d->Maand = $_POST['maand'];
			$d->Jaar = $_POST['jaar'];
			$d->SaveDate();

			$succes = "Datum is toegevoegd!";

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
			
			$b->Id = $_POST['dateID'];
			$b->DeleteDate();

			$succes = "Datum is verwijderd!";

		}
		catch(Exception $e)
		{
			$error = $e->getMessage();
		}
	}
?>
<html>
<head>
	<title>Datums van boekingen toevoegen</title>
	
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
                    <li class="selected">
                        <a href="admindatums.php"><i class="fa fa-fw fa-edit"></i> Datums</a>
                    </li>
                    <li>
                        <a href="adminreacties.php"><i class="fa fa-fw fa-desktop"></i> Reacties</a>
                    </li>
                    <li>
                        <a href="adminaccounts.php"><i class="fa fa-fw fa-table active"></i> Accounts</a>
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
                            <small> Datums toevoegen voor boekingen</small>
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
						    	<label for="dag" class="col-sm-2 control-label">Dag</label>
						    	
						    	<div class="col-sm-10">
						      		<select name="dag" id="dag" class="form-control">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
										<option value="13">13</option>
										<option value="14">14</option>
										<option value="15">15</option>
										<option value="16">16</option>
										<option value="17">17</option>
										<option value="18">18</option>
										<option value="19">19</option>
										<option value="20">20</option>
										<option value="21">21</option>
										<option value="22">22</option>
										<option value="23">23</option>
										<option value="24">24</option>
										<option value="25">25</option>
										<option value="26">26</option>
										<option value="27">27</option>
										<option value="28">28</option>
										<option value="29">29</option>
										<option value="30">30</option>
										<option value="31">31</option>
									</select>
						    	</div>
						  	</div>
						  	<div class="form-group">
						    	<label for="maand" class="col-sm-2 control-label">Maand</label>
						    	
						    	<div class="col-sm-10">
						      		<select name="maand" id="maand" class="form-control">
										<option value="Januari">Januari</option>
							  			<option value="Februari">Februari</option>
							  			<option value="Maart">Maart</option>
							  			<option value="April">April</option>
							  			<option value="Mei">Mei</option>
							  			<option value="Juni">Juni</option>
							  			<option value="Juli">Juli</option>
							  			<option value="Augustus">Augustus</option>
							  			<option value="September">September</option>
							  			<option value="Oktober">Oktober</option>
							  			<option value="November">November</option>
							  			<option value="December">December</option>
									</select>
						    	</div>
						  	</div>
						  	<div class="form-group">
						    	<label for="jaar" class="col-sm-2 control-label">Jaar</label>
						    	
						    	<div class="col-sm-10">
						      		<select name="jaar" id="jaar" class="form-control">
							  			<option value="2015">2015</option>
							  			<option value="2016">2016</option>
							  			<option value="2017">2017</option>
									</select>
						    	</div>
						  	</div>
						  	<div class="form-group">
						    	<div class="col-sm-offset-2 col-sm-10">
						      		
						      		<input class="submit" type="submit" id="btnSubmit" value="Datum toevoegen" name='FormCreate' />
						    	</div>
						 	</div>
                		</form>
                	</div>
                </div>

                <h1 class="page-header">
                    <small>Overzicht van beschikbare datums</small>
                </h1>  
                <div class="row">
                	<div class="col-sm-6">
                		
						<?php
							while($date = $allDate->fetch(PDO::FETCH_ASSOC))
							{
								echo "<form method='post' class='form-horizontal'>";
									echo "<div class='form-group'>";
										echo "<div class='col-sm-3'>";
											echo "<label for='username' class='col-sm-2 control-label'>". $date["datumDag"] . " " . $date["datumMaand"] . " " . $date["datumJaar"] . "</label>";
										echo "</div>";
										echo "<div class='col-sm-6'>";
											echo "<input type='hidden' name='dateID' value='".$date['datumID']."'><input type='submit' class='submit' name='FormDel' value='Verwijder datum'><br /><br />";
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