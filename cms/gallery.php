<?php
require 'inc/config.php';
require 'inc/functions.php';
require 'inc/logincheck.php';


if(isset($_POST) && !empty($_POST)){

	/*debugger($_POST);
	debugger($_FILES, true);*/

	$gallery_data = array(
		'title'			=> sanitize($_POST['title']),
		'description'	=> sanitize($_POST['description']),
		'status'		=> sanitize($_POST['status']),
		'added_by'		=> $_SESSION['user_id']
	);

	/*If add */
	$upload_dir = 'gallery/'.date('Y-m-d');
	$upload_dir .= "/".strtolower(getPlainText($_POST['title']));
	
	$path = UPLOAD_DIR."/".$upload_dir;

	if(!is_dir($path)){
		mkdir($path, '0777', true);
	} 
	$gallery_data['path'] = $upload_dir;

	/*For Cover Picture*/
	if(isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0){
		$ext = pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION);

		
		if(in_array(strtolower($ext), ALLOWED_EXTENSIONS)){
			if($_FILES['thumbnail']['size'] <= 5000000){

				$file_name = getPlainText($_POST['title'])."-".date('Ymdhis').rand(0,999).".".$ext;
				
				$success = move_uploaded_file($_FILES['thumbnail']['tmp_name'], $path.'/'.$file_name);
				if($success){

					$gallery_data['cover_pic'] = $file_name;
				}
			}
		}
	}

	$gallery_id = isset($_POST['gallery_id']) && !empty($_POST['gallery_id'])? (int)$_POST['gallery_id'] : null;
	if($gallery_id){
		$act = 'updat';
		$gallery_id = updateData('galleries', $gallery_data, $gallery_id);
	} else {
		$act = 'add';
		$gallery_id = addData('galleries', $gallery_data);
	}

	
	if(isset($_FILES['other_images']) && !empty($_FILES['other_images'])){
		$files = $_FILES['other_images'];

		$no_of_files = count($files['name']);

		for($i=0; $i<$no_of_files; $i++){

			$ext = pathinfo($files['name'][$i], PATHINFO_EXTENSION);

			if(in_array(strtolower($ext), ALLOWED_EXTENSIONS)){
			
				if($files['size'][$i] <= 5000000){

					$file_name = getPlainText($_POST['title'])."-".date('Ymdhis').rand(0,999).".".$ext;
					
					$success = move_uploaded_file($files['tmp_name'][$i], $upload_dir.'/'.$file_name);
					if($success){
						$temp = array(
							'gallery_id' 	=> $gallery_id,
							'image_name'	=> $file_name
						);
						$success = addData('gallery_images', $temp);
						// echo $success;
					}
				}
			}
		}
	}


	if(isset($_POST['del_image']) && !empty($_POST['del_image'])){
		foreach($_POST['del_image'] as $delete_image){
			$succ = deleteData('gallery_images', 'image_name',$delete_image); 
			if($succ){
				echo $delete_image;
				exit;
				if(file_exists(UPLOAD_DIR.'/'.$_POST['gallery_path'].'/'.$delete_image) && !empty($delete_image)){

					unlink(UPLOAD_DIR.'/'.$_POST['gallery_path'].'/'.$delete_image);
				}
			}
		}
	}

	if($gallery_id){
		$_SESSION['success'] = "Gallery added successfully.";
	} else {
		$_SESSION['error'] = "Sorry! There was problem while adding gallery.";
	}

	@header('location: list-gallery');
	exit;
} else {
	$_SESSION['error'] = "Unauthorized access.";
	@header('location: list-gallery');
	exit;
}