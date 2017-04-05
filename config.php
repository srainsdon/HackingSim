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
$smarty = new Smarty_HackingSim;

$config = new PHPAuth\Config($sql->getPdo());
$auth = new PHPAuth\Auth($sql->getPdo(), $config);


if ($auth->isLogged()) {
    $smarty->assign('LogedIn', True);
} else {
    $smarty->assign('LogedIn', False);
}

$smarty->registerPlugin("function", "date_now", "print_current_date");

function print_nav_bar($params, $smarty)
{
    $navMenu = array();
}