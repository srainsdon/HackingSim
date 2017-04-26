<?php

/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/5/2017
 * Time: 9:11 AM
 */
class userManager {
    private $loggedin;
    private $sql;
    private $log;
    function __construct()
    {
        $this->log = new Logger(__CLASS__);
    }

    public function login($username, $password, $remember = 0) {

    }
    public function createUser($username, $password){
        echo password_hash($password, PASSWORD_BCRYPT)."\n";
    }
}