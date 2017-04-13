<?php

/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/13/2017
 * Time: 5:48 AM
 */
class firewall extends service
{
    function setinbound($port,$network) {
        $this->ports['$port']['inbound'] = $network;
    }

}