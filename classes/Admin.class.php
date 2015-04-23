<?php 

	include_once("Db.class.php");
	
	class Admin
	{
		
		private $m_sUsername;
		private $m_sEmail;
		private $m_sPassword;
		private $m_sId;

		public function __set($p_sProperty, $p_sValue)
		{
			switch ($p_sProperty) 
			{
				case 'Username':
					if(empty($p_sValue))
						{
							throw new Exception("Gebruikersnaam mag niet leeg zijn");
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
							throw new Exception("Wachtwoord mag niet leeg zijn");
						}
					else 
						{
							$this->m_sPassword = $p_sValue;
						};
					//$this->m_sPassword = $p_sValue;
					break;

				case 'Email':
					if(empty($p_sValue))
						{
							throw new Exception("Email mag niet leeg zijn");
						}
					else 
						{
							$this->m_sEmail = $p_sValue;
						};
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

				case 'Email':
					return $this->m_sEmail;
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
			$statement = $conn->prepare("INSERT INTO tbladmin
				(adminEmail, adminPassword) 
				VALUES 
				(:email, :password)");
			$statement->bindValue(':email', $this->Email );
			$statement->bindValue(':password', $this->Password );
			$statement->execute();

		}

		public function DeleteAccount()
		{

			$conn = Db::getInstance();
			//$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$statement = $conn->prepare("DELETE FROM tbladmin WHERE adminID = :id");
			$statement->bindValue(':id', $this->Id );
			$statement->execute();

			header('Location:adminaccounts.php');

		}

		public function Login()
		{
		
        	$conn = Db::getInstance();
			$statement = $conn->prepare("SELECT adminID FROM tbladmin WHERE adminEmail = :email AND adminPassword = :password");
			$statement->bindValue(':email', $this->Email );
			$statement->bindValue(':password', $this->Password );
			$statement->execute();
			$rows = $statement->fetchAll();
			$row = count($rows);

			if($row == 1) 
			{				
				session_start();
				$_SESSION["email"] = $this->Email;
				header("Location: admindashboard.php");
			}
			else
			{
				throw new Exception("Verkeerde email of wachtwoord!");
			}

		}

		public function ShowAccounts()
		{
			//alle accounts returnen
			$conn = Db::getInstance();
			$allAcc = $conn->query("SELECT * FROM tbladmin");
			return $allAcc;

			header('Location:adminaccounts.php');
		}
	}
?>