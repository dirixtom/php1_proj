<?php

	include_once("classes/Student.class.php");

	session_start();
	$s = new Student();

	if(!empty($_POST))
	{
		try 
		{	

			$s->Firstname = $_POST['firstname'];
			$s->Lastname = $_POST['lastname'];
			$s->Twitter = $_POST['twitter'];
			$s->Year = $_POST['year'];
			$s->Subject = $_POST['subject'];
			$s->Email = $_POST['email'];
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

?><html>
<head>
	<title>Studenten registratie</title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="container-fluid">
		
		<form method="post" action="" enctype="multipart/form-data" class="formulier">

			<div class="row">
				<div class="col-md-1">
				</div>
				<div class="col-md-4">
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
				<div class="col-md-7">	
				</div>
			</div>

			<div class="row">
				<div class="col-md-1">
				</div>
				<div class="col-md-2">
					<label for="firstname">Voornaam</label> *<br/>
				</div>
				<div class="col-md-9">
					<input type="text" id="firstname" name="firstname" placeholder="voornaam" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-1">
				</div>
				<div class="col-md-2">
					<label for="lastname">Achternaam</label> *<br/>
				</div>
				<div class="col-md-9">
					<input type="text" id="lastname" name="lastname" placeholder="achternaam" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-1">
				</div>
				<div class="col-md-2">
					<label for="email">Email</label> *<br/>
				</div>
				<div class="col-md-9">
					<input type="text" id="email" name="email" placeholder="email" />
				</div>
			</div>


			<div class="row">
				<div class="col-md-1">
				</div>
				<div class="col-md-2">
					<label for="password">Wachtwoord</label> *<br />
				</div>
				<div class="col-md-9">	
					<input type="password" id="password" name="password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-1">
				</div>
				<div class="col-md-2">
					<label for="cpassword">Verifieer Wachtwoord</label> *<br />
				</div>
				<div class="col-md-9">	
					<input type="password" id="cpassword" name="cpassword" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-1">
				</div>
				<div class="col-md-2">
					<label for="twitter">Twitter</label> *<br/>
				</div>
				<div class="col-md-9">	
					<input type="text" id="twitter" name="twitter" placeholder="@Twitter" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-1">
				</div>
				<div class="col-md-2">
					<label for="year">Klas</label> *<br />
				</div>
				<div class="col-md-9">	
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
				<div class="col-md-1">
				</div>
				<div class="col-md-2">
					<label for="fileToUpload">Profielafbeelding</label> * <a title="Gelieve alleen een JPEG-bestandsformaat te gebruiken. De afbeelding mag niet groter zijn dan 1MB."><img src="http://shots.jotform.com/kade/Screenshots/blue_question_mark.png" height="13px"/></a>
				</div>
				<div class="col-md-9">	
					<input type="file" name="fileToUpload" id="fileToUpload" class="fileupload" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-1">
				</div>
				<div class="col-md-3">
					<input class="submit" type="submit" value="Registreer" name='register'/>
				</div>
				<div class="col-md-9">	
				</div>
			</div>	
		</form>

		<div class="row">
			<div class="col-md-1">	
			</div>
			<div class="col-md-5">
				<br/><p>Al een account? <a href="login.php">Log hier in</a></p>
			</div>
			<div class="col-md-6">
			</div>
		</div>
	</div>

</body>
</html>