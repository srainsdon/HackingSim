<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/26/2017
 * Time: 10:10 AM
 */
$rows = 25;
if (isset($_REQUEST['rows']))
    $rows = $_REQUEST['rows'];

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('../vendor/autoload.php');

$dev = new \HackSim\Core\Development();
echo json_encode($dev->getLogTail());