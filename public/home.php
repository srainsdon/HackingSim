<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/2/2017
 * Time: 5:19 AM
 */


$ip = new ipv4("192.168.2.1", 24);
$message = "Address: {$ip->address()}\n";
$message .= "Netbits: {$ip->netbits()}\n";
$message .= "Netmask: {$ip->netmask()}\n";
$message .= "Inverse: {$ip->inverse()}\n";
$message .= "Network: {$ip->network()}\n";
$message .= "Broadcast: {$ip->broadcast()}\n";


$smarty->assign('body', nl2br($message));
$smarty->display('main.tpl');