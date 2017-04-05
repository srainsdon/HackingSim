<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/4/2017
 * Time: 4:27 PM
 */

if (!isset($_SESSION['hash']) && isset($_POST['email'])) {
    $smarty->assign($_POST);
    $_SESSION['hash'] = $auth->login($_POST['email'], $_POST['pass']);
} else {
    $smarty->assign('body', $auth->checkSession($_SESSION['hash']));
}

$smarty->append('bCrumbs', "<span class=\"breadcrumb-item active\">Login</span>");
$smarty->display('login.tpl');