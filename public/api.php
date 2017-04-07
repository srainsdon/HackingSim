<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/6/2017
 * Time: 11:39 PM
 */

switch ($cmd[1]) {
    case "v1": { // cmd = /api/v1/
        switch ($cmd[2]) {
            case "logs": // cmd = /api/v1/logs/
                include_once '/admin/logs.php';
                break;
            case "computers": // cmd = /api/v1/logs/
                $tmpList = $sql->getAllComputers();
                echo json_encode($tmpList);
                break;
        }
    }
}