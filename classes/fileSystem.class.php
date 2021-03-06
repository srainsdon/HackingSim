<?php

/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 3/29/2017
 * Time: 9:06 AM
 */
class fileSystem
{
    public $tree = array();
    private $FS = array();
    private $num = 0;
    private $path = array();
    private $pwd;

    function __construct($data, $pwd = '/')
    {
        $this->FS = $data;
        $this->tree['/'] = $data;
        $this->pwd = $pwd;
    }

    function showFileSystem()
    {
        // print_r($this->FS);
        echo $this->prosses($this->FS);
    }

    function prosses($a, $num = 0, $path = array())
    {
        // echo "A:<pre>" . print_r($a,true) . "</pre>\n";
        $num++;

        if (count($path) < 1)
            $path = $this->path;
        /*if (!is_array($a)) {
            echo "$a<br />\n";
            return;
        }*/
        foreach ($a as $k => $v) {
            if ($k == "_type")
                continue;
            // echo "K: $k<pre>" . print_r($v,true) . "</pre>\n";

            if ($v['_type'] == "D") {
                $path[] = $k;
                $dir = "/" . implode('/', $path);
                $this->tree[$dir] = $v;
                // echo "$dir<br />\n";
                $this->prosses($v, $num, $path);
            } elseif ($v['_type'] == "F") {
                $path[] = $k;
                // echo "/" . implode('/', $path), "<br />\n";
            }
            array_pop($path);
        }
    }

    function __toString()
    {
        ob_start();
        $this->fullList($this->FS);
        return ob_get_clean();
    }

    function fullList($a, $num = 0, $path = array())
    {
        $num++;
        if (count($path) < 1)
            $path = $this->path;
        foreach ($a as $k => $v) {
            if ($k == "_type")
                continue;
            if ($v['_type'] == "D") {
                $path[] = $k;
                $dir = "/" . implode('/', $path);
                $this->tree[$dir] = $v;
                echo "$dir\n";
                $this->fullList($v, $num, $path);
            } elseif ($v['_type'] == "F") {
                $path[] = $k;
                echo "/" . implode('/', $path), "\n";
            }
            array_pop($path);
        }
    }

    function cmd_cd($dir)
    {
        if ($this->tree[$dir]) {
            $this->pwd = $dir;
        }
        return $this->pwd;
    }

    function cmd_ls()
    {
        echo "<pre>Listing for {$this->pwd}\n\n";
        foreach ($this->tree[$this->pwd] as $k => $v) {
            if ($k == "_type")
                continue;
            if ($v['_type'] == "D") {
                echo "$k/\n";
            } elseif ($v['_type'] == "F") {
                echo "$k\n";
            }
        }
        echo "</pre>\n";
    }

    function cmd_pwd()
    {
        return $this->pwd;
    }
}