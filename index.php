<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 3/29/2017
 * Time: 4:36 AM
 */
include_once 'config.php';
header("Content-type:text/plain");
$sql = new sqlManager();
$computer = new computer($sql, "3");
$computer->fileSystem->showFileSystem();