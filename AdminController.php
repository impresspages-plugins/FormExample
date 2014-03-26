<?php
namespace Plugin\FormExample;

class AdminController extends \Ip\GridController
{

    protected  function config(){
        return array(
            'title' => 'Person list',
            'table' => 'formExample',
            'deleteWarning' => __('Do you really want to delete this item?', 'FormExample'),
            'sortField' => 'imageOrder',
            'createPosition' => 'top',
            'pageSize' => 25,
            'fields' => array(
                array(
                    'label' => __('Image name', 'FormExample'),
                    'field' => 'imageName',
                    'validators' => array('Required')
                ),
                array(
                    'type' => 'RepositoryFile',
                    'label' => __('Image file', 'FormExample'),
                    'field' => 'imageFile',
                    'preview' => 'Plugin\FormExample\Model::showImage' // Use showImage method from plugin's Model class.
                ),
                array(
                    'label' => __('Submitted by', 'FormExample'),
                    'field' => 'personName',
                    'validators' => array('Required')
                ),
                array(
                    'label' => __('E-mail', 'FormExample'),
                    'field' => 'email',
                    'validators' => array('Email')
                ),
                array(
                    'label' => __('Date submitted', 'FormExample'),
                    'field' => 'dateSubmitted',
                    'preview' => true
                )

            )
        );
    }

}