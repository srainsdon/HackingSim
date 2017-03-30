<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 3/30/2017
 * Time: 5:52 AM
 */

include_once '../config.php';
session_start();
include("$base/vendor/pfbc/pfbc/PFBC/Form.php");
$form = new PFBC\Form("GettingStarted");
$form->addElement(new PFBC\Element\Textbox("My Textbox:", "MyTextbox"));
$form->addElement(new PFBC\Element\Select("My Select:", "MySelect", array(
    "Option #1",
    "Option #2",
    "Option #3"
)));
$form->addElement(new PFBC\Element\Button);
$form->render();