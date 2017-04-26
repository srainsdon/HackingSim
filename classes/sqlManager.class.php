<?php

/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 3/29/2017
 * Time: 4:59 AM
 */
class sqlManager
{
    private $logger;
    private $pdo;
    private $dsn;

    function __construct($host, $db, $user, $pass, $charset = 'utf8')
    {
        $this->logger = Logger::getLogger(__CLASS__);
        $this->dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $this->pdo = new PDO($this->dsn, $user, $pass, $opt);
    }

    /**
     * @return PDO
     */
    public function getPdo()
    {
        return $this->pdo;
    }

    function getUsersNetworks($uid)
    {
        $tmpData = array();
        $sql = "select c.*, INET_NTOA(n.NetworkSubNetID) as NetWorkSubNetID from Networks as n join computer as c on n.NetworkID = c.NetworkID where n.owner = $uid";
        foreach ($this->pdo->query($sql)->fetchAll() as $computer) {
            $tmpData[$computer['NetworkID']]['Name'] = $computer['NetworkName'];
            $tmpData[$computer['NetworkID']]['SubNetID'] = $computer['NetWorkSubNetID'];
            $tmpData[$computer['NetworkID']]['Computer'][] = $computer;
        }
        return $tmpData;
    }

    function addNetwork($net_start, $net_end, $name)
    {
        $sql = "INSERT INTO `HackingSim`.`Networks` (`NetworkStart`, `NetworkEnd`, `NetworkName`) VALUES (INET_NTOA('$net_start'), INET_NTOA('$net_end'), '$name');";
        $result = $this->pdo->exec($sql);
        return $result;
    }

    function listNets()
    {
        $sql = "SELECT `NetworkID`, inet_ntoa(`NetworkStart`) AS NetworkStart, `NetworkName`, `Subnet` FROM Networks";
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
        $sql = "SELECT * FROM computer";;
        $result = $this->pdo->query($sql)->fetchAll();
        return $result;
    }

    function getComputerByID($id)
    {
        $stmt = $this->pdo->query("SELECT Computers.ComputerID, CONCAT(Computers.ComputerHostName, '.', Computers.ComputerDomain) AS ComputerName, Computers.ComputerHostName, Computers.ComputerDomain, INET_NTOA(Computers.ComputerIP) AS ComputerIP, Networks.NetworkID FROM Computers, Networks WHERE Computers.ComputerNetwork = Networks.NetworkID and Computers.ComputerID = $id");
        $computer = $stmt->fetch();
        return $computer;
    }

    function getComputerByIP($ip)
    {
        $results = $this->pdo->query("select * from computer where computer.ComputerIP = '$ip'")->fetch();
        $results['ComputerServices'] = json_decode($results['ComputerServices'],true);
        return $results;
    }

    function getServices() {
        $sql = "SELECT ServiceName FROM `HackingSim`.`Services`";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function getNetworkList()
    {
        $sql = "SELECT NetworkID, CONCAT(NetworkName, ' - ', CAST(INET_NTOA(NetworkSubNetID) AS CHAR), '/', Subnet ) AS NetName FROM Networks";
        $result = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function addComputer($hostName, $domain, $ipaddress, $networkID)
    {
        if ($this->isIPinNetwork($ipaddress, $networkID)) {
            $sql = "INSERT INTO Computers (ComputerHostName,  ComputerDomain,  ComputerIP, ComputerNetwork)"
                . " VALUES ('$hostName', '$domain', INET_ATON('$ipaddress'), $networkID)";
            $this->logger->debug("addComputer sql query: $sql");
            if ($this->pdo->query($sql) != TRUE) {
                $ec = $this->pdo->errorCode();
                $this->logger->error("Error: $sql\n$ec");
                return "Error: $sql<br />\n$ec";
            } else {
                return TRUE;
            }
        } else {
            return "IP ADDRESS NOT IN NETWORK!!";
        }
    }

    function isIPinNetwork($ip, $networkID)
    {
        $sql = "SELECT NetworkStart, NetworkEnd, INET_ATON('$ip') as NewIP FROM Networks WHERE NetworkID = $networkID;";
        $networkInfo = $this->pdo->query($sql)->fetch();
        if ($networkInfo['NewIP'] > $networkInfo['NetworkStart'] && $networkInfo['NewIP'] < $networkInfo['NetworkEnd'])
            return TRUE;
        return False;
    }

    function updateComputer($postData)
    {
        if ($this->isIPinNetwork($postData['ComputerIP'], $postData['ComputerNetwork'])) {
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
        $this->logger->debug("updateComputer sql query: $sql");
        return $this->pdo->exec($sql);
    }

    public function getUserData($userEmail){
        $sql = "SELECT * from users WHERE email = '$userEmail'";
        $this->logger->debug("getUserData sql query: $sql");
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function setSession($uid, $hash, $exp, $ip, $agent, $cookie_crc){
        $sql = "INSERT INTO `HackingSim`.`sessions` (`uid`, `hash`, `expiredate`, `ip`, `agent`,`cookie_crc`) VALUES ('$uid', '$hash', '$exp', '$ip', '$agent', '$cookie_crc');";
        $this->logger->debug("setSession sql query: $sql");
        if ($this->pdo->query($sql) != TRUE) {
            $ec = $this->pdo->errorCode();
            $this->logger->error("Error: $sql\n$ec");
            return "Error: $sql<br />\n$ec";
        } else {
            return TRUE;
        }
    }
    /**
     * getLogLines
     * Gives you the logs that have been collected
     *
     * @param int $num number of lines you would like
     * @return array the dump from the log table
     */
    function getLogLines($num = 50)
    {
        $sql = "SELECT * FROM log4php_log ORDER BY timestamp DESC LIMIT 1000";
        $this->logger->debug("getLogLines sql query: $sql");
        return $this->pdo->query($sql)->fetchAll();
    }

    function getPermissions()
    {
        $sql = "SELECT permissions.permissionName FROM users JOIN userGroup ON userGroup.userID = users.id JOIN grouppermission ON grouppermission.gpGroup = userGroup.groupID JOIN permissions ON grouppermission.gpPermission = permissions.permissionID WHERE users.id = 1";
        $this->logger->debug("getPermissions sql query: $sql");
        return $this->pdo->query($sql)->fetchAll();
    }

    function getUsersComputers($userid)
    {
        $sql = "SELECT c.* FROM userComputers AS uc left join computer as c on uc.computerID = c.ComputerID WHERE uc.userID = $userid";
        return $this->pdo->query($sql)->fetchAll();
    }
}