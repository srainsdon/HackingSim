<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 3/29/2017
 * Time: 5:40 AM
 */

error_reporting(E_ALL);
ini_set("display_errors", 1);
$base = $_SERVER["DOCUMENT_ROOT"];
session_start();

require 'vendor/autoload.php';

$sql = new sqlManager(getenv('dbHost'), getenv('dbDatabase'), getenv('dbUser'), getenv('dbPass'));
$smarty = new Smarty_HackingSim(true); // set this to true to set smarty debug on
$config = new PHPAuth\Config($sql->getPdo());
$auth = new userManager($sql, $config);

$loggedIN = $auth->isLogged();
$smarty->assign('LoggedIn', $loggedIN);
$smarty->assign('session', $_SESSION);
$location = $_SERVER['REQUEST_URI'];
$smarty->assign('location', $location);
$userIP = getIp();
$smarty->assign('userIP', $userIP);

function getIp()
{
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] != '') {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}