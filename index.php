<?php
session_start();

//error reporting on 
@ini_set('error_reporting', E_ALL);
//@ini_set('error_reporting', E_ERROR);
@ini_set('display_errors', '1');

//define the site path
$site_path = realpath(dirname(__FILE__));
define('__SITE_PATH', $site_path);
//echo $site_path;

$_GET['rt'] = (isset($_GET['rt'])) ? $_GET['rt'] : 'home';
$curpage = $_GET['rt'];
if (!defined('CUR_PAGENAME')) {
    define("CUR_PAGENAME", $curpage);
}

//include the init.php file 
include 'includes/init.php';
include 'includes/send_gmail.php';
//include the config file 
include 'config/common.php';
include 'config/database.php';
//include helpers 
include 'helpers/auto_loader.php';
include 'helpers/url_generated.php';
include 'helpers/pagination_calculater.php';
include 'helpers/flashmessage.php';
include 'helpers/string_excerpt.php';
include 'helpers/capcha.php';

$_viewdir = __SITE_PATH . '/views/';
//load router
$registry->router = new router($registry);

$registry->router->setPath(__SITE_PATH . '/controller');

$registry->router->loader();

?>