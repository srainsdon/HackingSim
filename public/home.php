<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/2/2017
 * Time: 5:19 AM
 */

if ($auth->isLogged()) {
    $comps = $sql->getUsersComputers('1');
    $smarty->assign('computers', $comps);
    $smarty->assign("MyNetworks", $sql->getUsersNetworks(1));
    $smarty->debugging = true;
    if (isset($computerip)) {
        $tempData = array();
        foreach ($sql->getNetworkList() as $row) {
            $tempData[$row['NetworkID']] = $row['NetName'];
        }
        $smarty->assign("Networks", $tempData);

        $smarty->assign('Computer',$sql->getComputerByIP($computerip));
        $smarty->display('userComputer.tpl');
    } else {
        $smarty->display('home.tpl');
    }
} else {
    $smarty->append('bCrumbs', "<span class=\"breadcrumb-item active\">Log In</span>");
    $smarty->display('home.tpl');
}
