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
    private $permissions;

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

    /**
     * @param string $email
     * @param string $password
     * @param int $remember
     * @param null $captcha
     * @return array
     */
    public function login($email, $password, $remember = 0, $captcha = NULL)
    {
        $this->userEmail = $email;
        $this->userID = $this->getUID($email);

        $data = parent::login($email, $password, $remember, $captcha);

        $error = $data['error'];
        $message = $data['message'];
        $hash = $data['hash'];
        $expire = $data['expire'];
        return array($error, $message, $hash, $expire);
    }

    /**
     * @return array
     */
    public function setupUserData()
    {
        if ($this->isLogged()) {
            $sql = "SELECT permissions.permisionName "
                . "FROM users JOIN userGroup ON userGroup.userID = users.id "
                . "JOIN grouppermissions ON grouppermissions.gpGroup = userGroup.groupID "
                . "JOIN permissions ON grouppermissions.gpPermision = permissions.permisionID "
                . "WHERE users.id = " . $this->userID;

            $this->permissions = $this->dbh->query($sql)->fetchAll();
            return array($sql, $this->permissions);
        }
    }

    public function isAuthorised($level = null)
    {
        $isAuth = false;
        if (parent::isLogged()) {
            $sql = "SELECT permissions.permisionName "
                . "FROM users JOIN userGroup ON userGroup.userID = users.id "
                . "JOIN grouppermissions ON grouppermissions.gpGroup = userGroup.groupID "
                . "JOIN permissions ON grouppermissions.gpPermision = permissions.permisionID "
                . "WHERE users.id = " . $this->userID;

            //$this->permissions = $this->dbh->query($sql)->fetchAll();
            /*if (isset($level)) {
                if (in_array($level, $this->permissions))
                    $isAuth = true;
            }*/
            return array(
                'loggedin' => $isAuth,
                'sql' => $sql,
                'Permissions' => $this->permissions);
            return $isAuth;
        }
    }
}