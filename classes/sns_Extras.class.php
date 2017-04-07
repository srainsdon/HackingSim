<?php

/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/6/2017
 * Time: 12:06 AM
 */
class sns_Extras
{
    const DEV_IP_ARRAY = array('172.58.46.230');
    const IP_BLACKLIST = array();
    private $smarty;
    private $sql;
    private $user;

    function __construct(Smarty_HackingSim &$smarty, sqlManager &$sql, userManager &$user)
    {
        $this->smarty = $smarty;
        $this->sql = $sql;
        $this->user = $user;
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
        $acl = $this->user->isAuthorised($level);
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

    function getLogList()
    {
        $errorPath = array(
            'error' => ini_get('error_log'),
            'access' => ini_get('access_log'),
            'log4php' => ini_get('/app/log/my.log')
        );
    }

    /**
     * Slightly modified version of http://www.geekality.net/2011/05/28/php-tail-tackling-large-files/
     * @author Torleif Berger, Lorenzo Stanco
     * @link http://stackoverflow.com/a/15025877/995958
     * @license http://creativecommons.org/licenses/by/3.0/
     */
    function tailCustom($filepath, $lines = 1, $adaptive = true)
    {
        // Open file
        $f = @fopen($filepath, "rb");
        if ($f === false) return false;
        // Sets buffer size, according to the number of lines to retrieve.
        // This gives a performance boost when reading a few lines from the file.
        if (!$adaptive) $buffer = 4096;
        else $buffer = ($lines < 2 ? 64 : ($lines < 10 ? 512 : 4096));
        // Jump to last character
        fseek($f, -1, SEEK_END);
        // Read it and adjust line number if necessary
        // (Otherwise the result would be wrong if file doesn't end with a blank line)
        if (fread($f, 1) != "\n") $lines -= 1;

        // Start reading
        $output = '';
        $chunk = '';
        // While we would like more
        while (ftell($f) > 0 && $lines >= 0) {
            // Figure out how far back we should jump
            $seek = min(ftell($f), $buffer);
            // Do the jump (backwards, relative to where we are)
            fseek($f, -$seek, SEEK_CUR);
            // Read a chunk and prepend it to our output
            $output = ($chunk = fread($f, $seek)) . $output;
            // Jump back to where we started reading
            fseek($f, -mb_strlen($chunk, '8bit'), SEEK_CUR);
            // Decrease our line counter
            $lines -= substr_count($chunk, "\n");
        }
        // While we have too many lines
        // (Because of buffer size we might have read too many)
        while ($lines++ < 0) {
            // Find first newline and remove all text before that
            $output = substr($output, strpos($output, "\n") + 1);
        }
        // Close file and return
        fclose($f);
        return trim($output);
    }

    function isRemoteDev()
    {
        if (in_array($this->getIp(), DEV_IP_ARRAY)) {
            return true;
        } else {
            return false;
        }
    }

    function getIp()
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] != '') {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }
}