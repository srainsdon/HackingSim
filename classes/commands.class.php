<?php

/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/12/2017
 * Time: 7:39 PM
 */
class commands
{
    function ping($originatingIP, $destinationIP) {
        $_SESSION['CommandHistory'] .= "PING: $destinationIP from $originatingIP\n";
    }
    function pong() {
        $_SESSION['CommandHistory'] .= "PONG!\n";
    }
}