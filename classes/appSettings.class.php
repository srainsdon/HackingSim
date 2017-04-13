<?php

/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/12/2017
 * Time: 6:17 PM
 */
class appSettings
{
    private $ports;
    private $data;

    function __construct($json = null)
    {
        if($json) {
            $this->data = json_decode($json);
        }
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        $this->data['ports'] = $this->ports;
        return json_encode($this->data);
    }

    /**
     * @param mixed $ports
     */
    public function setPorts($port, $state)
    {

        $this->ports[$port] = $state;
    }
    /**
     * @param mixed $data
     */
    public function setData($cfgName, $cfgValue)
    {
        $this->data[$cfgName] = $cfgValue;
    }
}