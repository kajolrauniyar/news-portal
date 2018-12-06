<?php
function debugger($data, $is_die = false){
	echo "<pre>";
	print_r($data);
	echo "</pre>";
	if($is_die){
		exit;
	}
}

function getCurrentPage(){
	$page = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	return $page;
}

function getAdvertisementByPosn($posn, $limit = 1){
	global $conn;
	$sql = "SELECT * FROM advertisements WHERE position = '".$posn."' AND status = 'Active' ORDER BY id DESC LIMIT 0, ".$limit;
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
function getMenu(){
	global $conn;
	$sql ="SELECT * FROM categories WHERE status= 'Active' ORDER BY id ASC LIMIT 0, 10";
	$query = mysqli_query($conn,$sql);
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
function getNews($args=array(), $is_die=false){
	global $conn;

	$sql ="SELECT * FROM news";
		/*WHERE condition*/
		if (isset ($args['where'])){
			$sql .=" WHERE ".$args['where'];
		}else{
			$sql .= " WHERE status='Published'";
		}
		/*Order By*/
		if (isset ($args['order_by'])){
			$sql .=" ORDER BY ".$args['order_by'];
		}else{
			$sql .= " ORDER BY id DESC";
		}
		/*LImit*/
		if (isset ($args['limit'])){
			$sql .=" LIMIT ".$args['limit'];
		}

		if($is_die){
			echo $sql;
			exit;
		}




	$query = mysqli_query($conn,$sql);
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