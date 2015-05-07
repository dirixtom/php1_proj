<?php

	include_once("Db.class.php");
	class Boeking
	{
		
		public function getAllBoekingen()
			{
				//alle boekingen returnen
				$conn = Db::getInstance();
				$allBoekings = $conn->query("SELECT * FROM tblboekingen");
				return $allBoekings;
			}

		public function getRecentBoekingen()
			{
				//recentste boekingen returnen
				$conn = Db::getInstance();
				$allBoekings = $conn->query("SELECT * FROM tblboekingen LIMIT 3");
				return $allBoekings;
			}
		// als code wordt geschreven om te boeken zet dan het veld 'active' op true 
		// -> kijk hier onder hoe en vervang false door true.

		public function annuleerBoeking() {
			$conn = Db::getInstance();
			$statement = $conn->prepare("UPDATE tblboekingen SET active = 'false' WHERE buddieID = :id");
			$statement->bindValue(':id', $this->Id );
			$statement->execute();
		}
	}
?>
	