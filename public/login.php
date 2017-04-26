<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/4/2017
 * Time: 4:27 PM
 */

if (!isset($_COOKIE['authToken']) && isset($_POST['email'])) {
    //list($error, $message, $hash, $expire) = $auth->login($_POST['email'], $_POST['pass']);
    list($error, $message) = $auth->login($_POST['email'], $_POST['pass']);
    if ($error > 0) {
        $smarty->assign('alert', $message);
    } else {
        $smarty->assign('LoggedIn', True);
        $smarty->assign('message', $message);
    }
} elseif (isset($_COOKIE['authToken'])) {
    if (!$auth->isLogged()) {
        setcookie('authToken', "", time() - 3600, '/');
    }
}

$smarty->display('login.tpl');