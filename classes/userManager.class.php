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
    private $sql;
    private $log;

    function __construct(sqlManager &$sql)
    {
        $this->sql = $sql;
        $this->log = new Logger(__CLASS__);
    }

    public function login($username, $password, $remember = 0)
    {
        $userData = $this->sql->getUserData($username);
        $bytes = uniqid() . $username;
        $hashed = password_hash($bytes, PASSWORD_BCRYPT);
        var_dump($userData);
        if (password_verify($password, $userData[0]['password'])) {
            echo "all Good!";
        }
        exit();
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