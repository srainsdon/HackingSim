<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/25/2017
 * Time: 1:06 PM
 */

include_once '../config.php';
$log->debug("Router.php - File");
$router = new AltoRouter();

$router->map( 'GET', '/', function() {
    echo "root";
});

$router->map( 'GET', '/[:action]/', function($action) {
    echo $action;
} );