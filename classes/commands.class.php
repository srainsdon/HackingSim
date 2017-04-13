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
    private $calculator;

    function __construct(sqlManager &$sql)
    {
        $this->calculator = new calculator();
        $this->sql = $sql;
    }

    function ping($originatingIP, $destinationIP)
    {
        $_SESSION['CommandHistory'] .= "PING: $destinationIP from $originatingIP\n";
        $dest = $this->sql->getComputerByIP($destinationIP);
        $orig = $this->sql->getComputerByIP($originatingIP);
        foreach ($dest['ComputerServices'] as $service) {
            if ($service['name'] == 'ping'){
                if(isset($service['ports'][1]['inbound'])) {
                    list($ip,$mask) = explode('/', $service['ports'][1]['inbound']);
                    if($this->calculator->cidr_match($originatingIP,$ip,$mask)) {
                        $this->pong();
                    } else {
                        $_SESSION['CommandHistory'] .= 'Humm...\n';
                    }
                }
            }
        }
        $_SESSION['CommandHistory'] .= print_r($dest,true);
    }

    function pong()
    {
        $_SESSION['CommandHistory'] .= "PONG!\n";
    }
}