<?php 
header('Content-Type: application/json');

class CarInventory{
	private $conn;
	function __construct($servername ,$username,$password,$database)
	{
		try 
			{
			    $this->conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
			    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e)
			{	
				echo json_encode(array("status"=>"404","data"=>"Connection failed:".$e->getMessage()));
				http_response_code(404);		
			    exit();
			}
	}

	function addManufecturerName($name){
		try 
			{
				$insertQuery = $this->conn->prepare(" INSERT INTO `manufecturer` (`name`) VALUES (:name) ");
				$insertQuery->bindParam(":name", $name);
				if($insertQuery->execute()){
					$id = $this->conn->lastInsertId();
					http_response_code(200);	
					return json_encode(array("status"=>"200","data"=>array("id"=>$id)));
				}else{

				}
			} catch(PDOException $e)
			{	
				echo json_encode(array("status"=>"403","data"=>"Please check the data :".$e->getMessage()));
				http_response_code(403);		
			    exit();
			}
	}

	function addOtherDetails($id,$meta_key,$meta_value){
		try 
			{
				$insertQuery = $this->conn->prepare("INSERT INTO `manufecturer_metadata` (`manufecturer_id`,`meta_key`,`meta_value`) VALUES (:id,:key,:value)");
				$insertQuery->bindParam(":id", $id);
				$insertQuery->bindParam(":key", $meta_key);
				$insertQuery->bindParam(":value", $meta_value);
				if($insertQuery->execute()){
					$id = $this->conn->lastInsertId();
					http_response_code(200);	
					return json_encode(array("status"=>"200","data"=>array("id"=>$id)));
				}else{

				}
			} catch(PDOException $e)
			{	
				echo json_encode(array("status"=>"403","data"=>"Please check the data :".$e->getMessage()));
				http_response_code(403);		
			    exit();
			}
	}

	function getManufacturerData(){
		try 
			{
				$getQuery = $this->conn->prepare(" SELECT * FROM `manufecturer` ");
				$getQuery->execute();
				if($getQuery->rowCount() > 0){
					$data = $getQuery->fetchAll(PDO::FETCH_OBJ);
					http_response_code(200);	
					return json_encode(array("status"=>"200","data"=>$data));
				}else{
					http_response_code(200);	
					return json_encode(array("status"=>"200","data"=>''));

				}
			} catch(PDOException $e)
			{	
				echo json_encode(array("status"=>"403","data"=>"Please check the data :".$e->getMessage()));
				http_response_code(403);		
			    exit();
			}
	}

	function getManufacturerDetails($id){
		try 
			{
				$getQuery = $this->conn->prepare(" SELECT `manufecturer`.`name`,`manufecturer`.`id`,`manufecturer_metadata`.`meta_key`,`manufecturer_metadata`.`meta_value` FROM `manufecturer` INNER JOIN `manufecturer_metadata` ON `manufecturer`.`id` = `manufecturer_metadata`.`manufecturer_id` WHERE `manufecturer`.`id` = :id ");
				$getQuery->bindParam(":id", $id);
				$getQuery->execute();
				if($getQuery->rowCount() > 0){
					$data = $getQuery->fetchAll(PDO::FETCH_OBJ);
					http_response_code(200);	
					return json_encode(array("status"=>"200","data"=>$data));
				}else{
					http_response_code(200);	
					return json_encode(array("status"=>"200","data"=>''));

				}
			} catch(PDOException $e)
			{	
				echo json_encode(array("status"=>"403","data"=>"Please check the data :".$e->getMessage()));
				http_response_code(403);		
			    exit();
			}
	}
}

$CarInventory = new CarInventory($servername ,$username,$password,$database);
?>