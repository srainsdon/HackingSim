<?php

/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/5/2017
 * Time: 9:11 AM
 */
class userManager
{
    private $pdo;
    private $auth;
    private $config;

    function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->config = new PHPAuth\Config($pdo);
        $this->auth = new PHPAuth\Auth($this->pdo, $this->config);
    }

    function login($user, $pass)
    {
        $login = $this->auth->login($user, $pass);
        if ($login['error'] > 0) {
            return $login;
        } else {
            $expTime = 'time() ' . $this->config->cookie_forget;
            setcookie('authID', $login['hash'], $expTime, '/');
        }
    }


    private
    function getPermisions()
    {
        $sql = "SELECT permisions.permisionName FROM users JOIN userGroup ON userGroup.userID = users.id JOIN groupPermisions ON groupPermisions.gpGroup = userGroup.groupID JOIN permisions ON groupPermisions.gpPermision = permisions.permisionID WHERE users.id = 1";
    }
}