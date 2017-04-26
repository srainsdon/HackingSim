<?php
require '../config.php';
$router = new AltoRouter();
$router->map('GET|POST', '/', 'home.php','home');
$router->map('GET', '/user/', 'user', 'profile');
$router->map('GET|POST', '/user/logout/', function (){
    setcookie($_COOKIE['authID'], "", time() - 3600, '/');
    header('Location: /login/');
}, 'logout');
$router->map('GET|POST', '/user/login/', 'login.php', 'login');
$router->map('GET|POST', '/user/register/', 'login.php', 'register');
// match current request
$match = $router->match();
$log->debug($match);
if ($match) {
    $log->debug($match);
}
if ($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} elseif ($match && is_file($match['target'])) {
    require_once $match['target'];
} else {
    header("HTTP/1.0 404 Not Found");
    $smarty->assign('bCrumbs', "<span class=\"breadcrumb-item active\">File Not Found</span>");
    $smarty->display('404.tpl');
}