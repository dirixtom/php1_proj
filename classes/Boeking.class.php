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

		public function getRecentBoekingen()
			{
				//recentste boekingen returnen
				$conn = Db::getInstance();
				$allBoekings = $conn->query("SELECT * FROM boekingen LIMIT 3");
				return $allBoekings;
			}
	}
?>
	