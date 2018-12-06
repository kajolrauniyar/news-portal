
<?php require 'inc/config.php';
      require 'inc/functions.php';
       require 'inc/header.php';
       require 'inc/logincheck.php';?>
<?php
    $act="Add";
    if(isset($_GET,$_GET['id'])&& !empty($_GET['id'])){
        $act="Update";
        $id=(int)$_GET['id'];
        if($id<=0){
            $_SESSION['error']="Invalid advertise Id";
            @header('location:list-advertise');
            exit;
        }
        $cat_info=getadvertiseById($id);
        //debugger($cat_info);
        if(!$cat_info){
             $_SESSION['error']="advertise already deleted or doesnot exists.";
            @header('location:list-advertise');
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
            <h1 class="page-header"><?php echo ucfirst($act);?> Advertisment</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
                    <div class="col-lg-12">
                        <form action="advertise" method="post" enctype="multipart/form-data"  class="form form-horizontal">
                            <div class="form-group row">
                                <label class="col-sm-3">Title: </label>
                                <div class="col-sm-9">
                                    <input type="text" name="title" required class="form-control" id="title"  placeholder=" Advertisement Title" value="<?php echo @$advertisement_info['title'];?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3">Organization Name: </label>
                                <div class="col-sm-9">
                                    <input type="text" name="organization" required class="form-control" id="organization"  placeholder="Organization Name" value="<?php echo @$advertisement_info['organization'];?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3">Summary: </label>
                                <div class="col-sm-9">
                                    <input type="text" name="summary" class="form-control" id="summary"  placeholder="Advertisement Summary" value="<?php echo @$advertisement_info['summary'];?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3">Advertisement Page: </label>
                                <div class="col-sm-9">
                                    <select name="page" required id= "ad_page" class="form-control">
                                        <option disabled <?php if (!isset($_GET, $_GET['id'])) {
                                            echo "selected";
                                        } ?>>--Select Page--</option>

                                        <option value="Home Page" <?php echo (isset($advertisement_info, $advertisement_info['ad_page']) && $advertisement_info['ad_page'] == "Home Page") ? "selected" : '' ; ?>>Home Page</option>

                                        <option value="Inside Page" <?php echo (isset($advertisement_info, $advertisement_info['ad_page']) && $advertisement_info['ad_page'] == "Inside Page") ? "selected" : '' ; ?>>Inside Page</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3">Advertisement Position: </label>
                                <div class="col-sm-9">
                                    <select name="position" required id= "ad_position" class="form-control">
                                         
                                        <option disabled <?php if (!isset($_GET, $_GET['id'])) {
                                            echo "selected";
                                        } ?>>--Select Position--</option>

                                        <option <?php echo (isset($advertisement_info, $advertisement_info['ad_position']) && $advertisement_info['ad_position'] == "TOP of the page") ? "selected" : '' ; ?>>TOP of the page</option>

                                        <option <?php echo (isset($advertisement_info, $advertisement_info['ad_position']) && $advertisement_info['ad_position'] == "MIDDLE of the page") ? "selected" : '' ; ?>>MIDDLE of the page</option>

                                        <option <?php echo (isset($advertisement_info, $advertisement_info['ad_position']) && $advertisement_info['ad_position'] == "FOOTER of the page") ? "selected" : '' ; ?>>FOOTER of the page</option>

                                        <option <?php echo (isset($advertisement_info, $advertisement_info['ad_position']) && $advertisement_info['ad_position'] == "SIDE of the page") ? "selected" : '' ; ?>>SIDE of the page</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3">Status: </label>
                                <div class="col-sm-9">
                                    <select name="status" required id= "status" class="form-control">
                                        
                                        <option disabled <?php if (!isset($_GET, $_GET['id'])) {
                                            echo "selected";
                                        } ?>>--Select Status--</option>

                                        <option <?php echo (isset($advertisement_info, $advertisement_info['status']) && $advertisement_info['status'] == "Active") ? "selected" : '' ; ?>>Active</option>

                                        <option <?php echo (isset($advertisement_info, $advertisement_info['status']) && $advertisement_info['status'] == "Inactive") ? "selected" : '' ; ?>>Inactive</option>
                                        <option <?php echo (isset($advertisement_info, $advertisement_info['status']) && $advertisement_info['status'] == "On Hold") ? "selected" : '' ; ?>>On Hold</option>                                         

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3">Duration For: </label>
                                <div class="col-sm-9">
                                    <input type="number" name="duration_for" min="1" max="30" value="<?php echo @$advertisement_info['ad_duration'];?>"> Days
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3">Display After: </label>
                                <div class="col-sm-9">
                                    <input type="number" name="display_after" min="1" max="30" value="<?php echo @$advertisement_info['ad_display_after'];?>"> Days
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3">Advertisement banner: </label>
                                <div class="col-sm-9">

                                    <input type="file" name="banner" <?php echo isset($advertisement_info['banner_image_name']) && !empty($advertisement_info['banner_image_name'])? '' : "required" ?> class="banner" id="banner" accept="image/*">

                                    <?php  
                                        if (isset($advertisement_info, $advertisement_info['banner_image_name']) && !empty($advertisement_info['banner_image_name']) && file_exists(UPLOAD_DIR.'/'.$advertisement_info['path'].'/'.$advertisement_info['banner_image_name'])) {
                                        ?>

                                        <img src="<?php echo UPLOAD_URL.'/'.$advertisement_info['path'].'/'.$advertisement_info['banner_image_name']; ?>" class="img img-responsive thumbnail" >
                                        <?php
                                        }
                                    ?>


                                    <?php  
                                        if (isset($_GET, $_GET['id'])) {
                                    ?>
                                            <!-- <input type="file" name="thumbnail" accept="image/*"> -->
                                            <input type="hidden" name="old_banner_image_name" value="<?php echo @$advertisement_info['banner_image_name']; ?>">
                                            <input type="hidden" name="last_path" value="<?php echo @$advertisement_info['path'] ?>">
                                            <input type="hidden" name="Advertisement_ID" value="<?php echo @$advertisement_info['id'] ?>">

                                    <?php
                                        }
                                    ?>

                                    <div class="control-buttons">
                                        <div class="btn delete">
                                            <input type="checkbox" name="delete_banner_image" value="<?php echo $advertisement_info['banner_image_name']; ?>"> Delete
                                        </div>
                                    </div>
                                


                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3"></label>
                                <div class="col-sm-9">
                                    <button class="btn btn-danger" type="reset"><i class="fa fa-trash"></i> Cancel</button>
                                    <button class="btn btn-success" type="submit"><i class="fa fa-send"></i> Submit</button>
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