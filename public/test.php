<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/12/2017
 * Time: 6:25 PM
 */

include_once '../config.php';

$cidr = new cidr();
$ip = new ipv4('28.237.245.45/26');
$netList = $sql->listNets();
foreach ($netList as $row) {
    // echo "<pre>" . print_r($row,true) . "</pre>";
    $netIP = new ipv4($row['NetworkStart'], $row['Subnet']);
    echo $netIP->getAddress() . " " . $row['NetworkName'] . ":";
    $netAll = $netIP->getAllAddress();
    reset($netAll);
    echo count($netAll) . "<br />First: " . current($netAll) . " Last: " . end($netAll);
    echo "<br />";
}
/*
$settings = new appSettings();
$settings->setData('name', 'ssh');
$settings->setData('version', '0.12');
$settings->setPorts(22,"open");
echo $settings->getData();
*/