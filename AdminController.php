<?php
/**
 * Created by PhpStorm.
 * User: Marijus
 * Date: 3/20/14
 * Time: 11:22 AM
 */

namespace Plugin\FormExample;


class AdminController extends \Ip\GridController
{

    protected  function config(){
        return array(
            'title' => 'Person list',
            'table' => 'formExample',
            'deleteWarning' => 'Do you really want to delete this ad?',
            'sortField' => 'productOrder',
            'createPosition' => 'top',
            'pageSize' => 25,
            'fields' => array(
                array(
                    'label' => 'productName',
                    'field' => 'productName',
                    'validators' => array('Required')
                ),
                array(
                    'label' => 'productDescription',
                    'field' => 'productDescription'
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
                    'label' => 'phone',
                    'field' => 'phone',
                    'validators' => array('Required')
                ),
                array(
                    'type' => 'Checkbox',
                    'label' => 'hidePhone',
                    'showInList' => true,
                    'field' => 'hidePhone'
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