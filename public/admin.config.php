<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 3/30/2017
 * Time: 1:49 PM
 */

include_once '../config.php';

$commands = new adminCommands(getenv('dbHost'), getenv('dbDatabase'), getenv('dbUser'), getenv('dbPass'));

