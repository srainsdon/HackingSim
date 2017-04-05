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
        return array_search($level, $sql);
    }
}