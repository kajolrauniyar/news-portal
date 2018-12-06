
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
            $_SESSION['error']="Invalid category Id";
            @header('location:list-category');
            exit;
        }
        $cat_info=getCategoryById($id);
        //debugger($cat_info);
        if(!$cat_info){
             $_SESSION['error']="Category already deleted or doesnot exists.";
            @header('location:list-category');
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
            <h1 class="page-header"><?php echo ucfirst($act);?> CATEGORY</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <form action="category" method="post" enctype="multipart/form-data" class="form form-horizontal">
                <div class="form-group row">
                    <label for="" class="col-sm-3">Category Title:</label>
                        <div class="col-sm-9">
                            <input type="text" name="title" class="form-control" placeholder="Enter Category title" id="title"required value="<?php echo @$cat_info['title'];?>">
                        </div>
                    
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3">Summary: </label>
                        <div class="col-sm-9">
                            <textarea name="summary" id="summary" placeholder="This is news summary" rows="5" style="resize:none;"
                            class="form-control"><?php echo @$cat_info['summary'];?></textarea>
                        </div>
                   
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3">Status: </label>
                        <div class="col-sm-9">
                            <select name="status" id="status" class="form-control">
                                <option value="Active"<?php echo (isset($cat_info,$cat_info['status'])&& $cat_info['status']=="Active")? "selected":"";?>>Active</option>
                                <option value="Inactive"<?php echo (isset($cat_info,$cat_info['status'])&& $cat_info['status']=="Inactive")? "selected":"";?>>
                                  Inactive
                                </option>
                            </select> 
                        </div>   
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3">Image: </label>
                        <div class="col-sm-4">
                            <input type="file" name="image" id="image">  
                        </div>
                        <div class="col-sm-4">
                            <?php
                                if(isset($cat_info,$cat_info['image'])&& !empty($cat_info['image'])&& file_exists(UPLOAD_DIR.'/category/'.$cat_info['image'])){
                                ?>
                                <img src="<?php echo UPLOAD_URL.'category/'.$cat_info['image'];?>" alt="" class="img img-thumbnail img-responsive">
                                <input type="checkbox" name="del_image" value="<?php echo $cat_info['image'];  ?>">Delete
                                <?php



                                }
                            ?>

                      
                        </div>
                   
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3"></label>
                        <div class="col-sm-9">
                            <input type="hidden" name="category_id" value="<?php echo @$cat_info['id'];?>">
                            <input type="hidden" name="old_image" value="<?php echo @$cat_info['image'];?>">
                            <button class="btn btn-danger" type="reset">
                                <i class="class fa-fa-trash"></i>Cancle
                            </button>
                              <button class="btn btn-success" type="submit">
                                <i class="class fa-fa-send"></i>Submit
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