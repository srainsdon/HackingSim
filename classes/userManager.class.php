<?php

/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/5/2017
 * Time: 9:11 AM
 */
class userManager
{
    private $loggedin;
    private $uid;
    private $userName;
    private $sql;
    private $log;

    function __construct(sqlManager &$sql)
    {
        $this->sql = $sql;
        $this->log = new Logger(__CLASS__);
        if (isset($_COOKIE["authToken"])) {
            $this->checkSession($_COOKIE["authToken"]);
        }
    }

    private function checkSession($crc)
    {
        $userData = $this->sql->getSessionData($crc);
        var_dump($userData);
    }

    public function login($username, $password, $remember = 0)
    {
        $userData = $this->sql->getUserData($username);

        if (password_verify($password, $userData[0]['password'])) {
            $this->loggedin = true;
            $this->uid = $userData[0]['id'];
            $this->userName = $userData[0]['email'];
            $this->createSession();
            return array(0, "Logged In");
        } else {
            return array(1, "Incorrect Username or Password");
        }
    }

    private function createSession()
    {
        $bytes = bin2hex(random_bytes(40));
        $hashed = password_hash($bytes, PASSWORD_BCRYPT);
        setcookie('authToken', $hashed, time() + 3600, '/');
        //$string = $this->uid . (time() + 3600) . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'];
        $this->sql->setSession($this->uid, $bytes, date ("Y-m-d H:i:s", time() + 3600), $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT'],$hashed);
    }

    public function isLogged()
    {
        return false;
    }

    public function createUser($username, $password)
    {
        echo password_hash($password, PASSWORD_BCRYPT) . "\n";
    }
}