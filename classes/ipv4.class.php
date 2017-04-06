<?php

//--------------
// IPv4 class
class ipv4
{
    var $address;
    var $netbits;

    //--------------
    // Create new class
    function __construct($address, $netbits)
    {
        $this->address = $address;
        $this->netbits = $netbits;
    }

    //--------------
    // Return the IP address
    function address()
    {
        return ($this->address);
    }

    //--------------
    // Return the netbits
    function netbits()
    {
        return ($this->netbits);
    }

    //--------------
    // Return the netmask

    function broadcast()
    {
        return (long2ip(ip2long($this->network())
            | (~(ip2long($this->netmask())))));
    }

    //--------------
    // Return the network that the address sits in

    function network()
    {
        return (long2ip((ip2long($this->address))
            & (ip2long($this->netmask()))));
    }

    //--------------
    // Return the broadcast that the address sits in

    function netmask()
    {
        return (long2ip(ip2long("255.255.255.255")
            << (32 - $this->netbits)));
    }

    //--------------
    // Return the inverse mask of the netmask

    function inverse()
    {
        return (long2ip(~(ip2long("255.255.255.255")
            << (32 - $this->netbits))));
    }

}