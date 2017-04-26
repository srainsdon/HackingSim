<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/26/2017
 * Time: 9:54 AM
 */

namespace HackSim\Core;


class Development
{
    protected $DBCore;

    public function __construct()
    {
        $this->log = \Logger::getLogger(__CLASS__);
        $this->DBCore = DBCore::getInstance();
    }

    public function getLogTail($rows = 25)
    {
        $sql = "SELECT * from tailLog LIMIT $rows";
        return $this->DBCore->query($sql)->fetchAll();
    }
}