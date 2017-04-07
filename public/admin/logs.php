<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/6/2017
 * Time: 7:41 PM
 */
$smarty->append('bCrumbs', "<span class=\"breadcrumb-item active\">Log Reader</span>");
if ($extras->isRemoteDev()) {
    $smarty->append('body', 'You are a dev!');
}
foreach ($extras->getLogList() as $logFile) {
    $smarty->append('body', $logFile);
}
$smarty->display('main.tpl');