<?php 
include_once("classes/Db.class.php");
include_once("classes/Datum.class.php");

$d = new Datum();
$data = $d->ShowDate();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>student Boeking</title>
</head>
<body>
<h2>Welkom, (student)</h2>
<h1>Hier kan je je Buddie reserveren!</h1>
<form action="" method="post">
	<label for="datum">Gelieve de gewenste datum door te geven</label>
	<select required name="datum" id="datum">
			<option value="0"> Kies je datum </option>
		<?php foreach ($data as $d): ?>
			<option value="<?php echo $d['Id'] ;?>"><?php echo $d['datumDag'] . " " . $d['datumMaand'] . " " . $d['datumJaar'] ;?></option>
		<?php endforeach;?>
	</select>
	<br />
	<label for="Buddy">Kies hier je gewenste buddy:</label>
	<ul>
		<li class="buddy">
			<img src="" alt="buddyPhoto"/>
			<h3>Naam buddy</h3>
			<h4>Richting (design, development)</h4>
			<input type="radio">

		</li>
	</ul>
<button type="submit">Boeken</button>
</form>
  

</body>
</html>