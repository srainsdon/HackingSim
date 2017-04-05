<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/2/2017
 * Time: 5:19 AM
 */


ob_start();
$ip = new ipv4("192.168.2.1", 24);
print "Address: $ip->address()\n";
print "Netbits: $ip->netbits()\n";
print "Netmask: $ip->netmask()\n";
print "Inverse: $ip->inverse()\n";
print "Network: $ip->network()\n";
print "Broadcast: $ip->broadcast()\n";
$message = ob_flush();
$smarty->assign('body', nl2br(getIpInfo() . '\n\n' . $message));
$smarty->display('main.tpl');