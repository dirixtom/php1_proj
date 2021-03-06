<?php
	
	include_once("Db.class.php");
	
	class Student
	{
		
		private $m_sFirstname;
		private $m_sLastname;
		private $m_sYear;
		private $m_sSubject;
		private $m_sTwitter;
		private $m_sEmail;
		private $m_sPassword;
		private $m_sCPassword;
		private $m_sPicture;
		private $m_sId;

		public function __set($p_sProperty, $p_vValue)
		{
			switch ($p_sProperty) 
			{
				case 'Firstname':
					if(empty($p_vValue))
						{
							throw new Exception("Voornaam moet ingevuld zijn");
						}
					else
						{
							if (preg_match('/^[a-zA-Z ]*$/', $p_vValue))
							{
								$this->m_sFirstname = htmlspecialchars($p_vValue);
							}
							else
							{
								throw new Exception("Voornaam mag enkel uit letters en spaties bestaan");
								
							}
						};
					break;

				case 'Lastname':
					if(empty($p_vValue))
						{
							throw new Exception("Achternaam moet ingevuld zijn");
						}
					else 
						{
							if (preg_match('/^[a-zA-Z ]*$/', $p_vValue))
							{
								$this->m_sLastname = htmlspecialchars($p_vValue);
							}
							else
							{
								throw new Exception("Achternaam mag enkel uit letters en spaties bestaan");
								
							}
						};
					break;

				case 'Year':
					$this->m_sYear = $p_vValue;
					break;

				case 'Subject':
					$this->m_sSubject = $p_vValue;
					break;

				case 'Twitter':
					if(empty($p_vValue))
						{
							throw new Exception("Twitter moet ingevuld zijn");
						}
					else 
						{
							if (preg_match('/@([A-Za-z0-9_]{1,15})/', $p_vValue))
							{
								$this->m_sTwitter = htmlspecialchars($p_vValue);
							}
							else
							{
								throw new Exception("Ongeldig Twitter formaat");
								
							}
						};
					break;

				case 'Email':
					if(empty($p_vValue))
						{
							throw new Exception("Email moet ingevuld zijn");
						}
					else 
						{
							if (!filter_var($p_vValue, FILTER_VALIDATE_EMAIL)) {
  								throw new Exception("Ongeldig e-mail formaat");
  							}
  							else
  							{
  								$this->m_sEmail = htmlspecialchars($p_vValue);
  							}
						};
					break;

				case 'Password':
					if(empty($p_vValue))
						{
							throw new Exception("Wachtwoord moet ingevuld zijn");
						}
					else 
						{
							$options = array('cost' => 11);
                    		$this->m_sPassword = password_hash($p_vValue, PASSWORD_BCRYPT, $options);
						};
					break;

				case 'CPassword':
					if(empty($p_vValue))
						{
							throw new Exception("Wachtwoord verificatie moet ingevuld zijn");
						}
					else 
						{
							$options = array('cost' => 11);
                    		$this->m_sCPassword = password_hash($p_vValue, PASSWORD_BCRYPT, $options);
						};
					break;

				case 'Picture':
                    if ($p_vValue!="")
	                    {
	                        $this->m_sPicture = $p_vValue;
	                    }
                    else
	                    {
	                        $this->m_sPicture = null;
	                    }
                    break;


				case 'Id':
					$this->m_sId = $p_vValue;
					break;
			}
		}

		public function __get($p_sProperty)
		{
			switch ($p_sProperty) 
			{
				case 'Firstname':
					return $this->m_sFirstname;
					break;

				case 'Lastname':
					return $this->m_sLastname;
					break;

				case 'Year':
					return $this->m_sYear;
					break;

				case 'Subject':
					return $this->m_sSubject;
					break;

				case 'Twitter':
					return $this->m_sTwitter;
					break;

				case 'Email':
					return $this->m_sEmail;
					break;

				case 'Password':
					return $this->m_sPassword;
					break;

				case 'CPassword':
					return $this->m_sCPassword;
					break;

				case 'Picture':
					return $this->m_sPicture;
					break;

				case 'Id':
					return $this->m_sId;
					break;

			}
		}

		/*public function Login()
		{

        	$conn = Db::getInstance();
			$statement = $conn->prepare("SELECT * FROM tblbuddies WHERE buddieEmail = :email AND buddiePassword = :password");
			$statement->bindValue(':email', $this->Email);
			$statement->bindValue(':password', $this->Password);
			$statement->execute();
			$rows = $statement->fetchAll();
			$row = count($rows);

			if($row === 1) 
			{				
				session_start();
				$_SESSION["buddyemail"] = $this->Email;
				header("Location: studentDashboard.php");
			}
			else
			{
				throw new Exception("Het wachtwoord hoort niet bij deze email");
			}

		}*/

		public function checkPassword($value1, $value2)
	    {
	        if ($value1 != $value2)
	        {
	            throw new Exception("De wachtwoorden komen niet overeen.");
	        }
	    }

		public function Save()
		{

			$conn = Db::getInstance();
			//$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$statement = $conn->prepare("INSERT INTO tblbuddies
				(buddieNaam, buddieVoornaam, buddieTwitter, buddieEmail, buddiePassword, buddieJaar, buddieRichting, buddieFoto) 
				VALUES 
				(:lastname, :firstname, :twitter, :email, :password, :year, :subject, :fileToUpload)");
			$statement->bindValue(':lastname', $this->Lastname);
			$statement->bindValue(':firstname', $this->Firstname);
			$statement->bindValue(':twitter', $this->Twitter);
			$statement->bindValue(':email', $this->Email);
			$statement->bindValue(':password', $this->Password);
			$statement->bindValue(':year', $this->Year);
			$statement->bindValue(':subject', $this->Subject);
			$statement->bindValue(':fileToUpload', $this->Picture);
			$statement->execute();

			header("Location: login.php");

		}

		public function UpdateAccount()
		{

			$conn = Db::getInstance();
			$statement = $conn->prepare("UPDATE tblbuddies SET buddieTwitter = :twitter,
																buddiePassword = :password
															    WHERE buddieID = :id
										");
			$statement->bindValue(':twitter', $this->Twitter);
			$statement->bindValue(':password', $this->Password);
			$statement->bindValue(':id', $this->Id );
			//$statement->bindValue(':fileToUpload', $this->Picture);
			//$statement->bindValue(':email', $this->Email);
			$statement->execute();

			//header('Location:studentAccount.php');

		}

		public function UpdateImage()
		{

			$conn = Db::getInstance();
			$statement = $conn->prepare("UPDATE tblbuddies SET buddieFoto = :fileToUpload
															    WHERE buddieID = :id
										");
			$statement->bindValue(':id', $this->Id );
			$statement->bindValue(':fileToUpload', $this->Picture);
			$statement->execute();

			header('Location:studentAccount.php');

		}

		public function DeleteAccount()
		{

			$conn = Db::getInstance();
			//$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$statement = $conn->prepare("DELETE FROM tblbuddies WHERE buddieID = :id");
			$statement->bindValue(':id', $this->Id );
			$statement->execute();

			header('Location:login.php');

		}
		
		public function DeleteImage()
		{

			$conn = Db::getInstance();
			//$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$statement = $conn->prepare("UPDATE tblbuddies SET buddieFoto = :foto WHERE buddieID = :id");
			$statement->bindValue(':id', $this->Id );
			$statement->bindValue(':foto', $this->Foto );
			$statement->execute();

			header('Location:Studentaccount.php');

		}

		public function ShowAccount()
		{
			//informatie van account returnen
			$conn = Db::getInstance();
			$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$showAcc = $conn->query("SELECT * FROM tblbuddies WHERE buddieEmail ='" . $_SESSION['buddyemail'] . "'");
			return $showAcc;
		}

		public function GetAllStudents()
		{
			//alle accounts returnen
			$conn = Db::getInstance();
			$allStudents = $conn->query("SELECT * FROM tblbuddies");
			return $allStudents;
		}

		public function GetStudentsIndex()
		{
			//alle accounts returnen
			$conn = Db::getInstance();
			$allStudents = $conn->query("SELECT * FROM tblbuddies LIMIT 3");
			return $allStudents;
		}

		public function GetAllFB()
		{
			//alle accounts returnen
			$conn = Db::getInstance();
			$allStudents = $conn->query("SELECT * FROM tblstudenten");
			return $allStudents;
		}

		
	}
?>