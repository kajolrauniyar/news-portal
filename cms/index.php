<?php require 'inc/config.php';
       require 'inc/functions.php';
          require 'inc/header.php';
           require 'inc/notifications.php';


  if(isset($_SESSION, $_SESSION['session_token']) && !empty($_SESSION['session_token'])){
       @header('location: dashboard');
       exit;
  }

  if(isset($_COOKIE, $_COOKIE['_au']) && !empty($_COOKIE['_au'])){


      // debugger($_SESSION,true);
       //debugger($_COOKIE,true);

       @header('location: dashboard');
       exit;
  }






?>




















    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                       
                        <form role="form" method="post" action="login">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" required autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" required>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="1">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-lg btn-success btn-block" type="submit">Login</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <?php require 'inc/footer.php';?>
