<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once ('../vendor/autoload.php');
$corePDO = \HackSim\Database\core::getInstance();
echo nl2br(print_r(\HackSim\Database\user::getUserData(), true));