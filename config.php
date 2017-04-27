<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 3/29/2017
 * Time: 5:40 AM
 */

/*
 * DEBUG Set to get different levels of logging.
 * 0 = No debuging
 * 1 = logging only
 * 2 = errors displayed on site.
 * 3 = smarty logging on entire site
 */

define("DEBUG", 2);

if (DEBUG == 2) {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

$base = $_SERVER["DOCUMENT_ROOT"];
session_start();

require 'vendor/autoload.php';
Logger::configure($base . '/../log4php.xml');
$runtime = new Runtime();
$log = Logger::getLogger('Main');
$dev = new \HackSim\Core\Development();
LoggerMDC::put("ipAddress", $dev->get_client_ip());
$sql = new sqlManager(getenv('dbHost'), getenv('dbDatabase'), getenv('dbUser'), getenv('dbPass'));
if (DEBUG > 2) {
    $smarty = new Smarty_HackingSim(true); // set this to true to set smarty debug on
} else {
    $smarty = new Smarty_HackingSim(false); // set this to true to set smarty debug on
}

$config = new PHPAuth\Config($sql->getPdo());
$auth = new userManager($sql);
$commands = new commands($sql);
if(! isset($_SESSION['CommandHistory'])) {
    $_SESSION['CommandHistory'] = '';
}
if(! isset($_SESSION['DisplayData'])) {
    $_SESSION['DisplayData'] = array();
}
$smarty->assignByRef('DisplayData', $_SESSION['DisplayData']);
$extras = new sns_Extras($smarty, $sql, $auth);
$loggedIN = $auth->isLogged();
$smarty->assign('LoggedIn', $loggedIN);
$location = $_SERVER['REQUEST_URI'];
$log->debug($location);
$smarty->assign('location', $location);
$userIP = $extras->getIp();
$smarty->assign('userIP', $userIP);