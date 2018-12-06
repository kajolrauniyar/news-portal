<?php require 'inc/config.php'; 
      require 'inc/functions.php'; 

//debugger($conn);
if(isset($_POST) && !empty($_POST)){
		/*form is submitted*/
		/*echo "<pre>";
		print_r($_POST);
		echo "</pre>";
		exit;*/
		//debugger($_POST);
	$user_name=filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
		//return email or false
	if(!$user_name){
		$_SESSION['error']="USername is not valid.Please enter email user Type.";
		@header('location:./');
		exit;
	}
		//debugger($_POST);
	$enc_password= sha1($user_name.$_POST['password']);

	$user_info=getUserByUserName($user_name);
	//debugger($user_info,true);

	if($user_info){
		if($user_info['password'] == $enc_password){
			if($user_info['status']=="Active"){
				if($user_info['role']=="Admin"){
					/*Successful login*/
					$token=generateRandomStr(100);
					// echo $token;
					$data=array('session_token'=>$token,'remember_token'=>NULL);


					if(isset($_POST['remember']) && $_POST['remember']==1){
						setcookie('_au', $token, (time()+864000), "/");
						$data['remember_token']=$token;
					}
					$_SESSION['session_token']=$token;
					$_SESSION['user_id']=$user_info['id'];
					$_SESSION['full_name']=$user_info['full_name'];
					$_SESSION['email']=$user_info['email'];

					updateLogin($data,$user_info['id']);
					//debugger($data,true);
					$_SESSION['success']="Welcome".$user_info['full_name']."! to admin panel of news.loc";
					@header('location: dashboard');
					exit;

		        }else{
	               	$_SESSION['error'] = "you donot have previlage to access";
					@header('location:./');
					exit;
				}
			}else{
			 	$_SESSION['error'] = "User account is not activated";
		        @header('location:./');
		        exit;
			}
		} else{
			$_SESSION['error'] = "password doesnot match";
			@header('location:./');
			exit;
		}	
	}else{
		$_SESSION['error'] = "username doesnot exist";
		@header('location:./');
		exit;
	}
			//debugger($user_info,true);
} else{
	/*direct access to this file*/
	$_SESSION['error'] = "please login first";
	@header('location:./');
	exit;
}

?>