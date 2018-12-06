<?php require 'inc/config.php'; ?>
<?php require 'inc/functions.php'; ?>
<?php require 'inc/header.php'; ?>
<?php require 'inc/logincheck.php'; ?>

<?php 
    $act = "add";
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $act = "update";
        $id = (int)$_GET['id'];
        
        $gallery_info = getAllRows('galleries',array('where'=> 'id = '.$id));
        if(!$gallery_info){
            $_SESSION['error']  = "Gallery not found";
            @header('location: list-gallery');
            exit;
        }

        $gallery_images = getAllRows('gallery_images', array('where'=>'gallery_id = '.$id));
    }

?>

    <div id="wrapper">

        <?php require 'inc/sidebar.php'; ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <?php require 'inc/notifications.php'; ?>
                    <div class="col-lg-12">
                        <h1 class="page-header">Add Gallery</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

                <div class="row">
                	<div class="col-lg-12">
                		<form action="gallery" method="post" enctype="multipart/form-data" class="form form-horizontal">
                			<div class="form-group row">
                				<label for="" class="col-sm-3">Title:</label>
                				<div class="col-sm-9">
                					<input type="text" name="title" required class="form-control" id="title" value="<?php echo @$gallery_info[0]['title']; ?>">
                				</div>
                			</div>
                			<div class="form-group row">
                				<label for="" class="col-sm-3">Description:</label>
                				<div class="col-sm-9">
                					<textarea name="description" id="description"  rows="5" style="resize: none;" class="form-control"><?php echo @$gallery_info[0]['description']; ?></textarea>
                				</div>
                			</div>

                			<div class="form-group row">
                				<label for="" class="col-sm-3">Status:</label>
                				<div class="col-sm-9">
                					<select name="status" id="status" class="form-control">
                						<option value="Active">Active</option>
                						<option value="Inactive">Inactive</option>
                					</select>
                				</div>
                			</div>

                			<div class="form-group row">
                				<label for="" class="col-sm-3">Thumbnail:</label>
                				<div class="col-sm-5">
                					<input type="file" name="thumbnail" <?php echo ($act=='update') ? '' : 'required'; ?> id="thumbnail" accept="image/*">
                				</div>
                                <div class="col-sm-4">
                                    <?php 
                                        
                                        if($act == 'update'){
                                            $path = explode('/', $gallery_info[0]['path']);
                                            //debugger($path);

                                            $dir_name = array_pop($path);
                                            $date = array_pop($path);

                                            $upload_dir = "gallery/".$date."/".$dir_name;

                                            if(isset($gallery_info) && !empty($gallery_info[0]['cover_pic']) && file_exists($gallery_info[0]['path']."/".$gallery_info[0]['cover_pic'])){

                                                // debugger($path, true);
                                                ?>
                                                <img src="<?php echo UPLOAD_URL.$upload_dir.'/'.$gallery_info[0]['cover_pic'] ?>" alt="" class="img img-responsive img-thumbnail">
                                                <?php
                                            }
                                        }
                                    ?>
                                </div>
                			</div>
                			
                			<div class="form-group row">
                				<label for="" class="col-sm-3">Other Images:</label>
                				<div class="col-sm-9">
                					<input type="file" name="other_images[]" multiple id="other_images" accept="image/*">
                				</div>
                			</div>

                            <?php 
                                if(isset($gallery_images) && !empty($gallery_images)){
                                ?>
                            <div class="form-group row">
                                <?php 
                                    $counter = 1;
                                    //debugger($gallery_images);
                                    foreach($gallery_images as $images_list){
                                ?>
                                    <div class="col-sm-3">
                                        <?php 
                                            if(!empty($images_list['image_name']) && file_exists($gallery_info[0]['path']."/".$images_list['image_name'])){
                                        ?>
                                            <img src="<?php echo UPLOAD_URL.$upload_dir.'/'.$images_list['image_name']; ?>" alt="" class="img img-thumbnail img-reponsive">
                                            <input type="checkbox" name="del_image[]" value="<?php echo $images_list['image_name']; ?>"> Delete
                                        <?php
                                            }
                                        ?>
                                    </div>
                                <?php
                                    if($counter%4 == 0){
                                        echo "<div class='clearfix'></div>";
                                    }
                                    $counter++;
                                    }
                                ?>
                            </div>
                                <?php
                                }
                            ?>


                			<div class="form-group row">
                				<label for="" class="col-sm-3"></label>
                				<div class="col-sm-9">
                                    <input type="hidden" name="gallery_id" value="<?php echo @$gallery_info[0]['id'] ?>">
                                    <input type="hidden" name="gallery_path" value="<?php echo @$upload_dir; ?>">
                					<button class="btn btn-danger" type="reset">
                						<i class="fa fa-trash"></i> Cancel
                					</button>
                					<button class="btn btn-success" type="submit">
                						<i class="fa fa-send"></i> Submit
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

<?php require 'inc/footer.php'; ?>