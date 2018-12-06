<?php require 'inc/config.php';
      require 'inc/functions.php';
       require 'inc/header.php';
       require 'inc/logincheck.php';?>
<?php
 
 
    $act = "add";
    if (isset($_GET, $_GET['id']) && !empty($_GET['id'])) {
        $act = "update";
        $id = (int)$_GET['id'];
        if ($id <= 0) {
            $_SESSION['error'] = "Invalid News Id.";
            @header('location: list-user');
            exit;
        }
        $user_info = getRowByRowId('users', $id); //first is for table name and second one is for id by passing 
        if (!$user_info) {
            $_SESSION['error'] = "News has been already deleted or does not exist.";
            @header('location: list-user');
            exit;
        }

    }
?>

<div id="wrapper">
    <?php require("./inc/sidebar.php"); ?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid dashboard">
                <div class="row">
                    <?php require 'inc/notifications.php'; ?>
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo ucfirst($act); ?> user</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <form action="users" method="post" enctype="multipart/form-data"  class="form form-horizontal">
                            <div class="row">
                                <div class="col-lg-9">
                                    <?php if (isset($_GET, $_GET['id'])){
                                    ?>
                                    <div class="form-group row">
                                        <label class="col-sm-3">User's ID: </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="title" disabled required class="form-control" id="title" value="<?php echo @$user_info['id'];?>">
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-3">User's Full Name: </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="user_full_name" required class="form-control" id="user_full_name" value="<?php echo @$user_info['full_name'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3">User's Email: </label>
                                        <div class="col-sm-9">
                                            <input type="email" name="email" required class="form-control" id="email" value="<?php echo @$user_info['email'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3">User's Password: </label>
                                        <div class="col-sm-9">
                                            <input type="password" name="password" required class="form-control" id="password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3"> Re Enter User's Password: </label>
                                        <div class="col-sm-9">
                                            <input type="password" name="password_1" required class="form-control" id="password_1">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3"> Role: </label>
                                        <div class="col-sm-9">
                                            <select name="role" required id="role" class="form-control">
                                                <option value="Admin" <?php echo (isset($user_info, $user_info['role']) && $user_info['role'] == "Admin") ? "selected" : ''; ?>>Admin</option>
                                            <option value="Editor" <?php echo (isset($user_info, $user_info['role']) && $user_info['role'] == "Editor") ? "selected" : ''; ?>>Editor</option>
                                            <option value="Reporter" <?php echo (isset($user_info, $user_info['role']) && $user_info['role'] == "Reporter") ? "selected" : ''; ?>>Reporter</option>
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3"> Status: </label>
                                        <div class="col-sm-9">
                                            <select name="status" required id="status" class="form-control">
                                                 <option>Active</option>
                                                 <option>Inactive</option>
                                            </select> 
                                        </div>
                                    </div>
                                
                                    <?php if (isset($_GET, $_GET['id'])){
                                    ?>
                                    <div class="form-group row">
                                        <label class="col-sm-3">Added Date: </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="title" disabled required class="form-control" id="title" value="<?php echo @$user_info['added_date'];?>">
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    
                                </div>
                                <div class="col-lg-9">
                                    <div class="row pb-4">
                                        <div class="col-sm-7 user-image">
                                            <?php if (isset($user_info, $user_info['user_image']) && !empty($user_info['user_image']) && file_exists(UPLOAD_DIR.'/'.'users_photo/'.$user_info['user_image'])){
                                                ?>
                                                <img src="<?php echo UPLOAD_URL.'users_photo/'.$user_info['user_image']; ?>" class="img img-responsive thumbnail" alt="<?php echo @$user_info['full_name'];?>">
                                                <div class="btn delete">
                                                <input type="checkbox" name="delete_user_image" value="<?php echo $user_info['user_image']; ?>"> Delete
                                            </div>
                                                <?php

                                            }else{
                                                ?>
                                                <img src="" class="img img-responsive thumbnail" alt="<?php echo @$user_info['full_name'];?>">
                                                <?php
                                            } 
                                            ?>
                                                
                                        
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <input type="hidden" name="old_user_image" value="<?php echo $user_info['user_image']; ?>">
                                         <input type="hidden" name="user_image_id" value="<?php echo $user_info['id']; ?>">
                                        <div class="col-sm-9">
                                            <input type="file" name="users_photo" id="user_photo" accept="image/*">
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-sm-3"></label>
                                        <div class="col-sm-9">
                                            <button class="btn btn-danger" type="reset"><i class="fa fa-trash"></i> Cancel</button>
                                            <button class="btn btn-success" type="submit"><i class="fa fa-send"></i> Submit</button>
                                        </div>
                                    </div>
                                </div> 
                            </div>  
                        </form>
                    </div> 
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php require("./inc/footer.php") ?>