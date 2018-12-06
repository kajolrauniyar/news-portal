<?php require 'inc/config.php'; ?>
<?php require 'inc/functions.php'; ?>
<?php require 'inc/header.php'; ?>
<?php require 'inc/logincheck.php'; ?>

<div id="wrapper">
    <?php require 'inc/sidebar.php'; ?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <?php require 'inc/notifications.php'; ?>
                <div class="col-lg-12">
                    <h1 class="page-header">Gallery List</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <th>S.N</th>
                            <th>Title</th>
                            <th>Cover Pic</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php 
                                $all_galleries = getAllRows('galleries');
                                if($all_galleries){
                                    foreach($all_galleries as $key=>$gallery_info){
                                    ?>
                                    <tr>
                                        <td><?php echo ($key+1); ?></td>
                                        <td><?php echo $gallery_info['title'] ?></td>
                                        <td>
                                            <?php 
                                            //debugger($gallery_info, true);
                                                if(!empty($gallery_info['cover_pic']) && file_exists($gallery_info['path']."/".$gallery_info['cover_pic'])){
                                                    $path = explode('/', $gallery_info['path']);
                                                    //debugger($path);

                                                    $dir_name = array_pop($path);
                                                    $date = array_pop($path);

                                                    $upload_dir = "gallery/".$date."/".$dir_name;

                                                    // debugger($path, true);
                                                    ?>
                                                    <img style="max-width: 200px" src="<?php echo UPLOAD_URL.$upload_dir.'/'.$gallery_info['cover_pic'] ?>" alt="" class="img img-responsive img-thumbnail">
                                                    <?php
                                                }
                                            ?>
                                            View
                                        </td>
                                        <td><?php echo $gallery_info['status']; ?></td>
                                        <td>
                                            <a href="add-gallery?id=<?php echo $gallery_info['id']; ?>" class="btn-link"> Edit </a>
                                             / Delete 
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

<?php require 'inc/footer.php'; ?>