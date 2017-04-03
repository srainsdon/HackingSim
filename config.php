<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 3/29/2017
 * Time: 5:40 AM
 */

error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();
$base = $_SERVER["DOCUMENT_ROOT"];
require 'vendor/autoload.php';

function __autoload($className)
{
    $file = $_SERVER["DOCUMENT_ROOT"] . "/classes/$className.class.php";
    if (file_exists($file)) {
        require_once $file;
        return true;
    }
    return false;
}


include_once "$base/db.config.php";
$sql = new sqlManager($host, $db, $user, $pass);

$smarty = new Smarty_HackingSim;

