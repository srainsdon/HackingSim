<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/25/2017
 * Time: 1:06 PM
 */

include_once '../config.php';

$router = new AltoRouter();

$router->map( 'GET', '/', function() {
    phpinfo();
});

$router->map( 'GET', '/[:action]/', function() {
    phpinfo();
} );