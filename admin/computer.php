<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 3/30/2017
 * Time: 5:52 AM
 */
include_once 'admin.config.php';
function newIP($prams, Smarty_Internal_Template $template)
{
    return long2ip(rand($prams['start'], $prams['end']));
}

$smarty->registerPlugin("function", "newIP", "newIP");

$smarty->assign("bCrumbs", "Full Computer List");
//$smarty->assign("computers", $sql->getAllComputers());
$smarty->assign("computers", $sql->getFixedIPs());
$smarty->display('Fixlist.tpl');