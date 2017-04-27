<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require '../vendor/autoload.php';

Logger::configure($_SERVER["DOCUMENT_ROOT"] . '/../log4php.xml');
$smarty = new Smarty_HackingSim();
$smarty->append('bCrumbs', "<span class=\"breadcrumb-item active\">Log Reader</span>");
$data = $dev->getLogTail($rows);
$smarty->assign('logs', $data);
$smarty->display('logs.tpl');