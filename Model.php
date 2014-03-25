<?php
/**
 * Created by PhpStorm.
 * User: Marijus
 * Date: 3/25/14
 * Time: 2:21 PM
 */

namespace Plugin\FormExample;


class Model {
    public static function getAllProducts() {

        $products = ipDb()->selectAll('formExample', array('imageFile', 'productName', 'dateSubmitted'));

        return $products;
    }


    public static function showImage($value, $recordData = null){

        if ($value){
            $transform = new \Ip\Transform\ImageFit(100, 50);
            return '<img src="'.ipReflection($value, $transform, 'preview.jpg').'" alt="'.esc($value).'">';
        }else{
            return false;
        }
    }


    public static function saveProduct() {

        $product = array(
            'productName' => ipRequest()->getPost('productName'),
            'personName' => ipRequest()->getPost('personName'),
            'phone' => ipRequest()->getPost('phone'),
            'email' => ipRequest()->getPost('email'),
            // s'imageFile' => ipRequest()->getPost('imageFile'),
            'dateSubmitted' => date('Y-m-d h:i')
        );

        ipDb()->insert('formExample', $product);

    }
} 