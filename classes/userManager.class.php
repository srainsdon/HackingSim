<?php

/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/5/2017
 * Time: 9:11 AM
 */
class userManager extends PHPAuth\Auth
{
    /*
    public function __construct(\PDO $dbh, $config)
    {
        parent::__construct($dbh, $config);
    }
    */
    public function isAuthorised($level)
    {
        $sql = "SELECT permisions.permisionName FROM users JOIN userGroup ON userGroup.userID = users.id JOIN groupPermisions ON groupPermisions.gpGroup = userGroup.groupID JOIN permisions ON groupPermisions.gpPermision = permisions.permisionID WHERE users.id = 1";
        $permisions = $this->dbh->query($sql)->fetchAll();
        return array_search($level, $permisions);
    }

    public function login($email, $password, $remember = 0, $captcha = NULL)
    {
        $data = parent::login($email, $password, $remember, $captcha);
        $error = $data['error'];
        $message = $data['message'];
        $hash = $data['hash'];
        $expire = $data['expire'];
        if ($error > 0) {
            return array($error, $message, $hash, $expire);
        } else {
            return array($error, $message, $hash, $expire);
        }
    }
}