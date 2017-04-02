<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 3/30/2017
 * Time: 5:52 AM
 */

include_once 'admin.config.php';

$smarty->assign("computers", $sql->getAllComputers());

$smarty->display('list.tpl');