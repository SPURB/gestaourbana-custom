<?php
class Getter {
	public function getRoute($d){
		$sql = "SELECT post_id, meta_value FROM wp_postmeta WHERE meta_key LIKE '_wp_attached_file' LIMIT " . $d;  
		$result = mysqli_query($GLOBALS['link'], $sql);  
		$json_array = array();  

		while($row = mysqli_fetch_assoc($result))  
		{
			$json_array[] = $row;  
		} 
		return json_encode($json_array);
	}
}
?>