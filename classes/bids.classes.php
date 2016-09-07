<?php
	
	class bid
	{
		protected $db = null;

		public function __construct($db){
			$this->db = $db;
		}

		public function addBid($watchID, $userID, $amount){
			$status = "Open";
			try{
				$query = "INSERT INTO bids (auctionID, buyerID, amount, status) VALUES (:watchID, :buyerID, :amount, :status)";
				$pdo = $this->db->prepare($query);
				$pdo->bindparam(':watchID', $watchID);
		       	$pdo->bindparam(':buyerID', $userID);
		       	$pdo->bindparam(':amount', $amount);
		       	$pdo->bindparam(':status', $status);
		       	$pdo->execute();
		       	echo "Success";
		       }catch(PDOException $e){
					echo $e->getMessage();
				}
		}

		public function getBidsFromID($id){
			try{
				$query = "SELECT * FROM bids WHERE auctionID = :id AND status = 'Open' ";
				$pdo = $this->db->prepare($query);
				$pdo->bindparam(':id', $id);
		       	$pdo->execute();
		     

		       	if ($pdo->rowCount() > 0) {
		       		$result = $pdo->fetchAll();
				  	echo json_encode($result);
				} else {
				   echo 'nothing';
				}
		    
		    }catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		public function getBidsFromUserID($id){
			try{
				$query = "SELECT * FROM bids WHERE buyerID = :id";
				$pdo = $this->db->prepare($query);
				$pdo->bindparam(':id', $id);
		       	$pdo->execute();
		     

		       	if ($pdo->rowCount() > 0) {
		       		$result = $pdo->fetchAll();
				  	echo json_encode($result);
				} else {
				   echo 'nothing';
				}
		    
		    }catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		public function declineBid($id){
			$status = 'Declined';
			try{
				$query = "UPDATE bids SET status = :status WHERE ID = :id";
				$pdo = $this->db->prepare($query);
		       	$pdo->bindparam(':status', $status);
		       	$pdo->bindparam(':id', $id);
		       	$pdo->execute();
		       	echo "Success";
		       }catch(PDOException $e){
					echo $e->getMessage();
				}
		}

		public function cancelBid($id){
			$status = 'Cancelled';
			try{
				$query = "UPDATE bids SET status = :status WHERE ID = :id";
				$pdo = $this->db->prepare($query);
		       	$pdo->bindparam(':status', $status);
		       	$pdo->bindparam(':id', $id);
		       	$pdo->execute();
		       	echo "Success";
		       }catch(PDOException $e){
					echo $e->getMessage();
				}
		}

		public function acceptBid($id){
			$status = 'Accepted';
			try{
				$query = "UPDATE bids SET status = :status WHERE ID = :id";
				$pdo = $this->db->prepare($query);
		       	$pdo->bindparam(':status', $status);
		       	$pdo->bindparam(':id', $id);
		       	$pdo->execute();
		       	echo "Success";
		       }catch(PDOException $e){
					echo $e->getMessage();
				}
		}

		public function cascadeDecline($bidID, $auctionID){
			$status = 'Declined';
			try{
				$query = "UPDATE bids SET status = :status WHERE auctionID = :auctionID AND status = 'Open'";
				$pdo = $this->db->prepare($query);
		       	$pdo->bindparam(':status', $status);
		       	$pdo->bindparam(':auctionID', $auctionID);
		       	$pdo->execute();
		       	echo "Success";
		       }catch(PDOException $e){
					echo $e->getMessage();
				}
		}

		
	}


?>

