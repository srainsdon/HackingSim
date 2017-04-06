<?php

/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/5/2017
 * Time: 9:11 AM
 */
class userManager extends PHPAuth\Auth
{
    private $userID;
    private $userName;
    private $userEmail;

    /**
     * @return mixed
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    public function login($email, $password, $remember = 0, $captcha = NULL)
    {
        $this->userEmail = $email;
        $this->userID = getUID($email);

        $data = parent::login($email, $password, $remember, $captcha);

        $error = $data['error'];
        $message = $data['message'];
        $hash = $data['hash'];
        $expire = $data['expire'];
        $this->setupUserData();
        if ($error > 0) {
            return "Error: ";
        } else {
            $this->setupUserData();
            return array($error, $message, $hash, $expire);
        }
    }

    public function setupUserData()
    {
        if ($this->isLogged()) {
            $sql = "SELECT permisions.permisionName "
                . "FROM users JOIN userGroup ON userGroup.userID = users.id "
                . "JOIN groupPermisions ON groupPermisions.gpGroup = userGroup.groupID "
                . "JOIN permisions ON groupPermisions.gpPermision = permisions.permisionID "
                . "WHERE users.id = " . $this->userID;

            $permisions = $this->dbh->query($sql)->fetchAll();
            return array($sql, $permisions);
        }
    }
}