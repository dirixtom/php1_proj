<?php

	include_once("Db.class.php");
	class Reacties
	{
		
		public function getAllReacties()
			{
				//alle reacties returnen
				$conn = Db::getInstance();
				$allReacties = $conn->query("SELECT * FROM reacties");
				return $allReacties;
			}

		public function getRecentReacties()
			{
				//recentste reacties returnen
				$conn = Db::getInstance();
				$allReacties = $conn->query("SELECT * FROM reacties LIMIT 2");
				return $allReacties;
			}
	}
?>
	