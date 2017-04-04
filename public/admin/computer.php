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
} elseif (isset($computerId) && $computerId != '') {
    $tempData = array();
    foreach ($sql->getNetworkList() as $row) {
        $tempData[$row['NetworkID']] = $row['NetworkName'];
    }
    $smarty->append('bCrumbs', "<a href='/admin/computer/' >Computer List</a>");
    $smarty->append('bCrumbs', "Computer Editor");
    $smarty->assign("Computer", $sql->getComputerByID($computerId));
    $smarty->assign("Networks", $tempData);
    $smarty->assign('task', "Edit");
    $smarty->display('computer.tpl');
} else {
    $smarty->append('bCrumbs', "Computer List");
    $smarty->assign("computers", $sql->getAllComputers());
    $smarty->display('list.tpl');
}