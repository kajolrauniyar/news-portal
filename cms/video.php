<?php
	require 'inc/config.php';
 	require 'inc/functions.php';
   	require 'inc/header.php';
   	require 'inc/logincheck.php';

//debugger($_POST);

   	if(isset($_POST)&& !empty($_POST)){
         //debugger($_POST);
         //debugger($_FILES,true);
   		$data=array(
			'title'=>sanitize($_POST['title']),
			'link'=>sanitize($_POST['link']),
			'video_id'=>getYoutubeVideoIdFromUrl($_POST['link']),
			'status'=>sanitize($_POST['status']),
			'added_by'=>$_SESSION['user_id']
   		);

   		$video_id=addData('videos',$data);
   		if($video_id){
   			$_SESSION['success']='Video added Successfully.';

   		}else{
   			$_SESSION['error']='Sorry ! There was Problem while adding video.';
            @header('location:list-video');
   		}
         $_SESSION['error']="Sorry ! The id you provided has been already deleted or doesnot exist";
   		@header('location:list-video');
   		exit;
   		//debugger($data,true);
         

   	}else{
   		$_SESSION['error']='Unauthorized access';
   		@header('location:list-video');
   		exit;
   	}













   	?>

