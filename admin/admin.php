<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 3/30/2017
 * Time: 5:52 AM
 */

include_once '../config.php';
session_start();
$computer = new computer($sql, "1");
$data = $computer->getData();

$smarty->assign('data', $data);
$smarty->display('computer.tpl');