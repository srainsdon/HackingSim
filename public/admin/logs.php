<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/6/2017
 * Time: 7:41 PM
 */
$smarty->append('bCrumbs', "<span class=\"breadcrumb-item active\">Log Reader</span>");
if ($extras->isRemoteDev()) {
    $smarty->append('body', "You are a dev!<br />\n");
}
foreach ($extras->getLogList() as $logFile) {
    $smarty->append('body', $logFile . "<br />\n");
}
$smarty->display('main.tpl');