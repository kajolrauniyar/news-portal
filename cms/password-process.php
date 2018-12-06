<?php
require 'inc/config.php';
require 'inc/functions.php';
require 'inc/logincheck.php';

if(isset($_POST) && !empty($_POST)){
	//debugger($_SESSION);
	
	$user_id = (int)$_SESSION['user_id'];
	$old_password = sha1($_SESSION['email'].$_POST['old_password']);

	/*SELECT * FROM users WHERE id = $user_id AND password = $old_password*/
	$args = array(
		'where' => ' id ='.$user_id." AND password = '".$old_password."'"
	);
	$user_info = getAllRows('users', $args);
	if(!$user_info){
		$_SESSION['error'] = 'Old password does not match.';
		@header('location: change-password');
		exit;
	}

	if($_POST['new_password'] == $_POST['re_password']){
		$new_password = sha1($_SESSION['email'].$_POST['re_password']);
		
		$data = array('password'=>$new_password);

		$success = updateData('users', $data, $user_id);
		if($success){
			$_SESSION['success'] = "Password has been changed successfully.";
		} else {
			$_SESSION['error'] = "Sorry! There was problem while updating password.";
		}
		@header('location: dashboard');
		exit;
	} else {
		$_SESSION['error'] = 'Password and confirm password does not match.';
		@header('location: change-password');
		exit;	
	}
/*	debugger($user_info);
	debugger($_POST, true);*/
} else {
	$_SESSION['error'] = "Unauthorized access.";
	@header('location: change-password');
	exit;
}