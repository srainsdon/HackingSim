<?php

/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/6/2017
 * Time: 12:06 AM
 */
class sns_Extras
{

    private $smarty;
    private $sql;
    private $user;

    function __construct(Smarty_HackingSim &$smarty, sqlManager &$sql, userManager &$user)
    {
        $this->smarty = $smarty;
        $this->sql = $sql;
        $this->user = $user;
    }

    function getIp()
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] != '') {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    function server_info()
    {
        ob_start();
        phpinfo(11);
        $phpinfo = array('phpinfo' => array());

        if (preg_match_all('#(?:<h2>(?:<a name=".*?">)?(.*?)(?:</a>)?</h2>)|(?:<tr(?: class=".*?")?><t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>(?:<t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>(?:<t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>)?)?</tr>)#s', ob_get_clean(), $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                if (strlen($match[1])) {
                    $phpinfo[$match[1]] = array();
                } elseif (isset($match[3])) {
                    $keys1 = array_keys($phpinfo);
                    $phpinfo[end($keys1)][$match[2]] = isset($match[4]) ? array($match[3], $match[4]) : $match[3];
                } else {
                    $keys1 = array_keys($phpinfo);
                    $phpinfo[end($keys1)][] = $match[2];

                }

            }
        }
        $tempData = null;
        if (!empty($phpinfo)) {
            foreach ($phpinfo as $name => $section) {
                $tempData .= "<h3>$name</h3>\n<table class='wp-list-table widefat fixed pages'>\n";
                foreach ($section as $key => $val) {
                    if (is_array($val)) {
                        $tempData .= "<tr><td>$key</td><td>$val[0]</td><td>$val[1]</td></tr>\n";
                    } elseif (is_string($key)) {
                        $tempData .= "<tr><td>$key</td><td>$val</td></tr>\n";
                    } else {
                        $tempData .= "<tr><td>$val</td></tr>\n";
                    }
                }
            }
            $tempData .= "</table>\n";
        } else {
            $tempData .= "<h3>Sorry, the phpinfo() function is not accessable. Perhaps, it is disabled<a href='http://php.net/manual/en/function.phpinfo.php'>See the documentation.</a></h3>";
        }
        return $tempData;
    }

    function checkACL($level)
    {
        $acl = $this->auth->isAuthorised($level);
        if ($acl !== userManager::AUTHORISED && $acl === userManager::LOGGED_IN) {
            header('HTTP/1.0 403 Forbidden');
            $this->smarty->append('bCrumbs', "<span class=\"breadcrumb-item active\">Not Autherised</span>");
            $this->smarty->assign('alert', 'You are not authorised!!!');
            $this->smarty->display('main.tpl');
            exit;
        } elseif ($acl === userManager::GUEST) {
            $this->smarty->append('bCrumbs', "<span class=\"breadcrumb-item active\">Not Logged In</span>");
            $this->smarty->assign('alert', 'You are not Logged In!!!');
            $this->smarty->display('main.tpl');
            exit;
        }
    }
}