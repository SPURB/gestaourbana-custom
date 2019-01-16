<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");

class Getter{
	public function getRoute($d){
		//$out = new stdClass();
		// echo $GLOBALS['data'];
				$sql = "SELECT post_id, meta_value FROM wp_postmeta WHERE meta_key LIKE '_wp_attached_file' LIMIT ".$d;  

				$result = mysqli_query($GLOBALS['link'], $sql);  
				$json_array = array();  

				while($row = mysqli_fetch_assoc($result))  
				{
					$json_array[] = $row;  
				} 

				echo json_encode($json_array);
		//return json_encode($out);
	}
}

?>