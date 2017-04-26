<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/26/2017
 * Time: 9:54 AM
 */

namespace HackSim\Core;


use HackSim\Database\DBCore;

class Development
{

    private $log;
    private $DBCore;

    public function __construct()
    {
        $this->log = \Logger::getLogger(__CLASS__);
        $this->DBCore = DBCore::getInstance();
    }

    public function getLogTail($rows = 25)
    {
        $sql = "SELECT * from tailLog LIMIT $rows";
        $this->log->debug("getLogTial SQL: $sql");
        $result = $this->DBCore->query($sql);
        $message = null;
        while ($row = $result->fetch_assoc()) {
            $message .= implode(" ", $row) . PHP_EOL;
        }
        return $message;
    }
}