<?php

	include_once("Db.class.php");
	class Boeking
	{
		
		public function getAllBoekingen()
			{
				//alle boekingen returnen
				$conn = Db::getInstance();
				$allBoekings = $conn->query("SELECT * FROM boekingen");
				return $allBoekings;
			}
	}
?>
	