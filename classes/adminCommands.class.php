<?php

/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 3/30/2017
 * Time: 1:49 PM
 */
class adminCommands
{
    private $pdo;

    function __construct($host, $db, $user, $pass, $charset = 'utf8')
    {
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $this->pdo = new PDO($dsn, $user, $pass, $opt);
    }

    function createComputer($hostName, $domain, $ipaddress) {
        $sql = "INSERT INTO Computers (ComputerHostName,  ComputerDomain,  ComputerIP)"
                  ." VALUES ('$hostName', '$domain', '".ip2long($ipaddress)."')";
        echo $sql;
        if ($this->pdo->query($sql) === TRUE) {
            $last_id = $this->pdo->insert_id;
            echo "New record created successfully. Last inserted ID is: " . $last_id;
        } else {
            echo "Error: " . $sql . "<br>" . $this->pdo->errorCode();
        }
    }
}