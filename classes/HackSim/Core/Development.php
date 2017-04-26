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
    protected $DBCore;

    public function __construct()
    {
        $this->log = \Logger::getLogger(__CLASS__);
        $this->DBCore = \HackSim\Database\DBCore::getInstance();
    }

    public function getLogTail($rows = 25)
    {
        $sql = "SELECT * from tailLog LIMIT $rows";
        return implode("<br />\n", $this->DBCore->query($sql)->fetchAll());
    }
}