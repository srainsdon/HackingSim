<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/26/2017
 * Time: 5:08 AM
 */

namespace HackSim\Database;


use HackSim\Core\Singleton;

class DBCore extends Singleton
{
    protected $pdo;
    protected $dsn;
    private $log;

    function __construct()
    {
        $this->log = \Logger::getLogger(__CLASS__);
        \LoggerMDC::put("ipAddress", $this->get_client_ip());
        $this->dsn = "mysql:host=" . getenv('dbHost') . ";dbname=" . getenv('dbDatabase') . ";charset=utf8";
        $this->log->debug("DSN: $this->dsn");
        $opt = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $this->pdo = new \PDO($this->dsn, getenv('dbUser'), getenv('dbPass'), $opt);
    }

    public function __call($method, $args = null)
    {
        if (is_callable(array($this->pdo, $method))) {
            return call_user_func_array(array($this->pdo, $method), $args);
        } else {
            header("HTTP/1.0 500 Server Error");
            echo 'Undefined method Core::' . $method;
        }
    }
}