<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/4/2017
 * Time: 4:27 PM
 */

if (!isset($_COOKIE['authID']) && isset($_POST['email'])) {
    $loginInfo = $auth->login($_POST['email'], $_POST['pass']);
    $smarty->assign('AuthData', $loginInfo);
    if ($loginInfo['error'] > 0) {
        $smarty->assign('alert', $loginInfo['message']);
    } else {
        setcookie('authID', $loginInfo['hash'], time() + 60 * 60 * 24 * 365, '/');
        $smarty->assign('LogedIn', True);
        $smarty->assign('message', $loginInfo['message']);
    }
} elseif (isset($_COOKIE['authID'])) {
    if (!$auth->isLogged()) {
        setcookie('authID', "", time() - 3600, '/');
    }
}
$smarty->append('bCrumbs', "<span class=\"breadcrumb-item active\">Login</span>");
$smarty->display('login.tpl');