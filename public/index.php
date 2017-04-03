<?php

/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/3/2017
 * Time: 3:24 PM
 */
include_once '../config.php';


if (isset($_GET['data'])) {
    $cmd = explode('/', $_GET['data'], 1);
    switch ($cmd) {
        case "computer":
            error_log("Cmd: computer");
            include_once 'computer.php';
            break;
        case "network":
            error_log("Cmd: network");
            include_once 'network.php';
            break;
        default:
            error_log("Cmd: empty = default");
            include_once 'home.php';
            break;
    }
} else {
    error_log("no cmd");
    include_once 'home.php';
}