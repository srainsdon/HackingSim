<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 3/29/2017
 * Time: 4:36 AM
 */
include_once 'config.php';
header("Content-type:text/plain");
// $sql = new sqlManager();
// $computer = new computer("", "1");
$settings = array(
    "services" => array(
        "ssh" => array(
            'version' => '1.0',
            "users" => array(
                'root' => '1234567890',
                'baduser' => '1234567890'),
            'logging' => array(
                "file" => '/var/log/ssh.log',
                "level" => 'debug'
            )
        ),
        "http" => array(
            "version" => '2.0',
            'logging' => array(
                "file" => '/var/log/apache2.log',
                "level" => 'error'
            )
        )
    ),
    "firewall" => array(
        "ping" => 1,
        22 => 1,
        80 => 1
    )
);
print_r($settings);
echo "\n\n\n\n" . json_encode($settings);
// $computer->fileSystem->showFileSystem();