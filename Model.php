<?php
namespace Plugin\FormExample;

use Ip\Form\Exception;

class Model {
    public static function getAllProducts() {

        $products = ipDb()->selectAll('formExample', array('imageFile', 'imageName', 'dateSubmitted'));

        return $products;
    }


    public static function showImage($value, $recordData = null){

        if ($value){

            $transform = new \Ip\Transform\ImageFit(100, 50);
            $thumbnailUrl = ipReflection($value, $transform, 'preview.jpg');
            $imageHtml = '<img src="'.$thumbnailUrl.'" alt="'.esc($value).'">';

            return $imageHtml;
        }else{
            return false;
        }
    }


    public static function saveImageRecord($product) {

        $imageId = ipDb()->insert('formExample', $product);
        ipBindFile($product['imageFile'], 'Table_formExample_imageFile', $imageId);

    }
}
