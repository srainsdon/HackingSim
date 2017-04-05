<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/4/2017
 * Time: 4:27 PM
 */

if (!isset($_SESSION['hash']) && isset($_POST['email'])) {
    $message = "";
    $message .= "Post:\n" . print_r($_POST, true);
    $loginInfo = $auth->login($_POST['email'], $_POST['pass']);
    $message .= "Login Info:\n" . print_r($loginInfo, true);
    $_SESSION['hash'] = $loginInfo['hash'];
    $smarty->assign('alert', $loginInfo['message']);
    $message .= "Session:\n" . print_r($_SESSION, True);
    $smarty->assign('message', $message);
} elseif (isset($_SESSION['hash'])) {
    $smarty->assign('message', $auth->checkSession($_SESSION['hash']));
}
if (isset($_SESSION)) {
    $smarty->assign('body', print_r($_SESSION, true));
}
$smarty->append('bCrumbs', "<span class=\"breadcrumb-item active\">Login</span>");
$smarty->display('login.tpl');