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
    private $isAuthed;
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

    public function isAuthorised($level = null)
    {
        $this->isAuthed = false;
        if ((empty($this->userEmail)) || (empty($this->userID)))
            $this->setupUserData();

        if (parent::isLogged()) {
            $sql = "SELECT permissions.permissionName "
                . "FROM users JOIN userGroup ON userGroup.userID = users.id "
                . "JOIN groupPermission ON groupPermission.gpGroup = userGroup.groupID "
                . "JOIN permissions ON groupPermission.gpPermission = permissions.permissionID "
                . "WHERE users.id = " . $this->userID . "ORDER BY permissionName;";

            $tempData = $this->dbh->query($sql)->fetchAll();
            array_walk_recursive($tempData, function ($item, $key) {
                //echo "$key holds $item\n";
                $this->permissions[] = $item;
            });
            if (isset($level)) {
                if (in_array($level, $this->permissions))
                    $this->isAuthed = true;
            }
            /*return array(
                'loggedin' => true,
                'sql' => $sql,
                'Permissions' => $this->permissions);*/
        }
        return $this->isAuthed;
    }

    /**
     * @return array
     */
    public function setupUserData()
    {
        if ($this->isLogged()) {
            $this->userID = $this->getSessionUID($_COOKIE['authID']);
            $this->userEmail = $this->getUser($_COOKIE['authID'])['email'];
        }
    }
}