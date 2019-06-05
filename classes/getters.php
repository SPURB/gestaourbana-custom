<?php
class Getters {
	private function checkParameter($id) {
		if (!is_numeric($id)) { 
			return "HTTP/1.0 403 Forbidden";
		}
	}

	public function getMediaPosts($limit){

		$this->checkParameter($limit);

		$sql = "SELECT 
			post_id,
			meta_value
			FROM
			wp_postmeta
			WHERE
			meta_key
			LIKE '_wp_attached_file'
			LIMIT " . $limit;

		$result = mysqli_query($GLOBALS['link'], $sql);
		$json_array = array();

		while($row = mysqli_fetch_assoc($result)) {
			$json_array[] = $row;
		} 
		return json_encode($json_array);
	}

	public function getCommentsFromNoticia($id) {

		$this->checkParameter($id);

		$sql = "SELECT 
			comment_ID,
			comment_date,
			comment_author,
			comment_content,
			comment_parent
			FROM wp_comments
			WHERE comment_approved=1 
			AND comment_post_ID=" . $id;

		$result = mysqli_query($GLOBALS['link'], $sql);
		$json_array = array();

		while($row = mysqli_fetch_assoc($result)) {
			$comment = array(
				"comment_ID" => $row['comment_ID'],
				"comment_date" => $row['comment_date'],
				"comment_parent" => $row['comment_parent'],
				"name" => utf8_encode($row['comment_author']),
				"content" => utf8_encode($row['comment_content'])
			);
			$json_array [] = $comment;
		}

		return json_encode($json_array);

	}
}
?>