<?php
	session_start();
	if(!isset($_SESSION["email"]))
	{
	    header("location:Studentlogin.php");
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

			header("location:Studentlogin.php");

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
	

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="page-header">
                            <small> Profiel beheren</small>
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
						    	<label for="twitter" class="col-sm-2 control-label">Twitter</label>
						    	
						    	<div class="col-sm-10">
						      		<input type="text" id="twitter" name="twitter" placeholder="@twitter" class="form-control" />
						    	</div>
						  	</div>
                			<div class="form-group">
						    	<label for="email" class="col-sm-2 control-label">Email</label>
						    	
						    	<div class="col-sm-10">
						      		<input type="text" id="email" name="email" placeholder="email" class="form-control" />
						    	</div>
						  	</div>
						  	<div class="form-group">
						    	<label for="password" class="col-sm-2 control-label">Wachtwoord</label>
						    	
						    	<div class="col-sm-10">
						      		<input type="password" id="password" name="password" placeholder="wachtwoord" class="form-control" />
						    	</div>
						    </div>
						    <div class="form-group">
						    	<div class="col-sm-offset-2 col-sm-10">
						      		<input type="password" id="cpassword" name="cpassword" placeholder="confirmeer wachtwoord" class="form-control" />
						    	</div>
						  	</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="fileToUpload">Foto</label>
								
								<div class="col-sm-10">	
									<input type="file" name="fileToUpload" id="fileToUpload" />
								</div>
							</div>
						  	<div class="form-group">
						    	<div class="col-sm-offset-2 col-sm-10">
						      		
						      		<input class="submit" type="submit" value="Account Updaten" name='FormEdit'/>
						    	</div>
						 	</div>
                		</form>
                		<?php
							while($acc = $showAcc->fetch(PDO::FETCH_ASSOC))
							{
								echo "<div class='row'>";
				                    echo "<div class='col-sm-12'>";
				                        echo "<h1 class='page-header'>";
				                            echo "<small> Profiel verwijderen</small>";
				                        echo "</h1>";  
				                    echo "</div>";
				                echo "</div>";
								echo "<form method='post' class='form-horizontal'>";
									echo "<div class='form-group'>";
										echo "<div class='col-sm-offset-2 col-sm-5'>";
											echo "<input type='hidden' name='buddieID' value='".$acc['buddieID']."'><input type='submit' class='submit' name='FormDel' value='Verwijder Account'>";
										echo "</div>";
									echo "</div>";
								echo "</form>";
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
		

</body>
</html>