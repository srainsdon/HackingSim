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
        if (isset($_COOKIE["authToken"])){
            $this->checkSession($_COOKIE["authToken"]);
        }
    }
    private function checkSession($crc) {

    }
    private function createSession($crc) {

        $hashed = password_hash($crc, PASSWORD_BCRYPT);
        setcookie('authToken', $hashed, time() + 3600, '/');

    }
    public function login($username, $password, $remember = 0)
    {
        $userData = $this->sql->getUserData($username);
        $bytes = bin2hex(random_bytes(40));
        if (password_verify($password, $userData[0]['password'])) {
            $this->loggedin = true;
            $this->uid = $userData[0]['id'];
            $this->userName = $userData[0]['email'];
            $this->createSession($bytes);
            return array(0, "Logged In");
        } else {
            return array(1, "Incorrect Username or Password");
        }
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