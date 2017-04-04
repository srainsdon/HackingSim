<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/4/2017
 * Time: 4:27 PM
 */

if (isset($_POST)) {
    $smarty->assign('message', print_r($auth->login($_POST['email'], $_POST['pass']), true));
    // $_SESSION["favcolor"];
}

$smarty->append('bCrumbs', "<span class=\"breadcrumb-item active\">Login</span>");
$smarty->display('login.tpl');