<?php 

	require 'inc/config.php';
	require 'inc/functions.php';
	require 'inc/logincheck.php';
	// debugger($_FILES);
	// debugger($_GET);
	// debugger($_POST, true);
	if (isset($_POST) && !empty($_POST)) {
		if ($_POST['password'] == $_POST['password_1']) {
			
			$enc_password = SHA1($_POST['email'].$_POST['password']);

			$users_data = array(
					'full_name' 	=> sanitize($_POST['user_full_name']),
					'email' 		=> sanitize($_POST['email']),
					'password' 		=> sanitize($enc_password),
					'role' 			=> sanitize($_POST['role']),
					'status' 		=> sanitize($_POST['status'])
					); 
			// debugger($users_data, true);
			//echo UPLOAD_DIR.'/users_photo/'.$_POST['delete_user_image'];
			
			if (isset($_POST['delete_user_image']) && !empty($_POST['delete_user_image']) && file_exists(UPLOAD_DIR.'/'.'users_photo/'.$_POST['delete_user_image'])) {
				unlink(UPLOAD_DIR.'/users_photo/'.$_POST['delete_user_image']);
				$users_data['user_image'] = NULL;
			}


			$upload_dir = UPLOAD_DIR.'/users_photo';
				if (!is_dir($upload_dir)) {
					mkdir($upload_dir, 0755, true);
				}



			if (isset($_FILES['users_photo']) && $_FILES['users_photo']['error'] == 0) {
			$ext = pathinfo($_FILES['users_photo']['name'], PATHINFO_EXTENSION);
			if (in_array(strtolower($ext), ALLOWED_EXTENSIONS)) {
				if ($_FILES['users_photo']['size'] <= 5000000) {
					
						

					$file_name =getPlainText($_POST['user_full_name'])."-".date('Ymdhis').rand(0, 999).".".$ext;

					$success = move_uploaded_file($_FILES['users_photo']['tmp_name'], $upload_dir.'/'.$file_name);
					//debugger($success, true);
					if ($success) {
						$users_data['user_image'] = $file_name;
						
						if (isset($_POST['old_user_image']) && !empty($_POST['old_user_image']) && file_exists(UPLOAD_DIR.'/users_photo/'.$_POST['old_user_image'])) {
							unlink(UPLOAD_DIR.'/users_photo/'.$_POST['old_user_image']);
						} 
					}
				}
			}
		}


		$user_image_id = (isset($_POST['user_image_id']) && !empty($_POST['user_image_id'])) ? (int)$_POST['user_image_id'] : NULL;
			// debugger($cat_id);
		if ($user_image_id) {
			/* update category */
			$act = "updat";
			$success = updateData('users', $users_data, $user_image_id);
		} else{
			$act = "add";
			/* add category */
			$success = addUserInformation($users_data);
			debugger($success,true);
		}



			 
			if ($success) {
				$_SESSION['success'] = "User ".$act."ed successfully.";
				 
			}else{
				$_SESSION['success'] = "Sorry ! There was problem while ".$act."ing user.";
			}
			@header('location: list-user');
			exit;
		} else{
			$_SESSION['error'] = "Password doesnot match.";
			@header('location: add-user');
			exit;
		}		 
	}else if(isset($_GET, $_GET['id']) && !empty($_GET['id'])){
			$user_Id = (int)$_GET['id'];
			if ($user_Id <=0) {
				$_SESSION['error'] = "Sorry ! Invalid User ID.";
				@header('location: list-user');
				exit; 
			}
			$user_info = getRowByRowId('users', $user_Id);
			 
			if ($user_info && $user_info['id'] != $_SESSION['user_id']) {
				 
				$remove_user = deleteData('users', 'id', $user_Id);
				if ($remove_user) {
					if (!empty($user_info['user_image']) && file_exists(UPLOAD_DIR.'/users_photo/'.$user_info['user_image'])) {
						unlink(UPLOAD_DIR.'/users_photo/'.$user_info['user_image']);
					}
					$_SESSION['success'] = "User has been Removed Successfully.";
					@header('location: list-user');
					exit;
				} else{
					$_SESSION['error'] = "Sorry ! There was Problem while Removing User.";
					@header('location: list-user');
					exit; 
				}
			} else{
				$_SESSION['error'] = "Sorry ! The id You Provided has been already deleted or does not exists.";
				@header('location: list-user');
				exit; 
			}
	}else{
		$_SESSION['error'] = "Unauthorized Access.";
		@header('location: list-user');
		exit;
	}