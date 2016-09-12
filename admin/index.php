<?php

session_start();

/* * * error reporting on ** */
@ini_set('error_reporting', E_ALL);
//@ini_set('error_reporting', E_ERROR);
@ini_set('display_errors', E_ERROR);

/* * * define the site path ** */
$str_root = '/admin';
$site_path = realpath(dirname(__FILE__));
define('__SITE_PATH', substr($site_path, 0, -strlen($str_root)));

if (isset($_GET['rt'])) {
    if ($_GET['rt'] != '') {
        if (isset($_SESSION['user'])) {
            $_GET['rt'] = (isset($_GET['rt'])) ? $_GET['rt'] : 'home';
        } else {
            $_GET['rt'] = (isset($_GET['rt'])) ? $_GET['rt'] : 'login';
        }
    } else {
        if (isset($_SESSION['user'])) {
            $_GET['rt'] = 'home';
        } else {
            $_GET['rt'] = 'login';
        }
    }
} else {
    if (isset($_SESSION['user'])) {
        $_GET['rt'] = (isset($_GET['rt'])) ? $_GET['rt'] : 'home';
    } else {
        $_GET['rt'] = (isset($_GET['rt'])) ? $_GET['rt'] : 'login';
    }
}

$curpage = $_GET['rt'];
if (!defined('CUR_PAGENAME')) {
    define("CUR_PAGENAME", $curpage);
}
//echo $curpage;


/* * * include the init.php file ** */
include '../includes/init.php';
/* * * include the config file ** */
include '../config/common.php';
include '../config/database.php';

$_viewdir = __SITE_PATH . '/admin/views/';
include '../helpers/flashmessage.php';
include '../helpers/url_generated.php';
include '../helpers/pagination_calculater.php';
/* * * load the router ** */
$registry->router = new router($registry);
/* * * set the controller path ** */
$registry->router->setPath(__SITE_PATH . '/admin/controller');

/* * * load the controller ** */
$registry->router->loader();
?>