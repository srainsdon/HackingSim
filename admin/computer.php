<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 3/30/2017
 * Time: 5:52 AM
 */
include_once 'admin.config.php';
if (isset($_GET['fix'])) {
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
} elseif (isset($_GET['compID'])) {
    $smarty->assign("bCrumbs", "Full Computer List");
    $smarty->assign("computer", $sql->getComputerByID($_GET['compID']));
    $smarty->display('computer.tpl');
} else {
    $smarty->assign("bCrumbs", "Full Computer List");
    $smarty->assign("computers", $sql->getAllComputers());
    $smarty->display('list.tpl');
}