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
    print_r($sql->getNetworkList());
    $smarty->assign("bCrumbs", " - <a href='computer.php' >Computer List</a> - Computer Editor");
    $smarty->assign("Computer", $sql->getComputerByID($_GET['compID']));
    $smarty->assign("Networks", $sql->getNetworkList());
    $smarty->assign('task', "Edit");
    $smarty->display('computer.tpl');
} else {
    $smarty->assign("bCrumbs", " - Computer List");
    $smarty->assign("computers", $sql->getAllComputers());
    $smarty->display('list.tpl');
}