<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/2/2017
 * Time: 5:19 AM
 */

if($auth->isLogged()) {
    $ip = new ipv4("192.168.2.1", 24);
    $message = "Address: {$ip->getAddress()}\n";
    $message .= "Netbits: {$ip->getCidr()}\n";
    $message .= "BroadcastIP: {$ip->getBroadcastIP()}\n";
    $message .= "Network: {$ip->getSubNetID()}\n";
} else {
    $message = "Please Log In";
}

$smarty->assign('body', nl2br($message));
$smarty->display('main.tpl');