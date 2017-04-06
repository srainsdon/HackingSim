<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/2/2017
 * Time: 4:09 AM
 */

if (!$auth->isAuthorised('ADMIN_NETWORK')) {
    $smarty->append('bCrumbs', "<span class=\"breadcrumb-item active\">Network List</span>");
    $smarty->assign('alert', 'You are not authorised!!!');
    $smarty->display('main.tpl');
} else {
    if (isset($_POST['new_net'])) {
        $l1 = $_POST['long1'];
        $l2 = $_POST['long2'];
        $name = $_POST['net_name'];
        $res = $sql->addNetwork($l1, $l2, $name);
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