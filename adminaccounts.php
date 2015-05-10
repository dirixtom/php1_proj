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
	$allAcc = $b->ShowAccounts();

	if(!empty($_POST["FormCreate"]))
	{
		try 
		{	

			$a->Email = $_POST['email'];
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

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>

	<script type="text/javascript">
	$(document).ready(function() {

	//##### send add record Ajax request to response.php #########
	$("#FormSubmit").click(function (e) {
			e.preventDefault();
			if($("#contentText").val()==='')
			{
				alert("Please enter some text!");
				return false;
			}
			
			$("#FormSubmit").hide(); //hide submit button
			$("#LoadingImage").show(); //show loading image
			
		 	var myData = { content_txt: $("#contentText").val(), content_pswd: $("#contentPSWD").val()}; //build a post data structure
			jQuery.ajax({
			type: "POST", // HTTP method POST or GET
			url: "ajax/AddDelete.php", //Where to make Ajax calls
			dataType:"text", // Data type, HTML, json etc.
			data:myData, //Form variables
			success:function(response){
				$("#responds").append(response);
				$("#contentText").val(''); //empty text field on successful
				$("#contentPSWD").val(''); //empty text field on successful
				$("#FormSubmit").show(); //show submit button
				$("#LoadingImage").hide(); //hide loading image

			},
			error:function (xhr, ajaxOptions, thrownError){
				$("#FormSubmit").show(); //show submit button
				$("#LoadingImage").hide(); //hide loading image
				alert(thrownError);
			}
			});
	});

	//##### Send delete Ajax request to response.php #########
	$("body").on("click", "#responds .del_button", function(e) {
		 e.preventDefault();
		 var clickedID = this.id.split('-'); //Split ID string (Split works as PHP explode)
		 var DbNumberID = clickedID[1]; //and get number from array
		 var myData = 'recordToDelete='+ DbNumberID; //build a post data structure
		 
		$('#item_'+DbNumberID).addClass( "sel" ); //change background of this element by adding class
		$(this).hide(); //hide currently clicked delete button
		 
			jQuery.ajax({
			type: "POST", // HTTP method POST or GET
			url: "ajax/AddDelete.php", //Where to make Ajax calls
			dataType:"text", // Data type, HTML, json etc.
			data:myData, //Form variables
			success:function(response){
				//on success, hide  element user wants to delete.
				$('#item_'+DbNumberID).fadeOut();
			},
			error:function (xhr, ajaxOptions, thrownError){
				//On error, we alert user
				alert(thrownError);
			}
			});
		});

	});
	
	</script>

	<script src="js/additional-methods.js"></script>
	<script src="js/jquery.js"></script>
    <script src="js/validate.js"></script>
    <script src="js/jq_errors.js"></script>

	<script>
		$(document).ready(function() {
    
		    $('#FormSubmit').validate({

		        errorElement: 'div',
		        rules: {
		            content_txt: {
		                required: true
		            },
		            content_pswd: {
		                required: true
		            }
		        },

			    submitHandler: function(form) {
		            form.submit();
		        }
		    });
		});
	</script>


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

                <!-- Account toevoegen met enkel PHP
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
                			<div class="form-group">
						    	<label for="email" class="col-sm-2 control-label">Email</label>
						    	
						    	<div class="col-sm-10">
						      		<input type="text" id="email" name="email" placeholder="Email" class="form-control" />
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
				-->

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
                			<div class="form-group">
						    	<label for="content_txt" class="col-sm-2 control-label">Email</label>
						    	
						    	<div class="col-sm-10">
						      		<input type="text" class="form-control" name="content_txt" id="contentText" cols="45" rows="5" placeholder="email"></input>
						    	</div>
						  	</div>
						  	<div class="form-group">
						    	<label for="content_pswd" class="col-sm-2 control-label">Password</label>
						    	
						    	<div class="col-sm-10">
						      		<input type="password" class="form-control" name="content_pswd" id="contentPSWD" cols="45" rows="5" placeholder="password"></input>
						    	</div>
						  	</div>
						  	<div class="form-group">
						    	<div class="col-sm-offset-2 col-sm-10">
						      		
						      		
						      		<button id="FormSubmit">Voeg Account Toe</button>
					    			<img src="images/loading.gif" id="LoadingImage" style="display:none" />
						    	</div>
						 	</div>
                		</form>
                	</div>
                </div>

                <!--
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
										echo "<div class='col-sm-5'>";
											echo "<label for='username' class='col-sm-4 control-label'>" . $acc["adminEmail"] . "</label>";
										echo "</div>";
										echo "<div class='col-sm-2'>";
											echo "<input type='hidden' name='adminID' value='".$acc['adminID']."'><input type='submit' class='submit' name='FormDel' value='Verwijder Account'><br /><br />";
										echo "</div>";
									echo "</div>";
								echo "</form>";
							}
						?>
                	</div>
                </div>
				-->

				<h1 class="page-header">
                    <small>Overzicht van andere Admin accounts</small>
                </h1>  
                <div class="row">
                	<div class="col-sm-6">
                		<ul id="responds">
						<p>* Om je eigen account aan te passen, ga je naar Profile rechtsboven.</p>
						<?php
							//include db configuration file
							include_once("ajax/config.php");

							//MySQL query
							$results = $mysqli->query("SELECT adminID,adminEmail FROM tbladmin WHERE adminEmail NOT LIKE '" . $_SESSION['email'] . "'");
							//get all records
							while($row = $results->fetch_assoc())
							{
							  echo '<li id="item_'.$row["adminID"].'">';
							  echo '<div class="del_wrapper"><a href="#" class="del_button" id="del-'.$row["adminID"].'">';
							  echo '<img src="images/icon_del.gif" border="0" />';
							  echo '</a></div>';
							  echo $row["adminEmail"].'</li>';
							}

							//close db connection
							$mysqli->close();
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