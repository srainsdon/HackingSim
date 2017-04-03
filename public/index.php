<?php

/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/3/2017
 * Time: 3:24 PM
 */
include_once '../config.php';

if (isset($_GET['cmd'])) {
    switch ($_GET['cmd']) {
        case "computer":
            error_log("Cmd: computer");
            include_once 'computer.php';
            break;
        case "network":
            error_log("Cmd: network");
            include_once 'network.php';
            break;
        default:
            include_once 'home.php';
            break;
    }
} else {
    include_once 'home.php';
}