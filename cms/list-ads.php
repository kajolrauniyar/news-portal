
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
                <h1 class="page-header">LIST Ads</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
      
            <div class="row">
                    <div class="col-lg-12">
                        <table class=" table table-bordered table-hover table-responsive">
                            <thead>
                                <th>S.N</th>
                                <th>Title</th>
                                <th>Organization Name</th>
                                <th>Status</th>
                                <th>ad banner</th>
                                <th>Action</th>
                            </thead>
                            <tbody  class="advertisement-image">
                                <?php  
                                    $all_advertisements = getAllAdvertisements(); 
                                    //debugger($all_advertisements, true);
                                    //exit;
                                    if ($all_advertisements) {
                                        foreach ($all_advertisements as $key => $ad_data) {
                                            ?>
                                            <tr>
                                            <td><?php echo ($key+1); ?></td>
                                            <td><?php echo $ad_data['title']; ?></td>
                                            <td><?php echo $ad_data['organization']; ?></td>
                                            <td><?php echo $ad_data['status']; ?></td>
                                            <td>
                                                <?php                                               
                                                    if (!empty($ad_data['banner_image_name']) && file_exists(UPLOAD_DIR.'/'.$ad_data['path']."/".$ad_data['banner_image_name'])) {

                                                     
                                                ?>
                                                <img src="<?php echo UPLOAD_URL.$ad_data['path']."/".$ad_data['banner_image_name']; ?>">
                                                <?php
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="add-advertise?id=<?php echo $ad_data['id']; ?>">
                                                <button class="btn">
                                                    <i class="fas fa-edit"></i> 
                                                    Edit
                                                </button>
                                            </a> 

                                            <a href="advertise?id=<?php echo $ad_data['id']; ?>" onclick="return confirm('Do you want to delete this Advertisement ?');">
                                                <button class="btn btn-warning">
                                                    <i class="fa fa-trash"></i> 
                                                    Delete
                                                </button>
                                            </a>
                                            </td>
                                            </tr>
                                        <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php require 'inc/footer.php';?>