<?php
namespace Plugin\FormExample;

class AdminController extends \Ip\GridController
{

    protected  function config(){
        return array(
            'title' => 'Person list',
            'table' => 'formExample',
            'deleteWarning' => 'Do you really want to delete this item?',
            'sortField' => 'imageOrder',
            'createPosition' => 'top',
            'pageSize' => 25,
            'fields' => array(
                array(
                    'label' => 'Image name',
                    'field' => 'imageName',
                    'validators' => array('Required')
                ),
                array(
                    'label' => 'Image description',
                    'field' => 'imageDescription'
                ),
                array(
                    'type' => 'RepositoryFile',
                    'label' => 'imageFile',
                    'field' => 'imageFile',
                    'preview' => 'Plugin\FormExample\Model::showImage'
                ),
                array(
                    'label' => 'personName',
                    'field' => 'personName',
                    'validators' => array('Required')
                ),
                array(
                    'label' => 'email',
                    'field' => 'email',
                    'validators' => array('Email')
                ),
                array(
                    'label' => 'dateSubmitted',
                    'field' => 'dateSubmitted',
                    'preview' => true
                )

            )
        );
    }

}