<?php
function debugger($date, $is_die=false){
	echo "<pre>";
	print_r($date);
	echo "</pre>";
	if($is_die){
		exit;
	}
}

function getUserByUserName($email, $is_die=false){
	global $conn;
	//$debugger($conn);
	$sql="SELECT * FROM users WHERE  email='".$email."'";
    if($is_die){
		debugger($sql,true);
	}
	$query=mysqli_query($conn,$sql);
	if(mysqli_num_rows($query)<=0){
		return false;
	}
	else{
		$data = mysqli_fetch_assoc($query);
		return $data;
		
	}
}


function generateRandomStr($length=100){
	$chars="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

   $str_len=strlen($chars);
   $random="";
   for($i=0;$i<$length;$i++){
   	$random.=$chars[rand(0,$str_len-1)];

   }
   return $random;

}

function updateLogin($data,$user_id,$is_die=false){
	global $conn;
	$sql="UPDATE users SET session_token='".$data['session_token']."', remember_token='".$data['remember_token']."' WHERE id=".$user_id;
	if($is_die){
		debugger($sql,true);
	}
	$query=mysqli_query($conn,$sql);
	if($query){
		return true;
	}else{
		return false;
	}
}

function getUserByCookie($remember_token, $is_die=false){
	global $conn;
	$sql="SELECT * FROM users WHERE remember_token='".$remember_token."'";
	if($is_die){
		debugger($sql,true);
	}

       $query=mysqli_query($conn, $sql);
        if(mysqli_num_rows($query)<=0){
        	return false;
        }else{
        	$user_data=mysqli_fetch_assoc($query);
        	return $user_data;
        }

}

function sanitize($str){
	global $conn;
	return mysqli_real_escape_string($conn,$str);
}

function addCategory($data,$is_die=false){
	global $conn;
	$sql="INSERT INTO categories SET 
	      title='".$data['title']."',
	      summary='".$data['summary']."',
	      image='".$data['image']."',
	      status='".$data['status']."',
	      added_by=".$data['added_by'];
	if($is_die){
		debugger($sql,true);
	}
	$query=mysqli_query($conn,$sql);
	if($query){
		return mysqli_insert_id($conn);
	}else{
		return false;
	}    
}

function updateCategory($data,$cat_id,$is_die=false){
	global $conn;
	$sql="UPDATE   categories SET 
	      title='".$data['title']."',
	      summary='".$data['summary']."',
	      image='".$data['image']."',
	      status='".$data['status']."',
	      added_by=".$data['added_by']."
		WHERE id=".$cat_id;
	if($is_die){
		debugger($sql,true);
	}
	$query=mysqli_query($conn,$sql);
	if($query){
		return $cat_id;
	}else{
		return false;
	} 

}



function getAllCategories($is_die=false){
	global $conn;
	$sql="SELECT * FROM categories ORDER BY id DESC";
	if($is_die){
		echo $sql;
		exit;
	}
	$query=mysqli_query($conn,$sql);
	if(mysqli_num_rows($query)<=0){
		return false;
	}else{
		$data=array();
		while($row=mysqli_fetch_assoc($query)){
			$data[]=$row;
		}
		return $data;
	}
}


function getCategoryById($id,$is_die=false){
	global $conn;
	$sql="SELECT * FROM categories WHERE id=".$id;
	if($is_die){
		debugger($sql,true);
	}
	$query=mysqli_query($conn,$sql);
	if($query){
		if(mysqli_num_rows($query)<=0){
			return false;
		}else{
			$data=mysqli_fetch_assoc($query);
			return $data;
		}
	}else{
		return false;
	}

}


function deleteCategory($id,$is_die=false){
	global $conn;
	$sql="DELETE FROM categories WHERE id=".$id;
	if($is_die){
		debugger($sql,true);

	}
	$query=mysqli_query($conn,$sql);
	if($query){
		return true;
	}else{
		return false;
	}
}

function getRowByRowId($table_name,$id,$is_die=false){
	global $conn;
	$sql="SELECT * FROM ".$table_name." WHERE id=".$id;
	if($is_die){
		echo $sql;
		exit;
	}
	$query=mysqli_query($conn,$sql);
	if($query){
		if(mysqli_num_rows($query)<=0){
			return false;
		}else{
			$data=mysqli_fetch_assoc($query);
			return $data;
		}
	}else{
		return false;
	}
}


function getallRows($table_name,$args=array(), $is_die=false){
	global $conn;
	/* SELECT fields FROM table
		   JOIN statement
		   WHERE statement
		   GROUP BY statement
		   ORDER BY statement
		   LIMIT start,count;
	*/
	$sql="SELECT * FROM ".$table_name;
	/*WHERE*/
	if(isset($args,$args['where'])&& !empty($args['where'])){
		$sql .=" WHERE ".$args['where'];
	}
	/* ORDER BY  $sql .=" ORDER BY id DESC";*/
	if(isset($args, $args['order_by'])&& !empty($args['order_by'])){
		$sql .=" ORDER BY ".$args['order_by'];
	}else{
		$sql .= " ORDER BY id DESC";
	}

	
	if($is_die){
		echo $sql;
		exit;
	}
	$query=mysqli_query($conn,$sql);
	if(mysqli_num_rows($query)<=0){
		return false;
	}else{
		$data=array();
		while($row=mysqli_fetch_assoc($query)){
			$data[]=$row;
		}
		return $data;
	}

}

function addData($table,$data,$is_die=false){
	global $conn;
	/* INSERT INTO table SET column_name=value,
	                         column_name='value'
	*/
	  // debugger($data);  

	$sql = "INSERT INTO ".$table." SET ";
	$temp = array();
	foreach($data as $column_name => $value){
		$str = $column_name." = ";					// category_id = 

		if(is_int($value) || is_float($value)){
			$str .= $value;							// category_id = 4
		} else {
			$str .= "'".$value."'";					
		}

		$temp[] = $str;
	}
	//debugger(temp);
	$sql .= implode(', ', $temp);
	if($is_die){
		echo $sql;
		exit;
	}

	$query = mysqli_query($conn, $sql);
	if($query){
		return mysqli_insert_id($conn);
	} else {
		return false;
	}
}


function updateData($table, $data, $row_id, $is_die  = false){
	global $conn;

	$sql = "UPDATE ".$table." SET ";
	$temp = array();

	foreach($data as $column_name => $value){
		$str = $column_name." = ";					// category_id = 

		if(is_int($value) || is_float($value)){
			$str .= $value;							// category_id = 4
		} else {
			$str .= "'".$value."'";					
		}

		$temp[] = $str;
	}
	
	$sql .= implode(', ', $temp);
	
	$sql .= " WHERE id = ".$row_id;
	if($is_die){
		echo $sql;
		exit;
	}

	$query = mysqli_query($conn, $sql);
	if($query){
		return $row_id;
	} else {
		return false;
	}	
}

function getAllNews($is_die = false){
	global $conn;
	/*$sql = "SELECT 
				id,
				title,
				summary,
				category_id,
				(SELECT title FROM categories WHERE categories.id = news.category_id) as category,
				status,
				reporter_id,
				(SELECT full_name FROM users WHERE users.id = news.reporter_id) as reporter	
			FROM news ORDER BY id DESC";*/
	$sql = "SELECT 
				news.id,
				news.title,
				news.summary,
				news.category_id,
				news.status,
				news.reporter_id,
				categories.title as category,
				users.full_name as reporter 
			FROM news 
			LEFT JOIN categories ON categories.id = news.category_id
			LEFT JOIN users ON users.id = news.reporter_id
			ORDER BY id DESC";

	if($is_die){
		echo $sql;
		exit;
	}
	$query = mysqli_query($conn, $sql);
	if(mysqli_num_rows($query) <= 0){
		return false;
	} else {
		$data = array();
		while($row = mysqli_fetch_assoc($query)){
			$data[] = $row;
		}
		return $data;
	}	
}

function deleteData($table_name,$column_name,$value,$is_die=false){
	global $conn;
	$sql="DELETE FROM ".$table_name." WHERE ".$column_name." = '".$value."'";
	if($is_die){
		echo $sql;
		exit;
	}
	$query=mysqli_query($conn,$sql);
	if($query){
		return true;
	}else{
		return false;
	}
}
function  getPlainText($str){
	$str = preg_replace("/[^a-zA-Z0-9]+/", "-", $str);
	return $str;
}


function getYoutubeVideoIdFromUrl($url){
	
	preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/",$url,$matches);
	return $matches[1];
	

}

function addAdvertisement($data, $is_die= false){
		global $conn;
		debugger($data, true);
		$sql = "INSERT INTO advertisements SET 
		title = '".$data['title']."',
		organization ='".$data['organization']."',
		summary = '".$data['summary']."',
		ad_page = '".$data['ad_page']."',
		ad_position =  '".$data['ad_position']."', 
		ad_duration =  ".$data['ad_duration'].",  
		ad_display_after =  ".$data['ad_display_after'].", 
		status 	= '".$data['status']."', 
		path = '".$data['path']."',
		banner_image_name = '".$data['banner_image_name']."',
		added_by =  ".$data['added_by'];
		//echo $sql;
		//debugger($sql, true);
		if ($is_die) {
			debugger($sql, true);
		}
		$query = mysqli_query($conn, $sql);
		if ($query) {
			return mysqli_insert_id($conn);
		} else{
			return false;
		}
	}
	function getAllAdvertisements( $is_die = false){
		global $conn;
		$sql = "SELECT * FROM advertisements ORDER BY id DESC";
		if ($is_die) {
			echo $sql;
			exit;
		}

		$query=mysqli_query($conn,$sql);
		if (mysqli_num_rows($query) <= 0) {
			return false;
		} else{
			while($row = mysqli_fetch_assoc($query)){
				$data[] = $row;
			}
			return $data;
		}
	}

	function addUserInformation($users_data, $is_die= false){
		global $conn;
		//debugger($users_data);
		$sql = "INSERT INTO users SET 

		full_name 	= '".$users_data['full_name']."',
		email 		= '".$users_data['email']."',
		password 	= '".$users_data['password']."',
		role 		= '".$users_data['role']."',
		user_image  = '".$users_data['user_image']."',
		status 		= '".$users_data['status']."'";

		 //debugger($sql, true);
		 //exit;
		if ($is_die) {
			debugger($sql, true);

		}
		$query = mysqli_query($conn, $sql);
		var_dump($query);
		if ($query) {
			// return mysqli_insert_id($conn);
			return(1);
		} else{
			return false;
		}
	}
	
	function getAllUsers($is_die = false){
		global $conn;
		$sql = "SELECT * FROM users ORDER BY id DESC";
		if ($is_die) {
			echo $sql;
			exit;
		}

		$query = mysqli_query($conn, $sql);
		if (mysqli_num_rows($query) <= 0) {
			return false;
		} else{
			while($row = mysqli_fetch_assoc($query)){
				$data[] = $row;
			}
			return $data;
		}
	}
	
?>


