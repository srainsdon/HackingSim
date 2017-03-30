<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 3/30/2017
 * Time: 1:49 PM
 */

include_once '../config.php';

include_once "$base/classes/adminCommands.class.php";

$commands = new adminCommands($host, $db, $user, $pass);

