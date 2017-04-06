<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/4/2017
 * Time: 4:27 PM
 */

if (!isset($_COOKIE['authID']) && isset($_POST['email'])) {
    list($error, $message, $hash, $expire) = $auth->login($_POST['email'], $_POST['pass']);
    $smarty->assign(nl2br('AuthData', "Error: $error\n Message: $message\n Hash: $hash\n Expire: $expire"));
    if ($error > 0) {
        $smarty->assign('alert', $message);
    } else {
        setcookie('authID', $hash, time() + 10 * 60, '/');
        $smarty->assign('LoggedIn', True);
        $smarty->assign('message', $message);
    }
} elseif (isset($_COOKIE['authID'])) {
    if (!$auth->isLogged()) {
        setcookie('authID', "", time() - 3600, '/');
    }
}
$smarty->append('bCrumbs', "<span class=\"breadcrumb-item active\">Login</span>");
$smarty->display('login.tpl');