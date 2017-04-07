<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/6/2017
 * Time: 7:41 PM
 */
$this->smarty->append('bCrumbs', "<span class=\"breadcrumb-item active\">Log Reader</span>");
if ($extras->isRemoteDev()) {
    $this->smarty->append('body', 'You are a dev!');
}
foreach ($extras->getLogList() as $logFile) {
    $this->smarty->append('body', $logFile);
}
$this->smarty->display('main.tpl');