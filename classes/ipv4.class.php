<?php

//--------------
// IPv4 class
class ipv4
{
    var $address;
    var $cidr;

    //--------------
    // Create new class
    function __construct($address, $cidr = null)
    {
        if (! $cidr) {
            @list($address, $cidr) = explode('/', $address);
        }
        $this->address = $address;
        $this->cidr = $cidr;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return null
     */
    public function getCidr()
    {
        return $this->cidr;
    }

    function getAllAddress()
    {
        $addresses = array();

        // @list($ip, $len) = explode('/', $range);
    $cidr = new cidr();
    $ip = $cidr->cidr2network($this->address,$this->cidr);
    echo "IP: $ip<br />";
        if (($min = ip2long($ip)) !== false) {
            $max = ($min | (1 << (32 - $this->cidr)) - 1);
            for ($i = $min; $i < $max; $i++)
                $addresses[] = long2ip($i);
        }
        return $addresses;
    }
}