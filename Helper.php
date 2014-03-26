<?php
/**
 * Created by PhpStorm.
 * User: Marijus
 * Date: 3/26/14
 * Time: 4:45 PM
 */

namespace Plugin\FormExample;


class Helper
{

    public static function createForm()
    {

        $form = new \Ip\Form();

        $field = new \Ip\Form\Field\Text(
            array(
                'name' => 'personName', 'label' => __('Your name', 'FormExample'), 'validators' => array('Required'),
            ));
        $form->addField($field);

        $field = new \Ip\Form\Field\Email(
            array(
                'name' => 'email', 'label' => __('E-mail', 'FormExample'),
            ));
        $form->addField($field);

        $field = new \Ip\Form\Field\Text(
            array(
                'name' => 'imageTitle', 'label' => __('Image title', 'FormExample'), 'validators' => array('Required'),
            ));
        $form->addField($field);

        // Upload product images
        $field = new \Ip\Form\Field\File(
            array(
                'name' => 'imageFile', 'label' => __('Your image file:', 'FormExample'), 'validators' => array('Required'),
            ));

        $customValidator = new ValidateUpload(); // Validate uploaded file
        $field->addValidator($customValidator); //$customValidator should extend \Ip\Form\Validator  class

        $form->addField($field);

        // 'sa' means Site controller action.
        $field = new \Ip\Form\Field\Hidden(
            array(
                'name' => 'sa',
                'value' => 'FormExample.save', // `FormExample` site controller's `save` action.
            ));
        $form->addField($field);

        // Submit button
        $form->addField(new \Ip\Form\Field\Submit(array('value' => 'Save')));

        return $form;
    }

} 