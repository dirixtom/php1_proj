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
							if (preg_match('/^[a-zA-Z0-9]/', $p_vValue))
							{
								$this->m_sPassword = htmlspecialchars($p_vValue);
							}
							else
							{
								throw new Exception("Wachtwoord mag enkel uit letters en nummers bestaan");
								
							}
						};
					break;

				case 'CPassword':
					if(empty($p_vValue))
						{
							throw new Exception("Wachtwoord verificatie moet ingevuld zijn");
						}
					else 
						{
							$this->m_sCPassword = htmlspecialchars($p_vValue);
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

		public function checkPassword()
		{
			if($this->m_sPassword != $this->m_sCPassword)
			{
				return false;
			}
			else
			{
				return true;
			}
		}

		public function Login()
		{
		
        	$conn = Db::getInstance();
			$statement = $conn->prepare("SELECT buddieID FROM tblbuddies WHERE buddieEmail = :email AND buddiePassword = :password");
			$statement->bindValue(':email', $this->Email);
			$statement->bindValue(':password', $this->Password);
			$statement->execute();
			$rows = $statement->fetchAll();
			$row = count($rows);

			if($row == 1) 
			{				
				session_start();
				$_SESSION["username"] = $this->Username;
				header("Location: www.tomdirix.be");
			}
			else
			{
				throw new Exception("Het wachtwoord hoort niet bij deze email");
			}

		}

		public function Save()
		{
			if(!$this->checkPassword())
			{
				throw new Exception("De wachtwoorden komen niet overeen.");
			}

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

			header('Location:Studentlogin.php');

		}
	}
?>
