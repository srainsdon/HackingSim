<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/26/2017
 * Time: 5:00 AM
 */

namespace HackSim\Database;


class User
{
    private $log;
    private $DBCore;

    public function __construct()
    {
        $this->log = \Logger::getLogger(__CLASS__);
        $this->DBCore = DBCore::getInstance();
    }

    public function getUserData($userEmail)
    {
        $sql = "SELECT * from users WHERE email = '$userEmail'";
        $this->log->debug("getUserData sql query: $sql");
        return $this->DBCore->query($sql)->fetchAll();
    }
}