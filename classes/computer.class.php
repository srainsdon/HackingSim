<?php

/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/12/2017
 * Time: 8:38 PM
 */
class computer
{
    private $ip;

    function __construct()
    {

        $this->ip = new ipv4();
    }
}