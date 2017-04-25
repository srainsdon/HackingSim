<?php
require '../vendor/autoload.php';
$router = new AltoRouter();
$router->map('GET|POST', '/', 'home', 'home');
$router->map('GET', '/user/[:action]/', function ($action) {
    echo "Action: $action<br />\n";
    echo "<pre>" . var_dump($match, true) . "</pre>";
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