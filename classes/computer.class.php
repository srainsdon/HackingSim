<?php

/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 3/29/2017
 * Time: 5:29 AM
 */
/*
 * $settings = array(
    "services" => array(
        "ssh" => array(
            "users" => array(
                'version' => '1.0',
                'root' => $pass->getPassword(),
                'baduser' => $pass->getPassword())
        ),
        "http" => array(
            "version" => '1.0'
        )
    ),
    "firewall" => array(
        "ping" => 1,
        22 => 1,
        80 => 1
    )
);
 */

class computer
{
    private $settings;
    public $fileSystem;
    private $hostName;
    private $domainName;
    private $ip;

    /*function __construct(sqlManager $sql, $compID)
    {
        $info = $sql->getComputerByID($compID);
        $this->ip = long2ip($info['ComputerIP']);
        $this->hostName = $info['ComputerHostName'];
        $this->domainName = $info['ComputerDomain'];
        $this->settings = json_decode($info['ComputerSetup'], true);
        $this->fileSystem = new fileSystem(json_decode($info['ComputerFiles'], true));
    }*/

    function __construct(sqlManager $sql, $compID)
    {
        $info = $sql->getComputerByID($compID);
        $this->ip = long2ip($info['ComputerIP']);
        $this->hostName = $info['ComputerHostName'];
        $this->domainName = $info['ComputerDomain'];
        $this->settings = json_decode($info['ComputerSetup'], true);
        $this->fileSystem = new fileSystem(json_decode($info['ComputerFiles'], true));
    }

    function getComputerInfo()
    {
        return array(
            'FullName' => $this->hostName . "." . $this->domainName,
            'IP Address' => $this->ip,
            'Settings' => $this->settings,
            'File System' => $this->fileSystem
        );
    }
}