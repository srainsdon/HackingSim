<?php
require '../config.php';
$router = new AltoRouter();
$router->map('GET|POST', '/', 'home.php','home');
$router->map('GET', '/user/', 'user', 'profile');
// match current request
$match = $router->match();
if ($match) {
    $log->debug($match);
}
if ($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} elseif ($match && is_file($match['target'])) {
    require_once $match['target'];
} else {
    echo "No Match!<br />\n";
}