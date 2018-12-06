
<?php
    if(isset($_COOKIE, $_COOKIE['_au']) && !empty($_COOKIE['_au']) && !isset($_SESSION['session_token']))
{


    $remember_token=$_COOKIE['_au'];
    
     $user_by_cookie=getUserByCookie($remember_token);
     
     if($user_by_cookie){
               $_SESSION['session_token']=$remember_token;
               $_SESSION['user_id']=$user_by_cookie['id'];
               $_SESSION['full_name']=$user_by_cookie['full_name'];
               $_SESSION['email']=$user_by_cookie['email'];
                $_SESSION['role']=$user_by_cookie['role'];
               


    }else{
        header('location:logout');
        exit;

    }
}
    //debugger($_SESSION);
    //debugger($_COOKIE,true);

 if(!isset($_SESSION, $_SESSION['session_token']) || empty($_SESSION['session_token'])){
       $_SESSION['error']="please login first";
       @header('location:./');
       exit;
  }

?>
