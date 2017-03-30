<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 3/30/2017
 * Time: 5:52 AM
 */

include_once '../config.php';
session_start();
/* Get Nibble Forms 2 instance called mega_form */
$form = \Nibble\NibbleForms\NibbleForm::getInstance('mega_form');

/* Text field with custom class and max length attribute */
$form->addField('text_field', 'text', array(
    'class' => 'testy classes',
    'max_length' => 20
));

/* Email field, not required and custom label text */
$email = $form->addfield('email', 'email', array(
    'required' => false,
    'label' => 'Please enter your email address'
));
/* Email confirmation field which must match the value for email */
$email->addConfirmation('confirm_email', array(
    'label' => 'Please confirm your email address'
));

/* Radio button field with two options, first option has an additional attribute */
$form->addField('choice', 'radio', array(
    'choices' => array(
        "one" => array('data-example' => 'data-attribute-value', 'Choice One'),
        "two" => "Choice Two"),
    'false_values' => array("two")
));


echo "<!DOCTYPE html><head><title>Nibble Forms Demo</title>"
    ."<script src=\"http://www.google.com/jsapi\" type=\"textjavascript\"></script>"
    ."<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"style.css\" />"
    ."<!-- Bootstrap core CSS -->"
    ."<link href=\"//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\" rel=\"stylesheet\">"
    ."</head><body>";


/* If the form is valid, do something */

echo $form->render();
echo "<script src=\"//code.jquery.com/jquery-3.1.1.min.js\" crossorigin=\"anonymous\"></script></body></html>";

if ($form->validate()) {
    echo "Form has validated";
}