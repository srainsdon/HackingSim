<?php
require '../config.php';
$router = new AltoRouter();
$router->map('GET|POST', '/', function () {
    require_once "home.php";
});
$router->map('GET', '/user/[:action]/', function ($action) {
    echo "Action: $action<br />\n";
});
// match current request
$match = $router->match();
if ($match) {
    echo "<h1>AltoRouter</h1>"
        . "<h3>Current request: </h3>"
        . "<pre>" . print_r($match, true) . "</pre>";
}
if ($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    echo "No Match!<br />\n";
}