<?php
/**
 * Created by PhpStorm
 * User: srainsdon
 * Date: 4/2/2017
 * Time: 5:19 AM
 */

if ($auth->isLogged()) {
    $comps = $sql->getUsersComputers('1');
    $smarty->assign('computers', $comps);
    $smarty->assign("MyNetworks", $sql->getUsersNetworks(1));
    if (isset($_POST['cmd'])) {
        $commands->addToHistory("#>" . $_POST['cmd']);
        $comand = explode(' ', $_POST['cmd']);
        switch ($comand[0]) {
            case 'connect':
                $commands->addToHistory('Connected to ' . $comand[1]);
                $_SESSION['ConnectedTo'] = $comand[1];
                $comp = $sql->getComputerByIP($comand[1]);
                $ip = new ipv4($comp['CIDR']);
                $_SESSION['DisplayData']['ConnectedTo'] = $_SESSION['ConnectedTo'] . " - " . $comp['ComputerName'];
                break;
            case 'ping':
                $commands->ping($_SESSION['ConnectedTo'], $comand[1]);
                break;
            case 'disconnect':
            case 'dc':
                $commands->addToHistory("Disconnected from " . $_SESSION['ConnectedTo']);
                $_SESSION['ConnectedTo'] = null;
                $_SESSION['DisplayData']['ConnectedTo'] = null;
                break;
            default:
                $commands->addToHistory($comand[0] . " is an unknown command try help.");
        }
    }
    if (isset($computerip)) {
        $tempData = array();
        foreach ($sql->getNetworkList() as $row) {
            $tempData[$row['NetworkID']] = $row['NetName'];
        }
        $smarty->assign("Networks", $tempData);
        $smarty->assign('Computer', $sql->getComputerByIP($computerip));
        $smarty->display('userComputer.tpl');
    } else {
        $smarty->append('bCrumbs', "<span class=\"breadcrumb-item active\">Home</span>");
        $smarty->assignByRef('CommandHistory', $_SESSION['CommandHistory']);
        $smarty->display('home.tpl');
    }
} else {
    $smarty->append('bCrumbs', "<span class=\"breadcrumb-item active\">Log In</span>");
    $smarty->display('home.tpl');
}
