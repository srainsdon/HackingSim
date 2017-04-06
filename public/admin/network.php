<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/2/2017
 * Time: 4:09 AM
 */

if (!$auth->isAuthorised('ADMIN_NETWORK')) {
    header('HTTP/1.0 403 Forbidden');
    $smarty->append('bCrumbs', "<span class=\"breadcrumb-item active\">Network List</span>");
    $smarty->assign('alert', 'You are not authorised!!!');
    $smarty->display('main.tpl');
} else {
    if (isset($_POST['new_net'])) {
        $net_start = $_POST['net_start'];
        $net_end = $_POST['net_end'];
        $name = $_POST['net_name'];
        $res = $sql->addNetwork($net_start, $net_end, $name);
        if ($res) {
            $smarty->assign('message', $_POST['net_name'] . " Added!!!");
        } else {
            $smarty->assign('alert', "Error: $res");
        }
    }

    $randip = rand(1, 254) . "." . rand(1, 254) . "." . rand(1, 254) . ".";
    $ip1 = $randip . "0";
    $ip2 = $randip . "254";
    $long1 = sprintf('%u', ip2long($ip1));
    $long2 = sprintf('%u', ip2long($ip2));

    $smarty->append('bCrumbs', "<span class=\"breadcrumb-item active\">Network List</span>");
    $smarty->assign('networks', $sql->listNets());
    $smarty->assign('ips', array('ip1' => $ip1, 'ip2' => $ip2, 'long1' => $long1, 'long2' => $long2));
    $smarty->display('network.tpl');
}