<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 3/30/2017
 * Time: 5:52 AM
 */

include_once 'admin.config.php';

$smarty->assign("data", print_r($sql->getAllComputers(), true));

$smarty->display('list.tpl');