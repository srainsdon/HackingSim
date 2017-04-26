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
    private $corePDO;

    public function __construct()
    {
        $this->log = \Logger::getLogger(__NAMESPACE__ . "-" . __CLASS__);
        $this->corePDO = core::getInstance();
    }

    public function getUserData($userEmail)
    {
        $sql = "SELECT * from users WHERE email = '$userEmail'";
        $this->log->debug("getUserData sql query: $sql");
        return $this->corePDO->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}