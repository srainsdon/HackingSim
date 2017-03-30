<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 3/29/2017
 * Time: 4:36 AM
 */
include_once 'config.php';
header("Content-type:text/html");

$computer = new computer($sql, "1");
$data = $computer->save();
echo $data;