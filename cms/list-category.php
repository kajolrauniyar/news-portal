
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
                <h1 class="page-header">LIST CATEGORY</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-hover">
                    <thead>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Summary</th>
                        <th>Status</th>
                        <th>Thumbnail</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php $all_categories=getAllCategories();
                                if($all_categories){
                                    //debugger($all_categories);
                                    foreach($all_categories as $key=>$Category_info){
                                    ?>
                                    <tr>
                                        <td><?php echo($key+1);?></td>
                                        <td><?php echo $Category_info['title'];?></td>
                                        <td><?php echo $Category_info['summary'];?></td>
                                        <td><?php echo $Category_info['status'];?></td>
                                        <td><?php
                                            //echo UPLOAD_DIR.'/category/'.$Category_info['image'];
                                                if(!empty($Category_info['image'])&& file_exists(UPLOAD_DIR.'/category/'.$Category_info['image'])){
                                                        ?>
                                                    <img src="<?php echo UPLOAD_URL.'category/'.$Category_info['image'];?>" alt="" class="img-responsive img-thumbnail" style="max-width: 150px;">
                                                    <?php
                                                     } 
                                             ?>
                                                 
                                             </td>
                                        <td>
                                            <a href="add-category?id=<?php echo $Category_info['id'];?>"class="btn-link">
                                                Edit
                                            </a>
                                              /
                                            <a href="category?id=<?php echo $Category_info['id'];?>" class="btn-link" onclick="return confirm('Are you sure you want to delete this category?once deleted it cannot be reverted back. ');">
                                              <i class="fa fa-trash"></i>Delete
                                             </a>
                                        </td>
                                    </tr>
                                     <?php   
                                }

                                }else{
                                    echo"<tr>
                                        <td colspan='6'>No Category</tr>";

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