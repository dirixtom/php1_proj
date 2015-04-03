<?php
	session_start();

	include_once("Db.class.php");
	class Login
	{
		
		private $m_sEmail;
		private $m_sPassword;

		public function __set($p_sProperty, $p_sValue)
		{
			switch ($p_sProperty) 
			{
				case 'Email':
					if(empty($p_sValue))
						{
							throw new Exception("Email cannot be empty");
						}
					else 
						{
							$this->m_sEmail = $p_sValue;
						};
					break;

				case 'Password':
					if(empty($p_sValue))
						{
							throw new Exception("Password cannot be empty");
						}
					else 
						{
							$this->m_sPassword = $p_sValue;
						};
					break;
			}
		}

		public function __get($p_sProperty)
		{
			switch ($p_sProperty) 
			{
				case 'Email':
					return $this->m_sEmail;
					break;

				case 'Password':
					return $this->m_sPassword;
					break;

			}
		}

		public function StudentLogin()
		{
		
        	$conn = Db::getInstance();
        	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$statement = $conn->prepare("SELECT * FROM tblbuddies WHERE buddieEmail = :email AND buddiePassword = :password");
			$statement->bindValue(':email', $this->Email );
			$statement->bindValue(':password', $this->Password );
			$statement->execute();

			$rows = $statement->fetchAll();
			$row = count($rows);

			if($row == 1) 
			{				
				$_SESSION["Email"] = $this->Email;
				header("Location: student.php");
			}
			else
			{
				throw new Exception("Verkeerde email of wachtwoord");
				
			}
		}
	}
?>