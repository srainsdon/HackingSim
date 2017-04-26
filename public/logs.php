<?php
$smarty = new Smarty_HackingSim();
$smarty->append('bCrumbs', "<span class=\"breadcrumb-item active\">Log Reader</span>");
$smarty->display('logs.tpl');