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
    public $fileSystem;
    private $settings;
    private $hostName;
    private $domainName;
    private $ip;
    private $id;
    private $pwd;
    private $fs;

    // Offline Data
    private $computers = array(
        1 => array(
            'ip' => "8.8.8.8",
            'hostName' => 'dns-1',
            'domainName' => 'google.com',
            'settings' => '{"services":{"ssh":{"version":"1.0","users":{"root":"1234567890","baduser":"1234567890"},"logging":{"file":"\/var\/log\/ssh.log","level":"debug"}},"http":{"version":"2.0","logging":{"file":"\/var\/log\/apache2.log","level":"error"}}},"firewall":{"ping":1,"22":1,"80":1}}',
            'fileSystem' => '{"var":{"_type":"D","log":{"_type":"D","ssh.log":{"_type":"F","data":"[2017 03 29 23:35] root logged in from 120.52.17.2"}},"www":{"_type":"D","index.html":{"_type":"F","data":"<!-- <html><head><title>Google Dns Server<\/title><\/head><body><h1>Go away.<\/h1><\/body><\/html> -->"}}},"etc":{"_type":"D","bin":{"_type":"D","bind":{"_type":"F","data":"Binary Program Data..."},"apache2":{"_type":"F","data":"Binary Program Data..."}}}}'
        )

    );

    function __construct(sqlManager $sql, $compID, $pwd = '/')
    {
        $info = $sql->getComputerByID($compID);
        $this->id = $compID;
        $this->ip = long2ip($info['ComputerIP']);
        $this->hostName = $info['ComputerHostName'];
        $this->domainName = $info['ComputerDomain'];
        $this->settings = json_decode($info['ComputerSetup'], true);
        $this->fileSystem = new fileSystem(json_decode($info['ComputerFiles'], true), $pwd);
    }

    function save()
    {
        return json_encode(array($this->id, $this->fileSystem->cmd_pwd()));
    }

    /*function __construct($sql, $compID)
    {
            $this->ip = $this->computers[$compID]['ip'];
            $this->hostName = $this->computers[$compID]['hostName'];
            $this->domainName = $this->computers[$compID]['domainName'];
            $this->settings = json_decode($this->computers[$compID]['settings'], true);
            $this->fileSystem = new fileSystem(json_decode($this->computers[$compID]['fileSystem'], true));
    }*/

    function getData()
    {
        return array(
            'host_name' => $this->hostName,
            'domain_name' => $this->domainName,
            'ip_address' => $this->ip,
        );
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