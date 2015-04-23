<?php

	include_once("Db.class.php");
	class Reacties
	{
		
		private $m_sId;

		public function __set($p_sProperty, $p_sValue)
		{
			switch ($p_sProperty) 
			{
				
				case 'Id':
					$this->m_sId = $p_sValue;
					break;
			}
		}

		public function __get($p_sProperty)
		{
			switch ($p_sProperty) 
			{
				
				case 'Id':
					return $this->m_sId;
					break;

			}
		}

		public function getAllReacties()
			{
				//alle reacties returnen
				$conn = Db::getInstance();
				$allReacties = $conn->query("SELECT * FROM tblreacties");
				return $allReacties;
			}

		public function getRecentReacties()
			{
				//recentste reacties returnen
				$conn = Db::getInstance();
				$allReacties = $conn->query("SELECT * FROM tblreacties LIMIT 2");
				return $allReacties;
			}

		public function DeleteReactie()
		{

			$conn = Db::getInstance();
			//$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$statement = $conn->prepare("DELETE FROM tblreacties WHERE reactiesID = :id");
			$statement->bindValue(':id', $this->Id );
			$statement->execute();

			header('Location:adminreacties.php');

		}
	}
?>