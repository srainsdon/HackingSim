<?php

class Smarty_HackingSim extends Smarty
{
    function __construct($debug = false)
    {

        // Class Constructor.
        // These automatically get set with each new instance.

        parent::__construct();
        $this->setTemplateDir("/app/smarty/templates/");
        $this->setCompileDir("/app/smarty/templates_c/");
        $this->setConfigDir("/app/smarty/configs/");
        $this->setCacheDir("/app/smarty/cache/");
        $this->setDebugTemplate('/app/smarty/templates/debug.tpl');
        if ($debug) {
            $this->setDebugging(true);
        }
        $this->assign('app_name', 'Game Simulator');
    }

}