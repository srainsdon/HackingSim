<?php

class Smarty_HackingSim extends Smarty
{
    function __construct()
    {

        // Class Constructor.
        // These automatically get set with each new instance.

        parent::__construct();
        $this->setTemplateDir("/app/smarty/templates/");
        $this->setCompileDir("/app/smarty/templates_c/");
        $this->setConfigDir("/app/smarty/configs/");
        $this->setCacheDir("/app/smarty/cache/");

        $this->assign('app_name', 'Game Simulator');
    }

}