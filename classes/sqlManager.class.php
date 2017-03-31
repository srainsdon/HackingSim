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
        $result = $this->pdo->query("SELECT * FROM Computers")->fetchAll();

        if (count($result) > 0) {
            // output data of each row
            foreach ($result as $row) {
                echo "id: " . $row["ComputerID"] . " - FQDN: " . $row["ComputerHostName"] . "." . $row["ComputerDomain"] . " IP: " . long2ip($row["ComputerIP"]) . "<br>";
                $sql = "call r_return_tree(" . $row['ComputerID'] . ");";
                $fs_result = $this->pdo->query($sql)->fetchAll();
                echo implode("<br />\n", $fs_result);
            }
        } else {
            echo "0 results";
        }
    }

    function getComputerByID($id)
    {
        $stmt = $this->pdo->query("SELECT * FROM Computers where ComputerID = $id");
        $computer = $stmt->fetch();
        return $computer;
    }
}