<?php

/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 3/29/2017
 * Time: 4:59 AM
 */
class sqlManager
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

    function addNetwork($l1, $l2, $name)
    {
        $sql = "INSERT INTO `HackingSim`.`Networks` (`NetworkStart`, `NetworkEnd`, `NetworkName`) VALUES ('$l1', '$l2', '$name');";
        $result = $this->pdo->exec($sql);
        return $result;
    }

    function listNets()
    {
        $sql = "SELECT `NetworkID`, inet_ntoa(`NetworkStart`) as NetworkStart, inet_ntoa(`NetworkEnd`) as NetworkEnd, `NetworkName` from Networks";
        $result = $this->pdo->query($sql)->fetchAll();
        return $result;
    }

    function getFixedIPs()
    {
        $sql = "select c.ComputerID, c.ComputerIP, c.ComputerHostName, n.NetworkName, n.NetworkStart, n.NetworkEnd from Computers as c, Networks as n where c.ComputerNetwork = n.NetworkID and ( c.ComputerIP < n.NetworkStart or c.ComputerIP > n.NetworkEnd)";
        $result = $this->pdo->query($sql)->fetchAll();
        return $result;
    }

    function getAllComputers()
    {
        $sql = "select Computers.ComputerID, concat(Computers.ComputerHostName, '.', Computers.ComputerDomain) as ComputerName, Computers.ComputerHostName, Computers.ComputerDomain, INET_NTOA(Computers.ComputerIP) as ComputerIP, Networks.NetworkName from Computers , Networks where Computers.ComputerNetwork = Networks.NetworkID";;
        $result = $this->pdo->query($sql)->fetchAll();
        return $result;
    }

    function getComputerByID($id)
    {
        $stmt = $this->pdo->query("SELECT Computers.ComputerID, CONCAT(Computers.ComputerHostName, '.', Computers.ComputerDomain) AS ComputerName, Computers.ComputerHostName, Computers.ComputerDomain, INET_NTOA(Computers.ComputerIP) AS ComputerIP, Networks.NetworkID FROM Computers, Networks WHERE Computers.ComputerNetwork = Networks.NetworkID and Computers.ComputerID = $id");
        $computer = $stmt->fetch();
        return $computer;
    }

    function getNetworkList()
    {
        $sql = "SELECT NetworkID, CONCAT(NetworkName, ' - ', CAST(INET_NTOA(NetworkStart) AS CHAR), ' - ', CAST(INET_NTOA(NetworkEnd) AS CHAR)) AS NetName FROM Networks";
        $result = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function addComputer($hostName, $domain, $ipaddress, $networkID)
    {
        $sql = "INSERT INTO Computers (ComputerHostName,  ComputerDomain,  ComputerIP, ComputerNetwork)"
            . " VALUES ('$hostName', '$domain', INET_ATON($ipaddress), $networkID)";
        if ($this->pdo->query($sql) == FALSE) {
            return "Error: $sql<br />\n" . $this->pdo->errorCode();
        } else {
            return TRUE;
        }
    }
}