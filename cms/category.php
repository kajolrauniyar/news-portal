<?php
   require 'inc/config.php';
   require 'inc/functions.php';
   require 'inc/logincheck.php';

if(isset($_POST) && !empty($_POST)){
	//debugger($_POST);
	//debugger($_FILES,true);

	$data=array(
 		'title'=>sanitize($_POST['title']),
 		'summary'=>sanitize($_POST['summary']),
 		'status'=>sanitize($_POST['status']),
 		'added_by'=>$_SESSION['user_id'],
 		'image'=>sanitize($_POST['old_image'])
	);
		//debugger($data,true);
	if(isset($_POST['del_image'])&& !empty($_POST['del_image'])&& file_exists(UPLOAD_DIR.'/category/'.$_POST['del_image'])){
		unlink(UPLOAD_DIR.'/category/'.$_POST['del_image']);
		$data['image']=NULL;
	}

	if(isset($_FILES['image'])&& $_FILES['image']['error']==0){
		$ext=pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
			if(in_array(strtolower($ext), ALLOWED_EXTENSIONS)){
			 	if($_FILES['image']['size']<=5000000){
			 		$upload_dir=UPLOAD_DIR.'/category';

		 			if(!is_dir($upload_dir)){
		 				mkdir($upload_dir,'0777',true);
		 			}
		 			/*category-20181002072105123.jpg*/
		 			$file_name="Category-".date('ymdhis').rand(0,999).".".$ext;
		 			$success=move_uploaded_file($_FILES['image']['tmp_name'],$upload_dir.'/'.$file_name);
			 			if($success){
			 				$data['image']=$file_name;
							if(isset($_POST['old_image'])&& !empty($_POST['old_image'])&& file_exists(UPLOAD_DIR.'/category/'.$_POST['old_image']))
							{
								unlink(UPLOAD_DIR.'/category/'.$_POST['old_image']);
							}


			 			}
			 	}
			}
	}




		$cat_id=(isset($_POST['category_id'])&& !empty($_POST['category_id']))?(int)$_POST['category_id']:NULL;
		if($cat_id){
			/*update Case*/
			$act="updat";
			$success=updateCategory($data,$cat_id);
		}else{
			/*add Case*/
			$act="add";
			$success=addCategory($data);
		}



		
		if($success){
			$_SESSION['success']='Category '.$act.'ed successfully.';
		}else{
			$_SESSION['error']="sorrry! There was problem while ".$act."ing category.";

		}
		@header('location:list-category');
        exit;
}else if(isset($_GET,$_GET['id']) && !empty($_GET['id'])){
		//debugger($_GET,true);
		$id=(int)$_GET['id'];
		//echo $id;
		if($id<=0){
			$_SESSION['error']="Sorry! Invalid Category Id.";
			@header('location:list-category');
			exit;
		}
		
		$Category_info=getCategoryById($id);
		//echo $id;
		//debugger($Category_info,true);
		if($Category_info){
			$del=deleteCategory($id);
			if($del){
				/* File delete*/
				if(!empty($Category_info['image'])&& file_exists(UPLOAD_DIR.'/category/'.$Category_info['image'])){
					unlink((UPLOAD_DIR.'/category/'.$Category_info['image']));
				}
				$_SESSION['success']="Category deleted successfully";
				@header('location:list-category');
				exit;



			}else{
				$_SESSION['error']="Sorry!There was problem while deleting category.";
				@header('location:add-category');
	    		exit;


			}

		}else{
			$_SESSION['error']="Sorry!The id you provided has been already delete or doesnot exists.";
			@header('location:add-category');
	    	exit;

		}
	}


	else{
		$_SESSION['error']="please fill the form correctly.";
		@header('location:add-category');
	    exit;
	}


?>