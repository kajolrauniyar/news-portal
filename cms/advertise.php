<?php 

	require 'inc/config.php';
	require 'inc/functions.php';
	require 'inc/logincheck.php';
	//debugger($_POST);
	//debugger($_FILES, true);
	//debugger($_GET, true);
	if (isset($_POST) && !empty($_POST)) {
		$advertisement_data = array(
							'title' 			=> sanitize($_POST['title']),
							'organization' 		=> sanitize($_POST['organization']),
							'summary' 			=> sanitize($_POST['summary']),
							'ad_page'			=> sanitize($_POST['page']),
							'ad_position'		=> sanitize($_POST['position']),
							'ad_duration'		=> sanitize($_POST['duration_for']),
							'ad_display_after'	=> sanitize($_POST['display_after']),
							'status' 			=> sanitize($_POST['status']),
							'added_by' 			=> $_SESSION['user_id'],
							);
		//debugger($advertisement_data, true);

		if (isset($_POST['delete_banner_image']) && !empty($_POST['delete_banner_image']) && file_exists(UPLOAD_DIR.'/'.$_POST['last_path'].'/'.$_POST['delete_banner_image'])) {
			unlink(UPLOAD_DIR.'/'.$_POST['last_path'].'/'.$_POST['delete_banner_image']);
			$advertisement_data['banner_image_name'] = NULL;
		}

 
		if (!isset($_POST['last_path'])  && empty($_POST['id'])) {
			 $upload_dir = UPLOAD_DIR."/".'advertisement'."/";
        	if (!is_dir($upload_dir)) {
        		mkdir($upload_dir, 0755, true);
        	}
        	$upload_dir .= date('Y-m-d');
        	if (!is_dir($upload_dir)) {
        		mkdir($upload_dir, 0755, true);
        	}
        	$upload_dir .="/".strtolower(getPlainText($_POST['title']));
        	if (!is_dir($upload_dir)) {
        		mkdir($upload_dir, 0755, true);
        	}
        	$path_dir = $upload_dir;
        	$upload_path_to_access = explode("/", $path_dir);
        	$last_location = array_pop($upload_path_to_access);
        	$second_location = array_pop($upload_path_to_access);
        	$third_location = array_pop($upload_path_to_access);
        	$database_location = $third_location."/".$second_location."/".$last_location;
        	$advertisement_data['path'] = $database_location;
		} else{
			$path_dir = UPLOAD_DIR.'/'.$_POST['last_path'];
			$advertisement_data['path'] = $_POST['last_path'];
		}

			

		 
		

		if (isset($_FILES['banner']) && $_FILES['banner']['error'] == 0) {
			$ext = pathinfo($_FILES['banner']['name'], PATHINFO_EXTENSION);
			if (in_array(strtolower($ext), ALLOWED_EXTENSIONS)) {
				if ($_FILES['banner']['size'] <= 2000000) {
					
						

					$file_name =getPlainText($_POST['title'])."-".date('Ymdhis').rand(0, 999).".".$ext;

					$success = move_uploaded_file($_FILES['banner']['tmp_name'], $path_dir.'/'.$file_name);
					if ($success) {
						$advertisement_data['banner_image_name'] = $file_name;

						if (isset($_POST['old_banner_image_name']) && !empty($_POST['old_banner_image_name']) && file_exists(UPLOAD_DIR.'/'.$_POST['last_path'].'/'.$_POST['old_banner_image_name'])) {
							unlink(UPLOAD_DIR.'/'.$_POST['last_path'].'/'.$_POST['old_banner_image_name']);
						} 
					}
				}
			}
		}


			$Advertisement_ID = isset($_POST['Advertisement_ID']) && !empty($_POST['Advertisement_ID']) ? (int)$_POST['Advertisement_ID'] : null;
			if ($Advertisement_ID) {
				$act  = 'updat';
				$success = updateData('advertisements', $advertisement_data, $Advertisement_ID);
			} else{
				$act = 'add';
				$success = addAdvertisement($advertisement_data);
			}

			if ($success) {
			 	$_SESSION['success'] = "Advertisement ".$act."ed successfully.";
			 } else{
			 	$_SESSION['error'] = "Sorry!  There was problem while " .$act."ing Advertisement.";

			 }
			@header('location: list-advertise');
			exit;

	}else if(isset($_GET, $_GET['id']) && !empty($_GET['id'])){
		$id = (int)$_GET['id'];
		if ($id <=0) {
			$_SESSION['error'] = "Sorry ! Invalid Advertisement ID.";
			@header('location: list-advertise');
			exit; 
		}
		$delete_advertise_info = getRowByRowId('advertisements', $id);
		 
		if ($delete_advertise_info) {
			$delete_all_info = deleteData('advertisements', 'id', $id);
			 
			if ($delete_all_info) {
				if (!empty($delete_advertise_info['path']) && file_exists(UPLOAD_DIR.'/'.$delete_advertise_info['path'])) {

					chdir(UPLOAD_DIR.'/'.$delete_advertise_info['path']);
					$advertisement_images = glob("*.*");
					// debugger($all_images, true);
					// exit;
					$no_of_images= count($advertisement_images);
					$n = 0;
					foreach ($advertisement_images as $filename) {
						//echo $filename;
						//exit;
						unlink(UPLOAD_DIR.'/'.$delete_advertise_info['path'].'/'.$filename);
						$n = $n + 1;
					}
					if ($no_of_images== $n ) {
						rmdir(UPLOAD_DIR.'/'.$delete_advertise_info['path']);
					}
					 
				}
				$_SESSION['success'] = "Advertisement Deleted Successfully.";
				@header('location: list-advertise');
				exit;
			} else{
				$_SESSION['error'] = "Sorry ! There was Problem while deleting Advertisement.";
				@header('location: list-advertise');
				exit; 
			}
		} else{
			$_SESSION['error'] = "Sorry ! The id You Provided has been already deleted or does not exists.";
			@header('location: list-advertise');
			exit; 
		}


	}else{
		$_SESSION['error']= "Please fill the Fields correctly.";
		@header('location: add-advertise');
		exit;
	}
	
?>