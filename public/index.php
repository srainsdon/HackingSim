<?php

/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/3/2017
 * Time: 3:24 PM
 */
include_once '../config.php';


if (isset($_GET['data'])) {
    $smarty->assign('data', $_GET['data']);
    $cmd = explode('/', $_GET['data']);
    $smarty->assign('Cmd:', $cmd);
    switch ($cmd[0]) {
        case "admin": {
            switch ($cmd[1]) {
                case
                "computer":
                    error_log("Cmd: computer");
                    include_once 'admin/computer.php';
                    break;
                case "network":
                    error_log("Cmd: network");
                    include_once 'admin/network.php';
                    break;
                default:
                    error_log("Cmd: empty = default");
                    include_once 'admin/home.php';
                    break;
            }
        }
    }
} else {
    error_log("no cmd");
    include_once 'home.php';
}