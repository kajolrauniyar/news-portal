
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
                        <h1 class="page-header">Blank</h1>
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
                                <th>Summary</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Reporter</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php 
                                    $all_news = getAllNews();
                                    if($all_news){
                                        foreach($all_news as $key=>$news_data){
                                    ?>
                                        <tr>
                                            <td><?php echo ($key+1); ?></td>
                                            <td><?php echo $news_data['title']; ?></td>
                                            <td><?php echo $news_data['summary']; ?></td>
                                            <td><?php echo $news_data['category']; ?></td>
                                            <td><?php echo $news_data['status']; ?></td>
                                            <td><?php echo $news_data['reporter']; ?></td>
                                            <td>
                                                <a href="add-news?id=<?php echo $news_data['id']; ?>" class="btn-link">Edit</a>

                                                 / 
                                                <a href="news?id=<?php echo $news_data['id'];?>" class="btn-link" onclick="return confirm('Are you sure you want to delete this news?once deleted it cannot be reverted back. ');">
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


            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

     <?php require 'inc/footer.php';?>