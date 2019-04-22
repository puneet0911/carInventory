<?php 
include_once 'config.php';
include_once 'class.php';
/**
 * 
 */

if($_GET['type'] == 'add_manufacturer'){
if($_POST){
	if($_POST['carInventoryService']){
		$carInventoryPost = $_POST['carInventoryService'];
		
		if($carInventoryPost['name']){
			$name_data = $CarInventory->addManufecturerName($carInventoryPost['name']);
		}else{
			$name_data = '';
			echo json_encode(array("status"=>"403","data"=>"Please check the data :".$e->getMessage()));
			http_response_code(403);
		}

		if(!empty($name_data) && !empty($carInventoryPost['color']) && !empty($carInventoryPost['year']) && !empty($carInventoryPost['rNumber']) && !empty($carInventoryPost['note'])){
			$response  = json_decode($name_data,true);
			if($response['status'] == 200 && !empty($response['data']['id'])){
				$CarInventory->addOtherDetails($response['data']['id'],'color',$carInventoryPost['color']);
				$CarInventory->addOtherDetails($response['data']['id'],'year',$carInventoryPost['year']);
				$CarInventory->addOtherDetails($response['data']['id'],'rNumber',$carInventoryPost['rNumber']);
				$CarInventory->addOtherDetails($response['data']['id'],'note',$carInventoryPost['note']);
			}
		}

		if(!empty($name_data) && !empty($_FILES) ){
			if($response['status'] == 200 && !empty($response['data']['id'])){
				  $file_name = $_FILES['file']['name'];
			      $file_size = $_FILES['file']['size'];
			      $file_tmp  = $_FILES['file']['tmp_name'];
			      $file_type = $_FILES['file']['type'];
			      $file_ext  = pathinfo($file_name,PATHINFO_EXTENSION);
			       move_uploaded_file($file_tmp,$_SERVER["DOCUMENT_ROOT"].$uploadPath.'/'.$file_name);
			       return $CarInventory->addOtherDetails($response['data']['id'],'image',$uploadPath."/".$file_name);
			      
			}
		}

	}
}
}
if($_GET['type'] =='get_manufacturers'){
echo $CarInventory->getManufacturerData();
}
if($_GET['type'] =='get_manufacturer_details'){
echo $CarInventory->getManufacturerDetails($_GET['id']);
}
?>