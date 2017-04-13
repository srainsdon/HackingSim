<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/12/2017
 * Time: 6:25 PM
 */

include_once '../config.php';

$settings = new appSettings();

$settings->setData('version', '0.12');
$settings->setData('port', '5312');
echo $settings->getData();