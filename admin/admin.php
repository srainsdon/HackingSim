<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 3/30/2017
 * Time: 5:52 AM
 */

include_once '../config.php';
session_start();
$computer = new computer($sql, "1");
/* Get Nibble Forms 2 instance called mega_form */
$form = \Nibble\NibbleForms\NibbleForm::getInstance('ComputerID1');

/* Text field with custom class and max length attribute */
$form->addField('IP_Address', 'text', array(
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


echo "<!DOCTYPE html>\n<head>\n<title>Nibble Forms Demo</title>\n"
    . "<script src=\"http://www.google.com/jsapi\" type=\"textjavascript\"></script>\n"
    . "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"style.css\" />\n"
    . "<!-- Bootstrap core CSS -->\n"
    . "<link href=\"//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\" rel=\"stylesheet\">\n"
    . "</head><body>\n";


// If the form is valid, do something
$data = $computer->getComputerInfo();
$form->addData(array(
        "IP_Address" => $data['IP Address'],
    )
);
echo $form->render();
echo "\n<script src=\"//code.jquery.com/jquery-3.1.1.min.js\" crossorigin=\"anonymous\"></script>\n</body>\n</html>";

if ($form->validate()) {
    echo "Form has validated";
}