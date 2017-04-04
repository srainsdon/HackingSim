<?php

/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/3/2017
 * Time: 3:24 PM
 */
include_once '../config.php';

if (isset($_GET['data'])) {
    error_log($_GET['data']);
    $smarty->assign('data', $_GET['data']);
    $cmd = explode('/', $_GET['data']);
    $smarty->assign('Cmd:', $cmd);
    if (isset($cmd[0]) && $cmd[0] == "admin") {
        $smarty->append('bCrumbs', "<a href='/admin'>Admin</a>");
        switch ($cmd[1]) {
            case "computer":
                $computerId = $cmd[2];
                include_once 'admin/computer.php';
                break;
            case "network":
                include_once 'admin/network.php';
                break;
            case "log":
                include_once 'admin/tail.php';
                break;
            default:
                include_once 'admin/home.php';
                break;
        }
    } else {
        switch ($cmd[0]) {
            case "computer":
                $computerId = $cmd[2];
                include_once 'admin/computer.php';
                break;
            case "network":
                include_once 'admin/network.php';
                break;
            default:
                include_once 'home.php';
                break;
        }
    }
} else {
    include_once 'home.php';
}