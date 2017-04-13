<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/2/2017
 * Time: 5:19 AM
 */

if ($auth->isLogged()) {
    if (isset($_GET['compIP'])) {
        $smarty->assign('computer',$sql->getComputerByIP($_GET['compIP']));
        $smarty->display('userComputer.tpl');
    } else {
        $comps = $sql->getUsersComputers('1');
        $smarty->assign('computers', $comps);
        $smarty->display('home.tpl');
    }
} else {

    $smarty->display('home.tpl');
}
