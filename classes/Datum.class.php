<?php
	
	include_once("classes/Db.class.php");

	class Datum 
	{

		private $m_sDag;
		private $m_sMaand;
		private $m_sJaar;
		private $m_sId;

		public function __set($p_sProperty, $p_sValue)
		{
			switch ($p_sProperty) 
			{
				case 'Dag':
					/*if(empty($p_sValue))
						{
							throw new Exception("Username cannot be empty");
						}
					else 
						{
							$this->m_sUsername = $p_sValue;
						};*/
					$this->m_sDag = $p_sValue;
					break;

				case 'Maand':
					$this->m_sMaand = $p_sValue;
					break;

				case 'Jaar':
					$this->m_sJaar = $p_sValue;
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
				case 'Dag':
					return $this->m_sDag;
					break;

				case 'Maand':
					return $this->m_sMaand;
					break;

				case 'Jaar':
					return $this->m_sJaar;
					break;

				case 'Id':
					return $this->m_sId;
					break;

			}
		}

		public function SaveDate()
		{

			$conn = Db::getInstance();
			//$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$statement = $conn->prepare("INSERT INTO tbldatums
				(datumDag, datumMaand, datumJaar) 
				VALUES 
				(:dag, :maand, :jaar)");
			$statement->bindValue(':dag', $this->Dag );
			$statement->bindValue(':maand', $this->Maand );
			$statement->bindValue(':jaar', $this->Jaar );
			$statement->execute();

			//header('Location:admindatums.php');			

		}

		public function DeleteDate()
		{

			$conn = Db::getInstance();
			//$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$statement = $conn->prepare("DELETE FROM tbldatums WHERE datumID = :id");
			$statement->bindValue(':id', $this->Id );
			$statement->execute();

			header('Location:admindatums.php');

		}

		public function ShowDate()
		{
			//alle accounts returnen
			$conn = Db::getInstance();
			$allDates = $conn->query("SELECT * FROM tbldatums");
			return $allDates;
		}

		public function ShowRecentDate()
		{
			//alle accounts returnen
			$conn = Db::getInstance();
			$allDates = $conn->query("SELECT * FROM tbldatums LIMIT 3");
			return $allDates;
		}

	}

?>