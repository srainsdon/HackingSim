<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 3/30/2017
 * Time: 5:52 AM
 */
include_once '../config.php';

if (isset($_POST['submit'])) {
    if ($_POST['submit'] == 'edit') {

    }
} elseif (isset($_GET['fix'])) {
    $data = $sql->getFixedIPs();
    $newData = array();
    foreach ($data as $row) {
        $row['NewLong'] = rand($row['NetworkStart'], $row['NetworkEnd']);
        $row['NewIP'] = long2ip($row['NewLong']);
        $newData[] = $row;
    }
    $smarty->assign("bCrumbs", "Fix Ip List");
    $smarty->assign("computers", $newData);
    $smarty->display('Fixlist.tpl');
} elseif (isset($cmd[1]) && $cmd[1] != '') {
    $tempData = array();
    foreach ($sql->getNetworkList() as $row) {
        $tempData[$row['NetworkID']] = $row['NetworkName'];
    }
    $smarty->assign("bCrumbs", " - <a href='computer.php' >Computer List</a> - Computer Editor");
    $smarty->assign("Computer", $sql->getComputerByID($cmd[1]));
    $smarty->assign("Networks", $tempData);
    $smarty->assign('task', "Edit");
    $smarty->display('computer.tpl');
} else {
    $smarty->assign("bCrumbs", " - Computer List");
    $smarty->assign("computers", $sql->getAllComputers());
    $smarty->display('list.tpl');
}