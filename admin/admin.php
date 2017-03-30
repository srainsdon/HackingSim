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
$data = $computer->getData();
/* Get Nibble Forms 2 instance called mega_form */
$form = \Nibble\NibbleForms\NibbleForm::getInstance('ComputerID1','',true,'post','Submit',"table");

/* Text field with custom class and max length attribute */
foreach ($data as $k => $v) {
    $form->addField($k, 'text', array(
        'class' => 'form-control',
        'max_length' => 20
    ));
    $form->addData(array(
            $k => $data[$k]
        )
    );
}

echo "<!DOCTYPE html>\n<head>\n<title>Nibble Forms Demo</title>\n"
    . "<script src=\"http://www.google.com/jsapi\" type=\"textjavascript\"></script>\n"
    . "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"style.css\" />\n"
    . "<!-- Bootstrap core CSS -->\n"
    . "<link href=\"//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\" rel=\"stylesheet\">\n"
    . "</head><body>\n";


// If the form is valid, do something


echo $form->render();
echo "\n<script src=\"//code.jquery.com/jquery-3.1.1.min.js\" crossorigin=\"anonymous\"></script>\n<script src=\"//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\" crossorigin=\"anonymous\"></script>\n</body>\n</html>";

if ($form->validate()) {
    echo "Form has validated";
}