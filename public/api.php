<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/6/2017
 * Time: 11:39 PM
 *
 * Version: 1
 *
 * This file works as the api router.
 *
 * /api/v1/json/logs/ dumps the last {blah} lines from the log table
 */
header('Content-Type: application/json');
switch ($cmd[1]) {
    case "v1": { // cmd = /api/v1/
        $log->debug('cmd = /api/v1/');
        switch ($cmd[2]) {
            case "json": { // cmd = /api/v1/json/
                switch ($cmd[3]) {
                    case "logs": // cmd = /api/v1/json/logs/
                        $numberOfrows = 50;
                    if (isset($cmd[4]))
                        $numberOfrows = $cmd['4'];
                        $log->debug('cmd = /api/v1/json/logs/$numberOfrows/');
                        $list = array();
                        foreach ($sql->getLogLines() as $row) {
                            $list[] = new logEntry($row['timestamp'], $row['logger'], $row['thread'], $row['file'], $row['line'], $row['level'], $row['message']);
                        }
                        $log->info('Returned ' . count($list) . ' Records');
                        echo json_encode($list);
                break;
                    case "computers": // cmd = /api/v1/json/computers/
                        $tmpList = $sql->getAllComputers();
                        echo json_encode($tmpList);
                        break;
                }
            } // TODO[Seth Rainsdon] - Add needed code for xml output as well
        }
    } // This was added from the start to allow for backwards compatibility
}