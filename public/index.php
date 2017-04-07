<?php

/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/3/2017
 * Time: 3:24 PM
 */
include_once '../config.php';

$extras->ACLblacklist();

if (isset($_GET['data'])) {
    $log->debug($_GET['data']);
    $cmd = explode('/', $_GET['data']);
    $smarty->assign('Cmd:', $cmd);
    switch ($cmd[0]) {
        case "admin": { // cmd = /admin/
            $extras->checkACL('ADMIN_DASHBOARD');
            $smarty->append('bCrumbs', "<a class=\"breadcrumb-item\" href='/admin'>Admin</a>");
            switch ($cmd[1]) {
                case "computer": // cmd = /admin/computer/
                    $computerId = $cmd[2];
                    include_once 'admin/computer.php';
                    break;
                case "network": // cmd = /admin/network/
                    include_once 'admin/network.php';
                    break;
                case "log": // cmd = /admin/log/
                    include_once 'admin/logs.php';
                    break;
                case "info": // cmd = /admin/info/
                    phpinfo();
                    break;
                case "dash": {// cmd = /admin/dash/
                    $randoms = array();
                    $tmpArray = array();
                    for ($x = 1; $x <= 30; $x++) {
                        if ($x % 4 != 0) {
                            $tmpArray[] = $auth->getRandomKey(30);
                        } else {
                            $randoms[] = $tmpArray;
                        }
                    }
                    $smarty->assign('strings', $randoms);
                    $smarty->display('main.tpl');
                    break;
                }
                default: {// cmd = /admin/
                    include_once 'admin/adminHome.php';
                }
            }
        }
        case "login": // cmd = /login/
            include_once 'login.php';
            break;
        case "logout": // cmd = /logout/
            $auth->logout($_COOKIE['authID']);
            setcookie($_COOKIE['authID'], "", time() - 3600, '/');
            $smarty->assign('message', "Logged Out. Thank you!!!");
            $smarty->assign('LogedIn', False);
            header('Location: /login/');
            break;
        case "register": // cmd = /register/
            $smarty->append('bCrumbs', "<span class=\"breadcrumb-item active\">Sign up</span>");
            $smarty->display('login.tpl');
            break;
        case "api": { // cmd = /api/
            include_once 'api.php';
        }
        default:
            $smarty->append('bCrumbs', "<span class=\"breadcrumb-item active\">Home</span><!-- Default of First Folder -->");
            include_once 'home.php';
            break;
    }
} else {
    $smarty->append('bCrumbs', "<span class=\"breadcrumb-item active\">Home</span><!-- final else of index.php -->");
    include_once 'home.php';
}