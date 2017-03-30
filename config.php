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
$base = $_SERVER["DOCUMENT_ROOT"];
include_once '$base/classes/sqlManager.class.php';
include_once '$base/../config/db.config.php';
$sql = new sqlManager('34.208.253.55', 'HackingSim', 'srainsdon', 'N0cand0a');
include_once '$base/classes/computer.class.php';
include_once '$base/classes/random.class.php';
include_once '$base/classes/fileSystem.class.php';

// include_once("dBug.php");
