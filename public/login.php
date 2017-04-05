<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/4/2017
 * Time: 4:27 PM
 */

if (!isset($_COOKIE['authID']) && isset($_POST['email'])) {
    $message = "";
    $message .= "Post:\n" . print_r($_POST, true);
    $loginInfo = $auth->login($_POST['email'], $_POST['pass']);
    $message .= "Login Info:\n" . print_r($loginInfo, true);
    setcookie('authID', $loginInfo['hash'], time() + 60 * 60 * 24 * 365, '/');
    $smarty->assign('alert', $loginInfo['message']);
    $message .= "Session:\n" . print_r($_COOKIE, True);
    $smarty->assign('message', $message);
} elseif (isset($_COOKIE['authID'])) {
    $message = "Is COOKIE['authID'] Good. " . $auth->checkSession($_COOKIE['authID']) . " Is Logged In? " . $auth->isLogged() . "\n";
    $message .= "Post:\n" . print_r($_POST, true);
    $message .= "Login Info:\n" . print_r($loginInfo, true);
    $message .= "Session:\n" . print_r($_COOKIE, True);
    $smarty->assign('message', $message);
}
if (isset($_COOKIE)) {
    $smarty->assign('body', print_r($_COOKIE, true));
}
$smarty->append('bCrumbs', "<span class=\"breadcrumb-item active\">Login</span>");
$smarty->display('login.tpl');