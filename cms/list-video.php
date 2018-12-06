
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
                        <h1 class="page-header">List Video</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered table-hover">
                        <thead>
                            <th>S.N</th>
                            <th> Video Title</th>
                            <th>Video link</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php 
                                    $all_video = getallRows('videos');
                                    if($all_video){
                                        foreach($all_video as $key=>$video_data){
                                    ?>
                                        <tr>
                                            <td><?php echo ($key+1); ?></td>
                                            <td><?php echo $video_data['title']; ?></td>
                                            <td><a href=""><?php echo $video_data['link']; ?></a></td>
                                            <td><?php echo $video_data['status']; ?></td>
                                            <td>
                                                <a href="add-video?id=<?php echo $video_data['id']; ?>" class="btn-link">Edit</a>

                                                 / 
                                                <a href="video?id=<?php echo $video_data['id'];?>" class="btn-link" onclick="return confirm('Are you sure you want to delete this video?once deleted it cannot be reverted back. ');">
                                              <i class="fa fa-trash"></i>Delete
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
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

     <?php require 'inc/footer.php';?>