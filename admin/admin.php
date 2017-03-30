<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 3/30/2017
 * Time: 5:52 AM
 */

include_once '../config.php';
session_start();
$computer = new computer($sql, "1");
$data = $computer->getData();
/* Get Nibble Forms 2 instance called mega_form */
$form = \Nibble\NibbleForms\NibbleForm::getInstance('ComputerID1','',true,'post','Submit',"table");

/* Text field with custom class and max length attribute */
$smarty->assign('data', $data);

$smarty->display('computer.tpl');