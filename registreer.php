<?php
	
	include_once("classes/Student.class.php");
	
	$s = new Student();

	if(isset($_POST['StudentRegister']))
	{
		try 
		{	

			$s->Firstname = $_POST['firstname'];
			$s->Lastname = $_POST['lastname'];
			$s->Twitter = $_POST['twitter'];
			$s->Year = $_POST['year'];
			$s->Subject = $_POST['subject'];
			$s->Email = $_POST['email'];

			$s->checkPassword($_POST['password'],$_POST['cpassword']);

			$s->Password = $_POST['password'];
			$s->CPassword = $_POST['cpassword'];

			$map = $_POST['email'];
        	if(!file_exists("images/profpics/$map"))
        	{
            	mkdir("images/profpics/$map", 0777, true);
        	}

        	include_once("upload.php");

        	$s->Picture = "images/profpics/".$_POST['email']."/".basename( $_FILES["fileToUpload"]["name"]);

			$s->Save();

			$success = "Uw profiel is aangemaakt.";

		}
			catch(Exception $e)
			{
				$error = $e->getMessage();
			}
	}

?><!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Rent a student - Login</title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<script src="js/additional-methods.js"></script>
	<script src="js/jquery.js"></script>
    <script src="js/validate.js"></script>
    <script src="js/jq_errors.js"></script>

	<script>
		$(document).ready(function() {
    
		    $('#registreerform').validate({

		        errorElement: 'div',
		        rules: {
		            firstname: {
		                required: true
		            },
		            lastname: {
		                required: true
		            },
		            email: {
		                required: true,
		                email: true
		            },
		            password: {
		                required: true,
		                minlength: 6

		            },
		            cpassword: {
		                required: true
		            },
		            twitter: {
		                required: true
		            },
		            fileToUpload: {
		                required: true
		            }
		        },

			    submitHandler: function(form) {
		            form.submit();
		        }
		    });
		});
	</script>

	<style>
		input{
			width: 300px;
		}
	</style>

</head>
<body>
	
	<div class="navbar navbar-default">
   		<div class="navbar-header">
    		<a class="navbar-nav" href="#"><img class="logo" src="images/logo2.png" alt="The Rent A Student Logo" width="55%"></a>
       	</div>
      	<ul class="nav navbar-nav">
          	<li><a href="homepage.php">Home</a></li>
       	</ul>
   	</div>

<div class="container-fluid">
 
   	<div class="row intro2">
       	        	
       	<div class="col-md-6">
		    <div class="col-md-12">
   			<form method="post" action="" enctype="multipart/form-data" class="formulier" id="registreerform">
			
			<div class="row">
				
				<div class="col-md-12">
					<legend>Studenten registratie</legend>
					Alle velden met een * zijn verplicht<br/>
					<?php if(isset($error)): ?>
						<div class="error">
					<?php echo $error;?>
						</div>
					<?php endif; ?>

					<?php if(isset($success)): ?>
						<div class="feedback">
					<?php echo $success;?>
						</div>
					<?php endif; ?>
					<br/>
				</div>
			</div>

			<div class="row">
				
				<div class="col-md-4">
					<label for="firstname">Voornaam</label> *<br/>
				</div>
				<div class="col-md-8">
					<input type="text" id="firstname" name="firstname" placeholder="Voornaam"/>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<label for="lastname">Achternaam</label> *<br/>
				</div>
				<div class="col-md-8">
					<input type="text" id="lastname" name="lastname" placeholder="Achternaam" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<label for="email">Email</label> *<br/>
				</div>
				<div class="col-md-8">
					<input type="text" id="email" name="email" placeholder="email" />
				</div>
			</div>


			<div class="row">
				<div class="col-md-4">
					<label for="password">Wachtwoord</label> *<br />
				</div>
				<div class="col-md-8">	
					<input type="password" id="password" name="password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<label for="cpassword">Verifieer Wachtwoord</label> *<br />
				</div>
				<div class="col-md-8">	
					<input type="password" id="cpassword" name="cpassword" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<label for="twitter">Twitter</label> *<br/>
				</div>
				<div class="col-md-8">	
					<input type="text" id="twitter" name="twitter" placeholder="@Twitter" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<label for="year">Klas</label> *<br />
				</div>
				<div class="col-md-8">	
					<select id="year" name="year">
					 	<option value="1">1</option> 
					 	<option value="2">2</option>
					 	<option value="3">3</option>
					</select>
					<select name="subject">
					 	<option value="1">IM Design</option> 
					 	<option value="2">IM Development</option>
					</select>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<label for="fileToUpload">Profielafbeelding</label> * <a title="Gelieve alleen een JPEG-, PNG- of GIF-bestandsformaat te gebruiken. De afbeelding mag niet groter zijn dan 1MB. Gelieve een grootte te behouden van 100x100px, voor een correcte weergave van uw profielfoto."><img src="http://shots.jotform.com/kade/Screenshots/blue_question_mark.png" height="13px"/></a>
				</div>
				<div class="col-md-8">	
					<input type="file" name="fileToUpload" id="fileToUpload" class="fileupload" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">	
				</div>
				<div class="col-md-8">
					<input class="submit" type="submit" value="Registreer" name="StudentRegister"/>
				</div>
			</div>	
			</form>

		</div>
   	</div>

</div>
</body>
</html>
