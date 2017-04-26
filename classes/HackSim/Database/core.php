<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/26/2017
 * Time: 5:08 AM
 */

namespace HackSim\Database;


use HackSim\Core\Singleton;

class core extends Singleton
{
    private $log;
    protected $pdo;
    protected $dsn;

    function __construct()
    {
        //$this->log = Logger::getLogger(__NAMESPACE__ . "-" . __CLASS__);
        //$this->log->debug("Core: Loading...");
        $this->dsn = "mysql:host=".getenv('dbHost').";dbname=".getenv('dbDatabase').";charset=utf8";
        echo $this->dsn;
        $opt = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $this->pdo = new \PDO($this->dsn, getenv('dbUser'), getenv('dbPass'), $opt);
        var_dump($this->pdo->exec("SELECT VERSION();"));
    }
}