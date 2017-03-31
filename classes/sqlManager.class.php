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
        $result = $this->pdo->query("SELECT * FROM Computers");

        if ($result->rowCount() > 0) {
            // output data of each row
            $data = $result->fetchAll();
            foreach ($data as $row) {
                echo "id: " . $row["ComputerID"] . " - FQDN: " . $row["ComputerHostName"] . "." . $row["ComputerDomain"] . " IP: " . long2ip($row["ComputerIP"]) . "<br>";
                $fs_result = $this->pdo->query("call r_return_tree(" . $row["ComputerID"] . ");");
                foreach ($fs_result->fetchAll() as $res) {
                    echo $res[1] . "<br />" . PHP_EOL;
                }
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