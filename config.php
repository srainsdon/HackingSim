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
Logger::configure($base . '/../log4php.xml');
$runtime = new Runtime();
$log = Logger::getLogger('Main');
$sql = new sqlManager(getenv('dbHost'), getenv('dbDatabase'), getenv('dbUser'), getenv('dbPass'));
$smarty = new Smarty_HackingSim(false); // set this to true to set smarty debug on
$config = new PHPAuth\Config($sql->getPdo());
$auth = new userManager($sql->getPdo(), $config);
$cmd = new commands($sql);
$extras = new sns_Extras($smarty, $sql, $auth);
$loggedIN = $auth->isLogged();
$smarty->assign('LoggedIn', $loggedIN);
$location = $_SERVER['REQUEST_URI'];
$smarty->assign('location', $location);
$userIP = $extras->getIp();
$smarty->assign('userIP', $userIP);