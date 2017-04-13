<?php

//--------------
// IPv4 class
class ipv4
{
    var $address;
    var $cidr;
    private $classCidr;
    //--------------
    // Create new class
    function __construct($address, $cidr = null)
    {
        $this->classCidr = new cidr();
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

    $startIP = $this->classCidr->cidr2network($this->address,$this->cidr);
    echo "ADDRESS:".$this->address,"|CIDR:".$this->cidr,"|STARTIP:".$startIP."<br />\n";
        if (($min = ip2long($startIP)) !== false) {
            $max = ($min | (1 << (32 - $this->cidr)) - 1);
            for ($i = $min; $i < $max; $i++)
                $addresses[] = long2ip($i);
        }
        array_shift($addresses);
        return $addresses;
    }
}