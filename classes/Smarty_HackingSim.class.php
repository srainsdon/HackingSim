<?php

class Smarty_HackingSim extends Smarty
{
    function __construct()
    {

        // Class Constructor.
        // These automatically get set with each new instance.

        parent::__construct();
        $base = $_SERVER["DOCUMENT_ROOT"];
        $this->setTemplateDir("$base/smarty/templates/");
        $this->setCompileDir("$base/smarty/templates_c/");
        $this->setConfigDir("$base/smarty/configs/");
        $this->setCacheDir("$base/smarty/cache/");

        $this->assign('app_name', 'Game Simulator');
    }

}