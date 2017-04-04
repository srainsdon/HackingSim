<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/2/2017
 * Time: 5:19 AM
 */

include_once '../config.php';

$smarty->assign('links', array(
    'Computers' => '/admin/computer/',
    'Networks' => '/admin/network/',
));

$smarty->display('home.tpl');