<?php 

	include_once("Db.class.php");
	
	class Admin
	{
		
		private $m_sUsername;
		private $m_sPassword;
		private $m_sId;

		public function __set($p_sProperty, $p_sValue)
		{
			switch ($p_sProperty) 
			{
				case 'Username':
					if(empty($p_sValue))
						{
							throw new Exception("Username cannot be empty");
						}
					else 
						{
							$this->m_sUsername = $p_sValue;
						};
					//$this->m_sUsername = $p_sValue;
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
					//$this->m_sPassword = $p_sValue;
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
				case 'Username':
					return $this->m_sUsername;
					break;

				case 'Password':
					return $this->m_sPassword;
					break;

				case 'Id':
					return $this->m_sId;
					break;

			}
		}

		public function CreateAccount()
		{

			$conn = Db::getInstance();
			//$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$statement = $conn->prepare("INSERT INTO adminlogin
				(username, password) 
				VALUES 
				(:username, :password)");
			$statement->bindValue(':username', $this->Username );
			$statement->bindValue(':password', $this->Password );
			$statement->execute();

			//header('Location:adminaccounts.php');

		}

		public function DeleteAccount()
		{

			$conn = Db::getInstance();
			//$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$statement = $conn->prepare("DELETE FROM adminlogin WHERE id = :id");
			$statement->bindValue(':id', $this->Id );
			$statement->execute();

			header('Location:adminaccounts.php');

		}

		public function Login()
		{
		
        	$conn = Db::getInstance();
			$statement = $conn->prepare("SELECT id FROM adminlogin WHERE username = :username AND password = :password");
			$statement->bindValue(':username', $this->Username );
			$statement->bindValue(':password', $this->Password );
			$statement->execute();
			$rows = $statement->fetchAll();
			$row = count($rows);

			if($row == 1) 
			{				
				session_start();
				$_SESSION["username"] = $this->Username;
				header("Location: admindashboard.php");
			}
			else
			{
				echo "Wrong username or password!";
			}

		}

		public function ShowAccounts()
		{
			//alle accounts returnen
			$conn = Db::getInstance();
			$allAcc = $conn->query("SELECT * FROM adminlogin");
			return $allAcc;

			header('Location:adminaccounts.php');
		}
	}
?>