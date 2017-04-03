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
            include_once 'computer.php';
            break;
        case "network":
            include_once 'network.php';
            break;
    }
} else {
    include_once 'home.php';
}