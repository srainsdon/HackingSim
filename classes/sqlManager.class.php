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
        $stmt = $this->pdo->query("SELECT * FROM Computers");
        $result = $this->pdo->query($stmt);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "id: " . $row["ComputerID"] . " - FCDN: " . $row["ComputerHostName"] . "." . $row["ComputerDomain"] . " IP: " . long2ip($row["ComputerIP"]) ."<br>";
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