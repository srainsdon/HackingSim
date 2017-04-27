<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('../vendor/autoload.php');
$configurator = new LoggerConfiguratorDefault();
$config = $configurator->parse($_SERVER["DOCUMENT_ROOT"] . '/../log4php.xml');