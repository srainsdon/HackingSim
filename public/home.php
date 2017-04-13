<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/2/2017
 * Time: 5:19 AM
 */

if ($auth->isLogged()) {
    if (isset($computerip)) {
        $smarty->assign('computer',$sql->getComputerByIP($computerip));
        $smarty->display('userComputer.tpl');
    } else {
        $comps = $sql->getUsersComputers('1');
        $smarty->assign('computers', $comps);
        $smarty->display('home.tpl');
    }
} else {

    $smarty->display('home.tpl');
}
