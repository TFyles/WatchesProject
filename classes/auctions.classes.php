<?php
	
	class auction
	{
		protected $db = null;


		/* Accessing database based on week19 oophp activity (TF) */
		public function __construct($db){
			$this->db = $db;
		}

		public function addAuction($user, $brand, $model, $year, $movement, $strap, $price, $desc, $end_date){
			try{
				$query = "INSERT INTO auctions (user_ID, brand, model, year, movement, strap, price, description, end_date) VALUES (:uID, :brand, :model, :year, :movement, :strap, :price, :description, :end_date)";
				$pdo = $this->db->prepare($query);
				$pdo->bindparam(':uID', $user);
		       	$pdo->bindparam(':brand', $brand);
		       	$pdo->bindparam(':model', $model);
		       	$pdo->bindparam(':year', $year);
		       	$pdo->bindparam(':movement', $movement);
		       	$pdo->bindparam(':strap', $strap);
		       	$pdo->bindparam(':price', $price);
		       	$pdo->bindparam(':description', $desc);
		       	$pdo->bindparam(':end_date', $end_date);
		       	$pdo->execute();
		       	echo $this->db->lastInsertId(); 
		       }catch(PDOException $e){
					echo $e->getMessage();
				}
		}

		public function editAuction($id ,$brand, $model, $year, $movement, $strap, $price, $desc, $end_date){
			try{
				$query = "UPDATE auctions SET brand = :brand, model = :model, year = :year, movement = :movement, strap = :strap, price = :price, description = :description, end_date = :end_date WHERE ID = :ID";
				$pdo = $this->db->prepare($query);
				$pdo->bindparam(':ID', $id);
		       	$pdo->bindparam(':brand', $brand);
		       	$pdo->bindparam(':model', $model);
		       	$pdo->bindparam(':year', $year);
		       	$pdo->bindparam(':movement', $movement);
		       	$pdo->bindparam(':strap', $strap);
		       	$pdo->bindparam(':price', $price);
		       	$pdo->bindparam(':description', $desc);
		       	$pdo->bindparam(':end_date', $end_date);
		       	$pdo->execute();
		       	echo "Success";
		       }catch(PDOException $e){
					echo $e->getMessage();
				}
		}

		public function getAllAuctions(){
			try{
				$query = "SELECT * FROM auctions";
				$pdo = $this->db->prepare($query);
		       	$pdo->execute();
		       	$result = $pdo->fetchAll();
		       	echo json_encode($result);
		       }catch(PDOException $e){
					echo $e->getMessage();
				}
		}

		public function getAuctionFromID($id){
			try{
				$query = "SELECT * FROM auctions WHERE ID = :id";
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

		public function getAuctionByYear($year){
			
			try{
				$query = "SELECT * FROM auctions WHERE year = :year ";
				$pdo = $this->db->prepare($query);
				$pdo->bindparam(':year', $year);
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

		public function getAuctionByMovement($movement){
			try{
				$query = "SELECT * FROM auctions WHERE movement = :movement ";
				$pdo = $this->db->prepare($query);
				$pdo->bindparam(':movement', $movement);
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

		public function getAuctionByStrap($strap){
			try{
				$query = "SELECT * FROM auctions WHERE strap = :strap";
				$pdo = $this->db->prepare($query);
				$pdo->bindparam(':strap', $strap);
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

		public function getAuctionByBrand($keyword){
			$keyword = "%".$keyword."%";
			try{
				$query = "SELECT * FROM auctions WHERE brand LIKE :keyword OR model LIKE :keyword";
				$pdo = $this->db->prepare($query);
				$pdo->bindparam(':keyword', $keyword);
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

		public function getAuctionBySellerID($id){
			try{
				$query = "SELECT * FROM auctions WHERE user_ID = :id ";
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

		public function FinishAuction($id, $buyer){
			try{
				$query = "UPDATE auctions SET status = :status WHERE ID = :id";
				$pdo = $this->db->prepare($query);
		       	$pdo->bindparam(':status', $buyer);
		       	$pdo->bindparam(':id', $id);
		       	$pdo->execute();
		       	echo "Success";
		       }catch(PDOException $e){
					echo $e->getMessage();
				}
		}

		public function addThumbImagetoID($id, $pathtoImage){
			try{
				$query = "UPDATE auctions SET thumbnail = :thumb WHERE ID = :ID";
				$pdo = $this->db->prepare($query);
				$pdo->bindparam(':ID', $id);
			    $pdo->bindparam(':thumb', $pathtoImage);
			    $pdo->execute();
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		public function deleteThumbnail($id){
			$nullThumb = null;
			try{
				$query = "UPDATE auctions SET thumbnail = :thumb WHERE ID = :ID";
				$pdo = $this->db->prepare($query);
				$pdo->bindparam(':ID', $id);
			    $pdo->bindparam(':thumb', $nullThumb);
			    $pdo->execute();
			    echo "Success";
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		
		}

		public function deleteAuction($id){
			try{
				$query = "DELETE FROM auctions WHERE ID = :ID";
				$pdo = $this->db->prepare($query);
				$pdo->bindparam(':ID', $id);
			    $pdo->execute();
			    echo "Success";
			}catch(PDOException $e){
				echo $e->getMessage();
			}

		}

		public function getUserPurchased($id){
			try{
				$query = "SELECT * FROM auctions WHERE status = :id ";
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

		public function getOwnerFromID($id){
			try{
				$query = "SELECT user_ID FROM auctions WHERE ID = :id ";
				$pdo = $this->db->prepare($query);
				$pdo->bindparam(':id', $id);
		       	$pdo->execute();
		       	$result = $pdo->fetch();
		       	return $result;
		    
		       }catch(PDOException $e){
					echo $e->getMessage();
				}
		}
		



	}


?>

