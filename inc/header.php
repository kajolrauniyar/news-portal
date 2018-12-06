<?php
    $current_page=pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="keywords" content="<?php echo (isset($keywords))? $keywords:KEYWORDS; ?>">
    <meta name="description" content="<?php echo (isset($description))? $description: DESCRIPTION; ?>">
    <meta name="author" content="<?php echo (isset($author))? $author: AUTHOR; ?>">

    <meta name="og:title" content="<?php echo (isset($og, $og['title'])) ? $og['title']: SITE_TITLE?>">
 
    <meta name="og:url" content="<?php  echo getCurrentPage();?>">
    <meta name="og:description" content="<?php echo (isset($og, $og['description'])) ? $og['description']:DESCRIPTION?>">
    <meta name="og:image" content="<?php echo (isset($og, $og['images'])) ? $og['images']: IMAGES_URL.'logo.png' ?>">
    <meta name="og:type" content="article">

    <title><?php echo  SITE_TITLE.(isset($title)&& !empty($title) ? "||" .$title :'|| Your Time Yo\'News')?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL;?>reset.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL;?>bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL;?>font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL;?>lightbox.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo CSS_URL;?>main.css" />
    <script src="<?php echo JS_URL; ?>jquery.js"></script>
</head>
<body>
	<header class="main-head">
        <div class="container">
           <div class="row">
               <div class="col-3">
                    <div class="logo">
                        <a href="./">
                             <img src="<?php echo IMAGES_URL; ?>logo.png" class="img img-responsive" style="max-width:100%">
                        </a>
                    </div>
               </div>
              <!--  ads dynamic start --> 
               <?php
               $menu_ad=@getAdvertisementByPosn('above_menu');
               if($menu_ad){
                    if(!empty($menu_ad[0]['image_name']) && file_exists(UPLOAD_DIR.'/advertisments/'.$menu_ad[0]['image_name'])){
                        $thumbnail=UPLOAD_URL.'advertisments/'.$menu_ad[0]['image_name'];
                    }
           
                ?>
           
               <div class="col-9">
                    <a href="<?php echo $menu_ad[0]['link'] ?>">
                        <img src="<?php  echo $thumbnail; ?>" class="img img-responsive" style="max-width:100%" alt="">
                    </a>
               </div>
                <?php 
                }
            ?>

           </div>
        </div>

        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav mr-auto">

                        <li class="nav-item">
                            <a href="./" class="nav-link <?php echo ($current_page=='index')? 'active': ' '?>">
                                <i class="fa fa-home" aria-hidden="true"></i>
                            </a>
                        </li>
                        <?php
                            $menu_items= getMenu();
                            if($menu_items){
                                foreach($menu_items as $cats){


                        ?>
                        <li class="nav-item ">
                            <a href="category?cid=<?php echo $cats['id'] ?>" class="nav-link <?php echo (($current_page== 'category') && ($_GET['cid']==$cats['id'])) ? 'active': ' '?>"><?php  echo  $cats['title']?></a>
                        </li>
                        <?php
                            }

                            }
                        ?>
                    
                       
                    </ul>
                </div>
            </div>
        </nav>
    </header>