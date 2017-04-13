<?php

/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/12/2017
 * Time: 7:39 PM
 */
class commands
{
    private $sql;
    function __construct(sqlManager &$sql)
    {
        $this->sql = $sql;
    }

    function ping($originatingIP, $destinationIP) {
        $_SESSION['CommandHistory'] .= "PING: $destinationIP from $originatingIP\n";
        $dest = $this->sql->getComputerByIP($destinationIP);
        $orig = $this->sql->getComputerByIP($originatingIP);
        $_SESSION['CommandHistory'] .= print_r($dest);
    }
    function pong() {
        $_SESSION['CommandHistory'] .= "PONG!\n";
    }
}