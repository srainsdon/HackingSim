<?php

/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/5/2017
 * Time: 9:11 AM
 */
class userManager extends PHPAuth\Auth
{
    const AUTHORISED = 200;
    const LOGGED_IN = 100;
    const GUEST = 10;

    private $userID;
    private $userName;
    private $userEmail;
    private $permissions;
    private $isAuthed;
    private $log;

    public function __construct(\PDO $dbh, $config, $language = "en_GB")
    {
        $this->log = new Logger(__CLASS__);
        parent::__construct($dbh, $config, $language);
    }

    /**
     * @return mixed logged in user's email address
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * @return string logged in user name
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
     * @return array list($error, $message, $hash, $expire)
     */
    public function login($email, $password, $remember = 0, $captcha = NULL)
    {
        $this->log->debug($email . $password . $remember . $captcha);
        $this->userEmail = $email;
        $data = parent::login($email, $password, $remember, $captcha);
        $this->userID = $this->getUID($email);
        $error = $data['error'];
        $message = $data['message'];
        $hash = $data['hash'];
        $expire = $data['expire'];

        return array($error, $message, $hash, $expire);
    }

    public function isAuthorised($level = null)
    {
        $this->log->debug("userID: ".$this->userID . " Level:" . $level);
        $this->isAuthed = userManager::GUEST;

        if ((empty($this->userEmail)) || (empty($this->userID))) {
            $this->setupUserData();
        }
        if (!parent::isLogged()) {
            return $this->isAuthed; // isAuthed == GUEST
        } else {
            $this->isAuthed = userManager::LOGGED_IN;
            $sql = "SELECT permissions.permissionName "
                . "FROM users JOIN userGroup ON userGroup.userID = users.id "
                . "JOIN groupPermission ON groupPermission.gpGroup = userGroup.groupID "
                . "JOIN permissions ON groupPermission.gpPermission = permissions.permissionID "
                . "WHERE users.id = " . $this->userID . ";";

            $tempData = $this->dbh->query($sql)->fetchAll();
            array_walk_recursive($tempData,
                function ($item, $key) {
                    $this->permissions[] = $item;
                });
            if (isset($level)) {
                if (in_array($level, $this->permissions))
                    $this->isAuthed = userManager::AUTHORISED;
            } else {
                return array(
                    'loggedin' => true,
                    'sql' => $sql,
                    'Permissions' => $this->permissions);
            }
        }
    }

    /**
     * @return boolean
     */
    protected function setupUserData()
    {
        if ($this->isLogged()) {
            if (isset($this->userID)) {
                $this->userID = $this->getSessionUID($_COOKIE['authID']);
            }
            if (isset($this->userEmail)) {
                $this->userEmail = $this->getUser($_COOKIE['authID'])['email'];
            }
        }
        $haveProfile = false;
        if ((empty($this->userEmail)) || (empty($this->userID)))
            $haveProfile = true;
        return $haveProfile;
    }

    /**
     * @return boolean
     */
    public function getIsAuthed()
    {
        return $this->isAuthed;
    }
}