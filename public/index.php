<?php
require '../config.php';
$router = new AltoRouter();
$router->map('GET|POST', '/', function ($action) {
    require_once "home.php";
});
$router->map('GET', '/user/[:action]/', function ($action) {
    echo "Action: $action<br />\n";
});
// match current request
$match = $router->match();
if ($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} elseif ($match) {
    ?>
    <h1>AltoRouter</h1>

    <h3>Current request: </h3>
    <pre>
<?php var_dump($match); ?>
</pre>

<?php } else {
    echo "No Match!<br />\n";
}