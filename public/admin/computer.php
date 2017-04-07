<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 3/30/2017
 * Time: 5:52 AM
 */
$log->error("Starting Computer.php");
$extras->checkACL('ADMIN_COMPUTER');
if (isset($_POST['submit'])) {
    if ($_POST['submit'] == 'Edit') {
        if (!$sql->updateComputer($_POST)) {
            $smarty->assign('alert', "Edit Failed");
        } else {
            $smarty->assign('message', "Edit Successful!!!");
        }
    } elseif ($_POST['submit'] == 'Add') {
        $res = $sql->addComputer($_POST['ComputerHostName'], $_POST['ComputerDomain'], $_POST['ComputerIP'], $_POST['ComputerNetwork']);
        if ($res) {
            $smarty->assign('message', "Computer {$_POST['ComputerHostName']}.{$_POST['ComputerDomain']} was added!");
        } else {
            $smarty->assign('alert', "ERROR:\n$res");
        }
    }
}
$tempData = array();
foreach ($sql->getNetworkList() as $row) {
    $tempData[$row['NetworkID']] = $row['NetName'];
}
$smarty->assign("Networks", $tempData);
if (isset($computerId) && $computerId != '') {
    if ($computerId == 'add') {
        $smarty->append('bCrumbs', "<a class=\"breadcrumb-item\" href='/admin/computer/' >Computer List</a>");
        $smarty->append('bCrumbs', "<span class=\"breadcrumb-item active\">New Computer</span>");
        $smarty->assign('task', "Add");
        $smarty->display('computer.tpl');
    } else {
        $smarty->append('bCrumbs', "<a class=\"breadcrumb-item\" href='/admin/computer/' >Computer List</a>");
        $smarty->append('bCrumbs', "<span class=\"breadcrumb-item active\">Computer Editor</span>");
        $smarty->assign("Computer", $sql->getComputerByID($computerId));
        $smarty->assign("Networks", $tempData);
        $smarty->assign('task', "Edit");
        $smarty->display('computer.tpl');
    }
} else {
    $smarty->append('bCrumbs', "<span class=\"breadcrumb-item active\">Computer List</span>");
    $smarty->assign("computers", $sql->getAllComputers());
    $smarty->display('list.tpl');
}
