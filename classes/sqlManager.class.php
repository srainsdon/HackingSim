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
        $sql = "SELECT `NetworkID`, inet_ntoa(`NetworkStart`) AS NetworkStart, inet_ntoa(`NetworkEnd`) AS NetworkEnd, `NetworkName` FROM Networks";
        $result = $this->pdo->query($sql)->fetchAll();
        return $result;
    }

    function getFixedIPs()
    {
        $sql = "SELECT c.ComputerID, c.ComputerIP, c.ComputerHostName, n.NetworkName, n.NetworkStart, n.NetworkEnd FROM Computers AS c, Networks AS n WHERE c.ComputerNetwork = n.NetworkID AND ( c.ComputerIP < n.NetworkStart OR c.ComputerIP > n.NetworkEnd)";
        $result = $this->pdo->query($sql)->fetchAll();
        return $result;
    }

    function getAllComputers()
    {
        $sql = "SELECT Computers.ComputerID, concat(Computers.ComputerHostName, '.', Computers.ComputerDomain) AS ComputerName, Computers.ComputerHostName, Computers.ComputerDomain, INET_NTOA(Computers.ComputerIP) AS ComputerIP, Networks.NetworkName FROM Computers , Networks WHERE Computers.ComputerNetwork = Networks.NetworkID";;
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
            . " VALUES ('$hostName', '$domain', INET_ATON('$ipaddress'), $networkID)";
        if ($this->pdo->query($sql) != TRUE) {
            return "Error: $sql<br />\n" . $this->pdo->errorCode();
        } else {
            return TRUE;
        }
    }

    function updateComputer($postData)
    {
        if ($this->isIPinNetwork($postData['ComputerIP'], $postData['NetworkID'])) {
            foreach ($postData as $key => $value) {
                if ($key == 'ComputerID' || $key == 'submit')
                    continue;
                if ($key == 'ComputerIP') {
                    $sqlupdate[] = "$key = INET_ATON('$value')";
                } else {
                    $sqlupdate[] = "$key = '$value'";
                }
            }
        } else {
            return "New IP NOT IN New Netowork!!!";
        }
        $sqlupdate = implode(', ', $sqlupdate);
        $sql = "UPDATE Computers SET $sqlupdate Where ComputerID = {$postData['ComputerID']};";
        return $sql;
    }

    function isIPinNetwork($ip, $networkID)
    {
        $sql = "SELECT NetworkStart, NetworkEnd, INET_ATON('$ip') as NewIP FROM Networks WHERE NetworkID = $networkID;";
        $networkInfo = $this->pdo->query($sql)->fetch();
        if ($networkInfo['NewIP'] > $networkInfo['NetworkStart'] && $networkInfo['NewIP'] < $networkInfo['NetworkEnd'])
            return TRUE;
        return False;
    }
}