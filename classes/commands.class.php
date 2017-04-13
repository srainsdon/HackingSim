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

    function addToHistory($message){
        $_SESSION['CommandHistory'] .= $message."\n";
    }
    function ping($originatingIP, $destinationIP)
    {

        $dest = $this->sql->getComputerByIP($destinationIP);
        $this->addToHistory("PING: $destinationIP - " . $dest['ComputerName'] . " from $originatingIP");
        $orig = $this->sql->getComputerByIP($originatingIP);
        foreach ($dest['ComputerServices'] as $service) {
            if ($service['name'] == 'ping'){
                if(isset($service['ports'][1]['inbound'])) {
                    list($ip,$mask) = explode('/', $service['ports'][1]['inbound']);
                    if($this->calculator->cidr_match($originatingIP,$ip,$mask)) {
                        $this->pong();
                    } else {
                        $this->addToHistory("Humm...Not in FireWall");
                    }
                } else {
                    $this->pong();
                }
            }
        }
    }

    function pong()
    {
        $this->addToHistory("PONG!");
    }
}