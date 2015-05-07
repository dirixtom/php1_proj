<?php

	include_once("Db.class.php");
	class Boeking
	{
		
		public function getAllBoekingen()
			{
				//alle boekingen returnen
				$conn = Db::getInstance();
				$allBoekings = $conn->query("SELECT * FROM tblboekingen INNER JOIN tblbuddies ON tblboekingen.buddieID= tblbuddies.buddieID INNER JOIN tbldatums ON tblboekingen.datumID= tbldatums.datumID INNER JOIN tblstudenten ON tblboekingen.studentID = tblstudenten.studentID");
				return $allBoekings;
			}

		public function getRecentBoekingen()
			{
				//recentste boekingen returnen
				$conn = Db::getInstance();
				$allBoekings = $conn->query("SELECT * FROM tblboekingen INNER JOIN tblbuddies ON tblboekingen.buddieID= tblbuddies.buddieID INNER JOIN tbldatums ON tblboekingen.datumID= tbldatums.datumID INNER JOIN tblstudenten ON tblboekingen.studentID = tblstudenten.studentID");
				return $allBoekings;
			}

		public function annuleerBoeking() {
			$conn = Db::getInstance();
			$statement = $conn->prepare("UPDATE tblboekingen SET active = 'false' WHERE buddieID = :id");
			$statement->bindValue(':id', $this->Id );
			$statement->execute();
		}

		public function nieuweBoeking() {
			$conn = Db::getInstance();
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$statement = $conn->prepare("INSERT INTO tblboekingen ( datumID, 
																		studentID, 
																		buddieID,
																		
										 VALUES (:datumID,
												 :studentID,
												 :buddieID,
												 )");
			$statement->bindValue(':datumID', $this->datumID);
			$statement->bindValue(':studentID', $this->studentID);
			$statement->bindValue(':student_radio_id', $this->buddieID);
			$statement->execute();

		}	
		// als code wordt geschreven om te boeken zet dan het veld 'active' op true 
		// -> kijk hier onder hoe en vervang false door true.

		
	}
?>
	