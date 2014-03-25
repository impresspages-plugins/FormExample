FORM
<?php
/**
 * Created by PhpStorm.
 * User: Marijus
 * Date: 3/25/14
 * Time: 2:19 PM
 */

$form = new \Ip\Form();
// Add a text field to form object
$field = new \Ip\Form\Field\Text(
    array(
        'name' => 'productName', // HTML "name" attribute
        'label' => 'Product name', // Field label that will be displayed next to input field
    ));
$form->addField($field);


$field = new \Ip\Form\Field\Text(
    array(
        'name' => 'personName', // HTML "name" attribute
        'label' => 'Person name', // Field label that will be displayed next to input field
    ));
$form->addField($field);

$field = new \Ip\Form\Field\Text(
    array(
        'name' => 'phone', // HTML "name" attribute
        'label' => 'Phone', // Field label that will be displayed next to input field
    ));
$form->addField($field);

$field = new \Ip\Form\Field\Email(
    array(
        'name' => 'email', // HTML "name" attribute
        'label' => 'E-mail', // Field label that will be displayed next to input field
    ));
$form->addField($field);

$field = new \Ip\Form\Field\File(
    array(
        'name' => 'imageFile', // HTML "name" attribute
        'label' => 'Image of your product:', // Field label that will be displayed next to input field
    ));
$form->addField($field);


$field = new \Ip\Form\Field\Hidden(
    array(
        'name' => 'sa', // HTML "name" attribute
        'value' => 'FormExample.save', // Field label that will be displayed next to input field
    ));
$form->addField($field);

$form->addField(new \Ip\Form\Field\Submit(array('value' => 'Save')));

$formHtml = $form->render();
echo $formHtml;