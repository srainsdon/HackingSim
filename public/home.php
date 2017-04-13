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
    if (isset($computerip)) {
        $tempData = array();
        foreach ($sql->getNetworkList() as $row) {
            $tempData[$row['NetworkID']] = $row['NetName'];
        }
        $smarty->assign("Networks", $tempData);

        $smarty->assign('Computer',$sql->getComputerByIP($computerip));
        $smarty->display('userComputer.tpl');
    } else {
        $service = new service();
        $service->setName('ssh');
        $service->setPort(22);
        $service->setPort(2222, 'stealth');
        $service->setVersion('1.2.3');
        $smarty->assign('data', $service->getJson());
        $smarty->display('home.tpl');
    }
} else {
    $smarty->append('bCrumbs', "<span class=\"breadcrumb-item active\">Log In</span>");
    $smarty->display('home.tpl');
}
