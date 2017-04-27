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
        $this->DBCore = \HackSim\Database\DBCore::getInstance();
    }

    public function getLogTail($rows = 25, $table = false)
    {
        $sql = "SELECT * from tailLog LIMIT $rows";
        $this->log->debug("getLogTial SQL: $sql");
        $sth = $this->DBCore->query($sql);
        $message = array();
        $message = $sth->fetchAll();
        return $message;
    }
}