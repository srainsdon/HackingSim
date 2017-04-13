<?php

//--------------
// IPv4 class
class ipv4
{
    private $address;
    private $cidr;
    private $calculator;
    private $subNetID;
    private $broadcastIP;
    //--------------
    // Create new class
    function __construct($address, $cidr = null)
    {
        $this->calculator = new calculator();
        if ($cidr == null) {
            @list($address, $cidr) = explode('/', $address);
        }
        $this->address = $address;
        $this->cidr = $cidr;

        $this->subNetID = $this->calculator->cidr2network($this->address,$this->cidr);
        // echo "ADDRESS:".$this->address,"|CIDR:".$this->cidr,"|STARTIP:".$startIP."<br />\n";
        if (($min = ip2long($this->subNetID)) !== false) {
            $max = ($min | (1 << (32 - $this->cidr)) - 1);
            $this->broadcastIP = long2ip($max+1);
//            for ($i = $min; $i < $max; $i++)
//                $addresses[] = long2ip($i);
        }
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

    /**
     * @return string
     */
    public function getBroadcastIP()
    {
        return $this->broadcastIP;
    }

    /**
     * @return string
     */
    public function getSubNetID()
    {
        return $this->subNetID;
    }

    function __debugInfo()
    {
        // TODO: Implement __debugInfo() method.
    }
}