<?php require 'inc/config.php';
      require 'inc/functions.php';


$user_id=$_SESSION['user_id'];

session_destroy();
if(isset($_COOKIE['_au'])&& !empty($_COOKIE['_au'])){
	setcookie('_au','',time()-60,"/");
}
//debugger($_SESSION,true);

$data=array(
   'session_token'=>NULL,
   'remember_token'=>NULL
);
updateLogin($data,$user_id);
@header('location:./');
exit;

?>