<?php

/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 3/29/2017
 * Time: 9:06 AM
 */
class fileSystem
{
    private $FS = array();
    private $num = 0;

    function __construct($data)
    {
        $this->FS = $data;
    }

    function showFileSystem()
    {
        print_r($this->FS);
        echo $this->printAll($this->FS);
        echo $this->array_depth($this->FS);
    }

    function printAll($a, $num = 0) {
        $num++;
        if (!is_array($a)) {
            echo str_repeat(" ", $num-1);
            echo $a, "\n";
            return;
        }
        foreach($a as $k => $v) {
            echo str_repeat(" ", $num-1);
            echo $k, "\n";
            $this->printAll($v, $num);
        }
    }
    function getFSstring($x) {

    }

}