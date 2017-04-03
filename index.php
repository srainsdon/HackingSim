<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 3/29/2017
 * Time: 4:36 AM
 */

// header("Content-type:text/html");


function walk_dir($dir)
{
    $relativedir = '.' . $dir;
    if ($dh = opendir($relativedir)) {
        while (false !== ($file = readdir($dh))) {
            if (($file !== '.') && ($file !== '..')) {
                if (!is_dir($relativedir . $file)) {
                    echo '<a href="' . $dir . $file . '" title="' . $file . '">' . $file . '</a>' . "\n";
                } else {
                    walk_dir($dir . $file . '/');
                }
            }
        }
    }
}

walk_dir('/');
