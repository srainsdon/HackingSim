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

function __autoload($className)
{
    $file = $_SERVER["DOCUMENT_ROOT"] . "/classes/$className.class.php";
    error_log("attempt to autoload: $className as $file");
    if (file_exists($file)) {
        require_once $file;
        return true;
    }
    return false;
}

$sql = new sqlManager(getenv('dbHost'), getenv('dbDatabase'), getenv('dbUser'), getenv('dbPass'));
$smarty = new Smarty_HackingSim;

