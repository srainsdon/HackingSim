<?php

/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 3/29/2017
 * Time: 6:24 AM
 */
class random
{
    private $key = 'aa2d03f9-aa9b-424c-920f-80427d4f2365';
    private $url = 'https://api.random.org/json-rpc/1/invoke';
    public $password = array();
    function getPassword() {
        if (count($this->password) < 1) {
            $this->getPasswords();
        }
        return array_shift($this->password);

    }
    private function getPasswords () {
        $request = array(
            'jsonrpc' => 2.0,
            'method' => 'generateStrings',
            'params' => array(
                'apiKey' => $this->key,
                'n' => 10,
                'length' => 10,
                'characters' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789',
                'replacement' => 1
            ),
            'id' => 22178
        );

        $curl = curl_init($this->url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($request));

        $json_response = curl_exec($curl);

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ( $status != 200 ) {
            die("Error: call to URL $this->url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
        }


        curl_close($curl);

        $response = json_decode($json_response, true);
        $password = $response['result']['random']['data'];
        $this->password = $this->password + $password;
    }
    function __construct()
    {
        $this->getPasswords();
    }
}