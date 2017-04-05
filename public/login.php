<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/4/2017
 * Time: 4:27 PM
 */

if (!isset($_SESSION['hash']) && isset($_POST['email'])) {
    $smarty->assign('message', print_r($_POST, true));
    $_SESSION['hash'] = $auth->login($_POST['email'], $_POST['pass']);
} elseif (isset($_SESSION['hash'])) {
    $smarty->assign('body', $auth->checkSession($_SESSION['hash']));
}
if (isset($_SESSION)) {
    $smarty->assign('body', print_r($_SESSION, true));
}
$smarty->append('bCrumbs', "<span class=\"breadcrumb-item active\">Login</span>");
$smarty->display('login.tpl');