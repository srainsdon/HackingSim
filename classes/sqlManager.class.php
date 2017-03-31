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

    function getAllComputers()
    {
        $sql1 = "SELECT `ComputerID`,  `ComputerHostName`,  `ComputerDomain`,  `ComputerIP` FROM `Computers`";
        $sql2 = "SELECT n.fsID, CONCAT(REPEAT('..', COUNT(CAST(p.fsID AS CHAR)) - 1), n.fsName) AS Name"
            . " FROM FileSystems AS n, FileSystems AS p"
            . " WHERE (n.fsLft BETWEEN p.fsLft AND p.fsRgt) AND n.Computer = :CompID"
            . " GROUP BY fsID"
            . " ORDER BY n.fsLft;";
        $stmt = $this->pdo->prepare($sql2);
        $result = $this->pdo->query($sql1)->fetchAll();
        foreach ($result as $row) {
            echo "id: " . $row["ComputerID"] . " - FQDN: " . $row["ComputerHostName"] . "." . $row["ComputerDomain"] . " IP: " . long2ip($row["ComputerIP"]) . "<br>";

            $stmt->bindParam(':CompID', $row["ComputerID"], PDO::PARAM_INT);
            $stmt->execute();
            implode("<br />\n", $stmt->fetchAll());
        }
    }

    function getComputerByID($id)
    {
        $stmt = $this->pdo->query("SELECT * FROM Computers where ComputerID = $id");
        $computer = $stmt->fetch();
        return $computer;
    }
}