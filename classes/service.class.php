<?php

/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/13/2017
 * Time: 4:09 AM
 */
class service
{
    protected $name;
    protected $ports;
    protected $version;

    function __construct($json = null)
    {
        $data = json_decode($json,true);
        if (is_array($data)) {
            $this->name = $data['name'];
            $this->version = $data['version'];
            $this->ports = $data['ports'];
        }
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @param mixed $ports
     */
    public function setPort($port, $status = 'open')
    {
        $this->ports[$port] = array('port' => $port, 'status' => $status);
    }

    public function getArray()
    {
        return array(
            'name' => $this->name,
            'version' => $this->version,
            'ports' => $this->ports
        );
    }

    public function getJson()
    {
        return json_encode(array(
            'name' => $this->name,
            'version' => $this->version,
            'ports' => $this->ports
        ));
    }
}