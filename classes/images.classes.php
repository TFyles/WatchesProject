<?php
	
	class image
	{
		protected $db = null;

		public function __construct($db){
			$this->db = $db;
		}

		public function addImagetoID($id, $pathtoImage){
			try{
				$query = "INSERT INTO photos(auction_ID, Img_path) VALUES (:ID, :Imgpath)";
				$pdo = $this->db->prepare($query);
				$pdo->bindparam(':ID', $id);
			    $pdo->bindparam(':Imgpath', $pathtoImage);
			    $pdo->execute();
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		public function getImagesFromID($id){
			try{
				$query = "SELECT * FROM photos WHERE auction_ID = :id ";
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

		public function getImagesFromIDDelete($id){
			try{
				$query = "SELECT * FROM photos WHERE auction_ID = :id ";
				$pdo = $this->db->prepare($query);
				$pdo->bindparam(':id', $id);
		       	$pdo->execute();
		     

		       	if ($pdo->rowCount() > 0) {
		       		$result = $pdo->fetchAll();
				  	return $result;
				  	
				} else {
				   echo 'nothing';
				}
		    
		    }catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		public function deletePhoto($id){
			try{
				$query = "DELETE FROM photos WHERE ID = :ID";
				$pdo = $this->db->prepare($query);
				$pdo->bindparam(':ID', $id);
			    $pdo->execute();
			    echo "Success";
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
	}


?>
