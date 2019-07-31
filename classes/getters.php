<?php
class Getters {
	private function checkParameter($id) {
		if (!is_numeric($id)) { 
			return "HTTP/1.0 403 Forbidden";
		}
	}

	private function retrievePostSlug($id) {
		$sqlFromPosts = "SELECT
			post_name
			FROM wp_posts
			WHERE post_type='noticias'
			AND ID=" . $id;
		$result = mysqli_query($GLOBALS['link'], $sqlFromPosts);
		
		while($row = mysqli_fetch_assoc($result)) {
			$slug = $row['post_name'];
		}
		return utf8_encode($slug);
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
			comment_author,
			comment_date,
			comment_content
			FROM wp_comments
			WHERE comment_approved=1
			AND comment_parent=0
			AND comment_post_ID=" . $id;

		$result = mysqli_query($GLOBALS['link'], $sql);
		$json_array = array();

		while($row = mysqli_fetch_assoc($result)) {
			$comment = array(
				"name" => utf8_encode($row['comment_author']),
				"date" => $row['comment_date'],
				"content" => utf8_encode($row['comment_content']),
				"post_slug" => $this->retrievePostSlug($id)
			);

			$json_array [] = $comment;
		}

		return json_encode($json_array);

	}

	public function getNumberOfCommentsFromNoticia($ids) {

		$intsIds = explode(',', $ids);
		$numberofcomments = array();

		foreach($intsIds as $thisid) {

			$this->checkParameter($thisid);

			$sql = "SELECT
				count(*),
				comment_post_ID
				FROM wp_comments
				WHERE comment_approved=1
				AND comment_parent=0 
				AND comment_post_ID=" . $thisid;

			$result = mysqli_query($GLOBALS['link'], $sql);
			$json_array = array();
	
			while($row = mysqli_fetch_assoc($result)) {

				$haveComments =  $row['count(*)'] > 0 ? true : false;
				if ($haveComments){
					$json_array =  array(
						"commentcount" => $row['count(*)'],
						"idnoticia" => $row['comment_post_ID']
					);
				}
			}
			if (count($json_array)) array_push($numberofcomments, $json_array);
		}
		return json_encode($numberofcomments, JSON_NUMERIC_CHECK);
	}
}
?>