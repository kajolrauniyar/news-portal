<?php
   require 'inc/config.php';
   require 'inc/functions.php';
   require 'inc/logincheck.php';

if(isset($_POST) && !empty($_POST)){
	//debugger($_POST);
	//debugger($_FILES,true);

	$data=array(
		'title' =>sanitize($_POST['title']),
		'category_id'=>(int)$_POST['category_id'],
		'summary' =>sanitize($_POST['summary']),
		'description'=>htmlentities($_POST['description']),
		
		'is_main'=>isset($_POST['is_main'])? 1 : 0,
		'is_breaking' =>isset($_POST['is_breaking'])? 1 : 0,
		'is_featured'=>isset($_POST['is_featured'])? 1 : 0,
		'is_trending'=>isset($_POST['is_trending'])? 1 : 0,
		'reporter_id' =>isset($_POST['reporter_id'])?(int)$_POST['reporter_id'] : NULL,
		'status'=>sanitize($_POST['status']),
		'added_by' =>$_SESSION['user_id'],
		'thumbnail'=>sanitize($_POST['old_image'])
		
	);

	if(isset($_POST['del_image'])&& !empty($_POST['del_image'])&& file_exists(UPLOAD_DIR.'/news/'.$_POST['del_image'])){
		unlink(UPLOAD_DIR.'/news/'.$_POST['del_image']);
		$data['thumbnail']=NULL;
	}

	if(isset($_FILES['thumbnail'])&& $_FILES['thumbnail']['error']==0){
		$ext=pathinfo($_FILES['thumbnail']['name'],PATHINFO_EXTENSION);
			if(in_array(strtolower($ext), ALLOWED_EXTENSIONS)){
			 	if($_FILES['thumbnail']['size']<=5000000){
			 		$upload_dir=UPLOAD_DIR.'/news';

		 			if(!is_dir($upload_dir)){
		 				mkdir($upload_dir,'0777',true);
		 			}
		 			/*category-20181002072105123.jpg*/
		 			$file_name="News-".date('ymdhis').rand(0,999).".".$ext;
		 			$success=move_uploaded_file($_FILES['thumbnail']['tmp_name'],$upload_dir.'/'.$file_name);
			 			if($success){
			 				$data['thumbnail']=$file_name;
							if(isset($_POST['old_image'])&& !empty($_POST['old_image'])&& file_exists(UPLOAD_DIR.'/news/'.$_POST['old_image']))
							{
								unlink(UPLOAD_DIR.'/news/'.$_POST['old_image']);
							}


			 			}
			 	}
			}
	}

		$news_id=(isset($_POST['news_id'])&& !empty($_POST['news_id']))?(int)$_POST['news_id']:NULL;
		if($news_id){
			/*update Case*/
			$act="updat";
			$success=updateData("news", $data, $news_id);
		}else{
			/*add Case*/
			$act="add";
			$success=addData("news", $data);
		}


	if($success){
		$_SESSION['success'] = "News ".$act."ed successfully.";
	} else {
		$_SESSION['error'] = "Sorry! There was problem while ".$act."ing news.";
	}

	@header('location: list-news');
	exit;



}else if(isset($_GET,$_GET['id']) && !empty($_GET['id'])){
		//debugger($_GET,true);
		$id=(int)$_GET['id'];
		//echo $id;
		if($id<=0){
			$_SESSION['error']="Sorry! Invalid News Id.";
			@header('location:list-category');
			exit;
		}
		
		$news_info=getRowByRowId('news',$id);
		//echo $id;
		//debugger($news_info,true);
		if($news_info){
			$del=deleteData('news','id',$id);
			if($del){
				/* File delete*/
				if(!empty($news_info['thumbnail'])&& file_exists(UPLOAD_DIR.'/news/'.$news_info['thumbnail'])){
					unlink((UPLOAD_DIR.'/news/'.$news_info['thumbnail']));
				}
				$_SESSION['success']="news deleted successfully";
				@header('location:list-news');
				exit;



			}else{
				$_SESSION['error']="Sorry!There was problem while deleting news.";
				@header('location:list-news');
	    		exit;


			}

		}else{
			$_SESSION['error']="Sorry!The id you provided has been already delete or doesnot exists.";
			@header('location:list-news');
	    	exit;

		}
	}

else{
	$_SESSION['error']="Unauthorized access";
	@header('location:list-news');
	exit;
}
?>
 
