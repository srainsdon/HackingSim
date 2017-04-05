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
        $smarty->append('bCrumbs', "<a class=\"breadcrumb-item\" href='/admin'>Admin</a>");
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
            /*case "info":
                ob_start();
                phpinfo();
                $strPhpInfo = ob_get_contents();
                ob_clean();
                $smarty->assign('body', $strPhpInfo);
                $smarty->display('main.tpl');
                break;*/
            default:
                include_once 'admin/home.php';
                break;
        }
    } else {

        switch ($cmd[0]) {
            case "login":
                include_once 'login.php';
                break;
            case "logout":
                $auth->logout($_COOKIE['authID']);
                setcookie($_COOKIE['authID'], "", time() - 3600);
                break;
            case "register":
                $smarty->append('bCrumbs', "<span class=\"breadcrumb-item active\">Sign up</span>");
                $smarty->display('login.tpl');
                break;
            default:
                $smarty->append('bCrumbs', "<span class=\"breadcrumb-item active\">Home</span>");
                include_once 'home.php';
                break;
        }
    }
} else {
    $smarty->append('bCrumbs', "<span class=\"breadcrumb-item active\">Home</span>");
    include_once 'home.php';
}