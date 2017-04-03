<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 3/29/2017
 * Time: 5:40 AM
 */

error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();

require 'vendor/autoload.php';
$base = $_SERVER["DOCUMENT_ROOT"];
include_once "$base/classes/sqlManager.class.php";
include_once "$base/db.config.php";
$sql = new sqlManager($host, $db, $user, $pass);
$smarty = new Smarty;

include_once "$base/classes/computer.class.php";
include_once "$base/classes/random.class.php";
include_once "$base/classes/fileSystem.class.php";

class Smarty_GuestBook extends Smarty
{

    function __construct()
    {

        // Class Constructor.
        // These automatically get set with each new instance.

        parent::__construct();

        $this->setTemplateDir('./smarty/templates/');
        $this->setCompileDir('./smarty/templates_c/');
        $this->setConfigDir('./smarty/configs/');
        $this->setCacheDir('./smarty/cache/');

        $this->caching = Smarty::CACHING_LIFETIME_CURRENT;
        $this->assign('app_name', 'Game Simulator');
    }

}

// include_once("dBug.php");
