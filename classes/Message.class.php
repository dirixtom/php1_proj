<?php
	include_once("Db.class.php");

	class Message
	{
		private $m_sText;
		private $m_sUser;

		public function setText($p_sValue)
		{
			$this->m_sText = $p_sValue;
		}

		public function setUser($p_sValue)
		{
			$this->m_sUser = $p_sValue;
		}

		public function getText()
		{
			return $this->m_sText;
		}

		public function getUser()
		{
			return $this->m_sUser;
		}

		public function Save()
		{
			$db = Db::getInstance();
			$stmt = $db->prepare("INSERT INTO tblmessages (user, message) VALUES (:user, :message)");
			$stmt->bindValue(':user', $this->m_sUser);
			$stmt->bindValue(':message', $this->m_sText);
			$stmt->execute();
		}

		public function showAll()
		{
			return Db::getInstance()->query("select * from tblmessages;");
		}

	}


?>