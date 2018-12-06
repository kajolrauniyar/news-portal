<?php 
ob_start();
session_start();

// error_reporting(0);
/************ SITE CONFIGURATION ***************/
define("SITE_URL", "http://news.loc");
define('CMS_URL', SITE_URL.'/cms/');

define('ASSETS_URL', SITE_URL.'/assets/');
define('CSS_URL', ASSETS_URL.'css/');
define('JS_URL', ASSETS_URL.'js/');
define('IMAGES_URL', ASSETS_URL.'images/');

define('SITE_TITLE', 'News');

/*************	Database Configuaration   **************/
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_NAME', 'news');
define('DB_PASSWORD', '');

$conn = mysqli_connect(DB_HOST, DB_USER) OR die('Error establishing database connection.');
mysqli_select_db($conn, DB_NAME);
mysqli_query($conn, "SET NAMES utf8");
/*************	Database Configuaration   **************/


define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT']."upload");
define("UPLOAD_URL", SITE_URL.'/upload/');

/*SEO CONTENT*/
define('KEYWORDS', 'nepali online news, news, online news, kantipur, onlinekhabar, image, mountain, nepal, khabar, samachar, news in nepal, live news');
define('DESCRIPTION', 'The first and one and only nepali online news portal in Nepal. We provide you latest news, live news, breaking news, entertainement news, political news and many more news for you.');
define('AUTHOR', 'News Team');