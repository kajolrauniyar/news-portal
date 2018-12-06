<?php
ob_start();
SESSION_START();

//error_reporting(0);
/***********SITE CONFIGURATION**********/
define("SITE_URL","http://news.loc");
define('CMS_URL',SITE_URL.'/cms/');

define('ASSETS_URL', CMS_URL.'assets/');
define('CSS_URL',ASSETS_URL.'/css/');
define('JS_URL', ASSETS_URL.'js/');

define('SITE_TITLE','Admin Panel news');

/************Database Configuration***********/
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_NAME','news');
define('DB_PASSWORD','');

$conn=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD)OR die('Error establishing database connection.');
mysqli_select_db($conn,DB_NAME);
/************Database Configuration***********/

 define ('ALLOWED_EXTENSIONS',array('jpg','jpeg','png','gif','svg','bmp'));

define('UPLOAD_DIR',$_SERVER['DOCUMENT_ROOT']."upload");
define("UPLOAD_URL",SITE_URL.'/upload/');

?>