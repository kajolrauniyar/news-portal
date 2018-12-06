<!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="dashboard">Admin Panel</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>
                            <?php echo $_SESSION['full_name']?> 
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <a href="change-password"><i class="fa fa-gear fa-fw"></i>Change password</a>
                        </li>
                            <li>    
                                <a href="logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                                <a href="dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard
                                </a>
                        </li>
                        <li class="active">
                                    <a href="#">
                                    <i class="fa fa-list fa-fw"></i>Category Management 
                                    <span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a class="active" href="add-category">Add Category</a>
                                        </li>
                                        <li>
                                            <a href="list-category">List Category</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-second-level -->
                                </li>
                               <li class="active">
                                    <a href="#">
                                    <i class="fa fa-newspaper-o fa-fw"></i>News Management 
                                    <span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a class="active" href="add-news">Add News</a>
                                        </li>
                                        <li>
                                            <a href="list-news">List News</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-second-level -->
                                </li>
                                <li class="active">
                                    <a href="#">
                                    <i class="fa fa-image fa-fw"></i>Gallary Management 
                                    <span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a class="active" href="add-gallery">Add Gallary</a>
                                        </li>
                                        <li>
                                            <a href="list-gallery">List Gallary</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-second-level -->
                                </li>
                                 <li class="active">
                                    <a href="#">
                                    <i class="fa fa-youtube fa-fw"></i>Video Management 
                                    <span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a class="active" href="add-video">Add Video</a>
                                        </li>
                                        <li>
                                            <a href="list-video">List Video</a>
                                        </li>

                                    </ul>
                                    <!-- /.nav-second-level -->
                                </li>
                                 <li class="active">
                                    <a href="#">
                                    <i class="fa fa-users fa-fw"></i>Users Management 
                                    <span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a class="active" href="add-user">Add User</a>
                                        </li>
                                        <li>
                                            <a href="list-user">List User</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-second-level -->
                                </li>
                                 <li class="active">
                                    <a href="#">
                                    <i class="fa fa-dollar fa-fw"></i>Ads Management 
                                    <span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a class="active" href="add-ads">Add Ads</a>
                                        </li>
                                        <li>
                                            <a href="list-ads">List Ads</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-second-level -->
                                </li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>