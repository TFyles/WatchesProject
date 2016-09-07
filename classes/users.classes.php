<?php
	
	
	class user
	{
		protected $db = null;

		public function __construct($db){
			$this->db = $db;
		}

		public function addUser($username, $password, $email, $role){
			try{

				$query = "SELECT COUNT(*) from users WHERE username = :username LIMIT 1";
				$pdo = $this->db->prepare($query);
				$pdo->bindparam(':username', $username);
	        	$pdo->execute();
	        	$result = $pdo->fetch();
	        	$result = array_values($result);
	        	$result = $result[0];

	        	//If no link exist add link(tf)
	        	
	        	if($result == 0){
		        	$query = "INSERT INTO users (username, password, email, role) VALUES (:username, :password, :email, :role)";
					$pdo = $this->db->prepare($query);
					$pdo->bindparam(':username', $username);
			       	$pdo->bindparam(':password', $password);
			       	$pdo->bindparam(':email', $email);
			       	$pdo->bindparam(':role', $role);
			       	$pdo->execute();
			       	$this->sendWelcome($username,$email);
			       	echo "Success";
	        	} else{
	        		echo "exists";
	        		die();
	        	}

		       }catch(PDOException $e){
					echo $e->getMessage();
				}
		}

		public function login($username, $password){
			
			try{
				$query = "SELECT password FROM users WHERE username = :username";
				$pdo = $this->db->prepare($query);
				$pdo->bindparam(':username', $username);
		       	$pdo->execute();
		       	$hash = $pdo->fetch();
		       	$hashedPass = $hash['password'];
		       	
		     	if (password_verify($password, $hashedPass)) {
		     		/* Dont return password via JSON for security reasons, password is only required in back end (TF) */
				    $query2 = "SELECT ID, username, role, profilePic  FROM users WHERE username = :username";
				    $pdo2 = $this->db->prepare($query2);
					$pdo2->bindparam(':username', $username);
		       		$pdo2->execute();
		       		$resultArray = $pdo2->fetch();
		       		$sessionID = session_id();
		       		$resultArray['sessionID'] = $sessionID;
		       		$result2 = json_encode($resultArray);      	 
		       		$_SESSION['login_user']= $username;
		       		$_SESSION['session-id']= $sessionID;
		       		echo $result2;
		       		
				} else {
					echo "Invalid";
				}
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		public function getProfileFromID($id){
			try {
				/* Dont return password via JSON for security reasons, password is only required in back end (TF) */
				$query = "SELECT ID, username, role, email, profilePic FROM users WHERE ID = :id ";
				$pdo = $this->db->prepare($query);
				$pdo->bindparam(':id', $id);
		       	$pdo->execute();
		     

		       	if ($pdo->rowCount() > 0) {
		       		$result = $pdo->fetch();
				  	echo json_encode($result);
				} else {
				   echo 'nothing';
				}
		    
		    }catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		public function getNameFromID($id){
			try {
				$query = "SELECT username FROM users WHERE ID = :id ";
				$pdo = $this->db->prepare($query);
				$pdo->bindparam(':id', $id);
		       	$pdo->execute();
		     	$result = $pdo->fetch();
		     	return $result;

		     
		    
		    }catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		public function addProfilePic($id, $pathtoImage){
			try{
				$query = "UPDATE users SET profilePic = :pic WHERE ID = :ID";
				$pdo = $this->db->prepare($query);
				$pdo->bindparam(':ID', $id);
			    $pdo->bindparam(':pic', $pathtoImage);
			    $pdo->execute();
			    echo "Success";
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		public function sendWelcome($username, $email){
			//built using PHPMailer based on the tutorial at http://www.sitepoint.com/sending-emails-php-phpmailer/ (tf)
			$mail = new PHPMailer;
			$mail->From = "fylt1_13@uni.worc.ac.uk";
			$mail->FromName = "Tom Fyles";
			$mail->addAddress($email);
			$mail->isHTML(true);
			$mail->Subject = "Welcome to Wallys-Watches";
			$mail->Body = "<p> Thanks for signing up " . $username ." </p><br>
						   <p> Get started buying and selling now at </p><br>
						   <a href='http://wallys-watches.fyles.worcestercomputing.com/#/auction/buy' > Wallys Watches </a>
						  " ;
				if(!$mail->send()) 
				{
				    echo "Mailer Error: " . $mail->ErrorInfo;
				} 
		}	
	}


?>