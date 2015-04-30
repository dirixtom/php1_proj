<?php
	include_once("Db.class.php");

	class Message
	{
		private $m_sText;

		public function setText($p_sValue)
		{
			$this->m_sText = $p_sValue;
		}

		public function getText()
		{
			return $this->m_sText;
		}

		public function Create()
		{
			$db = Db::getInstance();
			$stmt = $db->prepare("INSERT INTO tblmessages (messageText) VALUES (:message");
			$stmt->bindValue(':message', $this->m_sText);
			$stmt->execute();
		}

		public function GetAllMessages()
		{
			return Db::getInstance()->query("select * from tblmessages;");
		}

	}


?>