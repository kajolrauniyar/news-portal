
<?php require 'inc/config.php';
      require 'inc/functions.php';
       require 'inc/header.php';
       require 'inc/logincheck.php';?>
<?php 
    $act = "add";
    if(isset($_GET, $_GET['id']) && !empty($_GET['id'])){
        $act = "update";
        $id = (int)$_GET['id'];

        if($id <= 0){
            $_SESSION['error'] = "Invalid video Id.";
            @header('location: list-video');
            exit;
        }

        $video_info = getRowByRowId('videos', $id);
        if(!$video_info){
            $_SESSION['error'] = "video has been already deleted or does not exists.";
            @header('location: list-video');
            exit;
        }

    }
?>

    <div id="wrapper">

        <?php require 'inc/sidebar.php';?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                     <?php require 'inc/notifications.php';?>
                    <div class="col-lg-12">
                         <h1 class="page-header"><?php echo ucfirst($act); ?> Video</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                  <div class="col-lg-12">
                    <form action="video" method="post" class="form-form-horizontal">
                      <div class="form-group row">
                        <label for="" class="col-sm-3">Video Title:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="title" name="title"  value="<?php echo @$video_info['title']; ?>" required placeholder="Video Title">
                        </div>
                      </div>
                        <div class="form-group row">
                        <label for="" class="col-sm-3">Video Link:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="link" name="link" value="<?php echo @$video_info['link']; ?>" required placeholder="Video Title">
                        </div>
                      </div>
                        <div class="form-group row">
                        <label for="" class="col-sm-3">Status:</label>
                        <div class="col-sm-9">
                            <select name="status" required id="status" class="form-control">
                                <option value="Active" <?php echo (isset($video_info, $video_info['status']) && $video_info['status'] == "Active") ? 'selected' : '' ?>>Active</option>
                                <option value="Inactive" <?php echo (isset($video_info, $video_info['status']) && $video_info['status'] == "Inactive") ? 'selected' : '' ?>>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3"></label>
                        <div class="col-sm-9">
                          <button class="btn btn-danger" type="reset">
                              <i class="fa fa-trash"></i>Cancel
                          </button>
                            <button class="btn btn-success" type="submit">
                              <i class="fa fa-send"></i>Submit
                            </button>
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

     <?php require 'inc/footer.php';?>