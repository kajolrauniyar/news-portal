
<?php require 'inc/config.php';
      require 'inc/functions.php';
       require 'inc/header.php';
       require 'inc/logincheck.php';?>


    <div id="wrapper">

        <?php require 'inc/sidebar.php';?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                     <?php require 'inc/notifications.php';?>
                    <div class="col-lg-12">
                        <h1 class="page-header">Change Password</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <form action="password-process" class="form form-horizontal" method="post">
                        <div class="form-group">
                            <label for="" class="col-sm-3">Old Password:</label>
                            <div class="col-sm-9">
                                <input type="text" name="old_password" id="old_password"> 
                            </div>
                      </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3">New Password:</label>
                            <div class="col-sm-9">
                                <input type="text" name="new_password" id="new_password"> 
                            </div>
                      </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3">Re Password:</label>
                            <div class="col-sm-9">
                                <input type="text" name="re_password" id="re_password"> 
                            </div>
                            <span class="hidden alert-danger" id="password_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3"></label>
                            <div class="col-sm-9">
                                <button class="btn btn-danger" id="reset" type="reset">
                                    <i class="fa fa-trash"></i>Cancel
                                </button>
                                 <button class="btn btn-success" id="submit" type="submit" disabled>
                                    <i class="fa fa-send"></i>Submit
                                </button>
                            </div>
                        </div>
                    </form>
                    
                  </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

     <?php require 'inc/footer.php';?>

     <script>
        //document.getElementById('new_password')or
        //$('#new_password')
         $('#re_password').keyup(function(){
            var password = $('#new_password').val();
            var re_pass = $('#re_password').val();

            if(password == ''){
                $('#password_error').html('password field cannot be empty');
                $('#password_error').removeClass('hidden');
            }
            if(re_pass != password){
                $('#password_error').html('password and repassword doesnot match');
                $('#password_error').removeClass('hidden');
                $('#submit').attr('disabled','disabled');
            }else{
                 $('#password_error').html('');
                $('#password_error').addClass('hidden');
                $('#submit').removeAttr('disabled','disabled');

            }
            //alert(password);
            console.log(password);

         });
     </script>