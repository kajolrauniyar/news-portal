<?php require 'inc/config.php'; ?>
<?php require 'inc/functions.php'; ?>
<?php require 'inc/header.php'; ?>
<?php require 'inc/logincheck.php'; ?>
<?php 
    $act = "add";
    if(isset($_GET, $_GET['id']) && !empty($_GET['id'])){
        $act = "update";
        $id = (int)$_GET['id'];

        if($id <= 0){
            $_SESSION['error'] = "Invalid news Id.";
            @header('location: list-news');
            exit;
        }

        $news_info = getRowByRowId('news', $id);
        if(!$news_info){
            $_SESSION['error'] = "News has been already deleted or does not exists.";
            @header('location: list-news');
            exit;
        }

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
                        <h1 class="page-header"><?php echo ucfirst($act); ?> News</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <form action="news" method="post" enctype="multipart/form-data" class="form form-horizontal">
                            <div class="form-group row">
                                <label for="" class="col-sm-3">Title:</label>
                                <div class="col-sm-9">
                                    <input type="text" name="title" placeholder="Enter News Title" id="title" required value="<?php echo @$news_info['title']; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3">Summary:</label>
                                <div class="col-sm-9">
                                    <textarea name="summary" id="summary" rows="5" style="resize: none;" class="form-control" placeholder="Enter News summary"><?php echo @$news_info['summary']; ?></textarea>
                                </div>
                            </div>
 
                            <div class="form-group row">
                                <label for="" class="col-sm-3">Description:</label>
                                <div class="col-sm-9">
                                    <textarea name="description" id="description" rows="5" style="resize: none;" class="form-control" placeholder="Enter News description"><?php echo @$news_info['description']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3">Category:</label>
                                <div class="col-sm-9">
                                    <select name="category_id" required id="category_id" class="form-control">
                                        <option value="" disabled selected>--Select Any One--</option>
                                        <?php 
                                            $args = array(
                                                'order_by' => ' title ASC '
                                            );
                                            $all_categories = getAllRows('categories', $args);
                                            if($all_categories){
                                                foreach($all_categories as $cat_info){
                                        ?>
                                            <option value="<?php echo $cat_info['id']; ?>" <?php echo (isset($news_info, $news_info['category_id']) && $news_info['category_id'] == $cat_info['id']) ? "selected" : ''; ?>>
                                                <?php echo $cat_info['title'] ?>
                                            </option>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-3">Status:</label>
                                <div class="col-sm-9">
                                    <select name="status" required id="status" class="form-control">
                                        <option value="Published" <?php echo (isset($news_info, $news_info['status']) && $news_info['status'] == "Published") ? 'selected' : '' ?>>Published</option>
                                        <option value="Unpublished" <?php echo (isset($news_info, $news_info['status']) && $news_info['status'] == "Unpublished") ? 'selected' : '' ?>>Unpublished</option>
                                    </select>
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="" class="col-sm-3">Is main:</label>
                                <div class="col-sm-9">
                                    <input type="checkbox" name="is_main" value="1" <?php echo (isset($news_info, $news_info['is_main']) && $news_info['is_main'] == 1) ? "checked" : '' ?>> Yes
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3">Is Breaking:</label>
                                <div class="col-sm-9">
                                    <input type="checkbox" name="is_breaking" value="1" <?php echo (isset($news_info, $news_info['is_breaking']) && $news_info['is_breaking'] == 1) ? "checked" : '' ?>> Yes
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-3">Is Featured:</label>
                                <div class="col-sm-9">
                                    <input type="checkbox" name="is_featured" value="1" <?php echo (isset($news_info, $news_info['is_featured']) && $news_info['is_featured'] == 1) ? "checked" : '' ?>> Yes
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-3" <?php echo (isset($news_info, $news_info['is_trending']) && $news_info['is_trending'] == 1) ? "checked" : '' ?>>Is Trending:</label>
                                <div class="col-sm-9">
                                    <input type="checkbox" name="is_trending" value="1"> Yes
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-3">Reporter:</label>
                                <div class="col-sm-9">
                                    <select name="reporter_id" id="reporter_id" class="form-control">
                                        <option value="" disabled selected>--Select Any One--</option>
                                        <?php 
                                            $args = array(
                                                'where'     => " role = 'Reporter' ",
                                                'order_by'  => " full_name ASC"
                                            );
                                            $reporters = getAllRows('users', $args);
                                            if($reporters){
                                                foreach($reporters as $reporter_data){
                                        ?>
                                            <option value="<?php echo $reporter_data['id']; ?>" <?php echo (isset($news_info, $news_info['reporter_id']) && $news_info['reporter_id'] == $reporter_data['id']) ? "selected" : ''; ?>>
                                                <?php echo $reporter_data['full_name'] ?>
                                            </option>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        
                            <div class="form-group row">
                                <label for="" class="col-sm-3">News Image:</label>
                                <div class="col-sm-4">
                                    <input type="file" name="image" id="image" accept="image/*">
                                </div>
                                <div class="col-sm-4">
                                    <?php 
                                        if(isset($news_info, $news_info['thumbnail']) && !empty($news_info['thumbnail']) && file_exists(UPLOAD_DIR.'/news/'.$news_info['thumbnail'])){
                                        ?>
                                        <img src="<?php echo UPLOAD_URL.'news/'.$news_info['thumbnail']; ?>" alt="" class="img img-thumbnail img-responsive">
                                        <input type="checkbox" name="del_image" value="<?php echo $news_info['thumbnail']; ?>"> Delete
                                        <?php
                                        }
                                    ?>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-3"></label>
                                <div class="col-sm-4">
                                    <input type="hidden" name="news_id" value="<?php echo @$news_info['id']; ?>">
                                    <input type="hidden" name="old_image" value="<?php echo @$news_info['thumbnail']; ?>">

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
<script type="text/javascript" src="<?php echo ASSETS_URL.'ckeditor/ckeditor.js' ?>"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#description' ),{
            ckfinder:{
                uploadUrl:'http://news.loc/cms/assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'

            }
        } );
        

</script>