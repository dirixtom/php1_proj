<?php

	include_once("Db.class.php");
	class Boeking
	{
		
		private $m_sdatum;
		private $m_sbuddy;
		private $m_sstudent;
		private $m_sId;

		public function __set($p_sProperty, $p_sValue)
		{
			switch ($p_sProperty) 
			{
				
				case 'Datum':
					$this->m_sdatum = $p_sValue;
					break;

				case 'Buddy':
					$this->m_sbuddy = $p_sValue;
					break;

				case 'Student':
					$this->m_sstudent = $p_sValue;
					break;

				case 'Id':
					$this->m_sId = $p_sValue;
					break;
			}
		}

		public function __get($p_sProperty)
		{
			switch ($p_sProperty) 
			{
				case 'Datum':
					return $this->m_sdatum;
					break;

				case 'Buddy':
					return $this->m_sbuddy;
					break;

				case 'Student':
					return $this->m_sstudent;
					break;

				case 'Id':
					return $this->m_sId;
					break;
			}
		}

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

		public function nieuweBoeking() 
			{
				$conn = Db::getInstance();
				$statement = $conn->prepare("INSERT INTO tblboekingen (datumID, buddieID, studentID) VALUES (:datumID, :buddieID, :studentID)");
				$statement->bindValue(':datumID', $this->Datum);
				$statement->bindValue(':buddieID', $this->Buddy);
				$statement->bindValue(':studentID', $this->Student);
				$statement->execute();
			}	
		
		public function deleteBoeking() 
			{
				$conn = Db::getInstance();
				//$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$statement = $conn->prepare("DELETE FROM tblboekingen WHERE boekingID = :id");
				$statement->bindValue(':id', $this->Id );
				$statement->execute();

				header("Location: bezoekerBoekingen.php");
			}
	}
?>