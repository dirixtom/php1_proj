<?php 
	
	include_once("classes/Admin.class.php");
	include_once("classes/Student.class.php");
	
	$a = new Admin();
	$s = new Student();

	if(!empty($_POST['AdminLogin']))
	{
		try 
		{	
			
			$a->Email = $_POST['email'];
			$a->Password = $_POST['password'];

			$a->Login();

		}
		catch(Exception $e)
		{
			$erroradmin = $e->getMessage();
		}
	}

	if(!empty($_POST['StudentLogin']))
	{
		try 
		{	
			
			$s->Email = $_POST['email'];
			$s->Password = $_POST['password'];

			$s->login();

		}
		catch(Exception $e)
		{
			$errorstudent = $e->getMessage();
		}
	}

	if(!empty($_POST['StudentRegister']))
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
 	
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Rent a student - Login</title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
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
   			
   			<form method="post" class="formulier">
			
			<div class="row">
				<div class="col-md-1">	
				</div>
				<div class="col-md-11">
					<legend>Student login</legend>
					<?php if(isset($errorstudent)): ?>
						<div class="error">
					<?php echo $errorstudent;?>
						</div>
					<?php endif; ?>
					<?php if(isset($succes)): ?>
						<div class="feedback">
					<?php echo $succes;?>
						</div>
					<?php endif; ?>
					<br />
				</div>
			</div>

			<div class="row">
				<div class="col-md-1">	
				</div>
				<div class="col-md-2">
					<label for="email">Email:</label>	
				</div>
				<div class="col-md-9">
					<input type="text" id="email" name="email" placeholder="email" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-1">	
				</div>
				<div class="col-md-2">
					<label for="password">Password:</label>
				</div>
				<div class="col-md-9">
					<input type="password" id="password" name="password" placeholder="password" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-3">	
				</div>
				<div class="col-md-9">
					<input class="submit" type="submit" value="Login" name="StudentLogin" />
				</div>
			</div>

			</form>

			<form method="post" class="formulier">
			
			<div class="row">
				<div class="col-md-1">	
				</div>
				<div class="col-md-11">
					<legend>Admin login</legend>
					<?php if(isset($erroradmin)): ?>
						<div class="error"><br/>
					<?php echo $erroradmin;?>
						</div>
					<?php endif; ?>
					<?php if(isset($succes)): ?>
						<div class="feedback">
					<?php echo $succes;?>
						</div>
					<?php endif; ?>
					<br/>
				</div>
			</div>

			<div class="row">
				<div class="col-md-1">	
				</div>
				<div class="col-md-2">
					<label for="email">Email:</label>
				</div>
				<div class="col-md-9">
					<input type="text" id="email" name="email" placeholder="email" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-1">	
				</div>
				<div class="col-md-2">
					<label for="password">Password:</label>
				</div>
				<div class="col-md-9">
					<input type="password" id="password" name="password" placeholder="password" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-3">	
				</div>
				<div class="col-md-9">
					<input class="submit" type="submit" value="Login" name="AdminLogin" />
				</div>
			</div>

			</form> 
       	</div>
       	
       	<!-- 2de formulier begint hier -->
       	
       	<div class="col-md-6">
		    <div class="col-md-12">
   			
   			<form method="post" action="" enctype="multipart/form-data" class="formulier">
			
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
					<input type="text" id="firstname" name="firstname" placeholder="voornaam" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<label for="lastname">Achternaam</label> *<br/>
				</div>
				<div class="col-md-8">
					<input type="text" id="lastname" name="lastname" placeholder="achternaam" />
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
