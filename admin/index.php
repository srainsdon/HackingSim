<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/2/2017
 * Time: 5:19 AM
 */

include_once 'admin.config.php';

$smarty->assign('links', array(
    'Computers' => './computer.php',
    'Networks' => './network.php',
));

$smarty->display('index.tpl');