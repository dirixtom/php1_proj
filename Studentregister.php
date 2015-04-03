<?php

	include_once("classes/Student.class.php");

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
			$s->Save();

			$succes = "Account is aangemaakt!";

		}
		catch(Exception $e)
		{
			$error = $e->getMessage();
		}
	}

?><html>
<head>
	<title>Studenten registratie</title>
</head>
<body>
	<div class="container-fluid">
		
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-5">
				<h2>Admin accounts toevoegen</h2>

				<?php if(isset($succes)): ?>
		            <div class="success">
		                <?php echo $succes;?>
		            </div>
		        <?php endif; ?>

				<?php if(isset($error)): ?>
					<div class="error">
						<?php echo $error;?>
					</div>
				<?php endif; ?>
			
			</div>
			<div class="col-md-5">	
			</div>
		</div>

	<form method="post" action="" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-1">
				<label for="firstname">Voornaam</label><br/>
			</div>
			<div class="col-md-10">	
				<input type="text" id="firstname" name="firstname" placeholder="voornaam" />
			</div>
		</div>
		<br /> <!-- tijdelijk -->
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-1">
				<label for="lastname">Achternaam</label><br/>
			</div>
			<div class="col-md-10">	
				<input type="text" id="lastname" name="lastname" placeholder="achternaam" />
			</div>
		</div>
		<br /> <!-- tijdelijk -->
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-1">
				<label for="year">Klas</label><br />
			</div>
			<div class="col-md-10">	
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
		<br /> <!-- tijdelijk -->
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-1">
				<label for="twitter">Twitter</label><br/>
			</div>
			<div class="col-md-10">	
				<input type="text" id="twitter" name="twitter" placeholder="twitter" />
			</div>
		</div>
		<br /> <!-- tijdelijk -->
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-1">
				<label for="email">Email</label><br/>
			</div>
			<div class="col-md-10">	
				<input type="text" id="email" name="email" placeholder="email" />
			</div>
		</div>
		<br /> <!-- tijdelijk -->
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-1">
				<label for="password">Wachtwoord</label><br />
			</div>
			<div class="col-md-10">	
				<input type="password" id="password" name="password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" />
			</div>
		</div>
		<br /> <!-- tijdelijk -->
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-1">
				<label for="cpassword">Verifieer Wachtwoord</label><br />
			</div>
			<div class="col-md-10">	
				<input type="password" id="cpassword" name="cpassword" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" />
			</div>
		</div>
		<br /> <!-- tijdelijk -->
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-1">
				<label for="fileToUpload">Foto</label><br />
			</div>
			<div class="col-md-10">	
				<input type="file" name="fileToUpload" id="fileToUpload" />
			</div>
		</div>
		<br /> <!-- tijdelijk -->
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-2">
				<input class="submit" type="submit" value="Registreer" name='register'/>
			</div>
			<div class="col-md-9">	
			</div>
		</div>	
	</form>


</body>
</html>