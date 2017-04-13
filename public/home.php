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
        $services = array();
        $service = new service();
        $service->setName('ssh');
        $service->setPort(22);
        $service->setPort(2222, 'stealth');
        $service->setVersion('1.2.3');
        $services[] = $service->getArray();
        $service = new service();
        $service->setName('apache2');
        $service->setPort(80);
        $service->setPort(453);
        $service->setVersion('2.2.6');
        $services[] = $service->getArray();
        $smarty->assign('data', "<pre>" . print_r($services,true) . "</pre>" . json_encode($services));
        $smarty->display('home.tpl');
    }
} else {
    $smarty->append('bCrumbs', "<span class=\"breadcrumb-item active\">Log In</span>");
    $smarty->display('home.tpl');
}
