<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 3/29/2017
 * Time: 5:40 AM
 */

error_reporting(E_ALL);
ini_set("display_errors", 1);

require 'vendor/autoload.php';

include_once './classes/sqlManager.class.php';
include_once '../config/db.config.php';
$sql = new sqlManager('34.208.253.55', 'HackingSim', 'srainsdon', 'N0cand0a');
include_once './classes/computer.class.php';
include_once './classes/random.class.php';
include_once './classes/fileSystem.class.php';

// include_once("dBug.php");
