<?php
namespace Plugin\FormExample;

use Ip\Form\Exception;

class Model {
    public static function getAllImages() {

        $images = ipDb()->selectAll('formExample', array('imageFile', 'imageName', 'personName', 'dateSubmitted'));

        return $images;
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


    public static function saveImageRecord($image) {

        $imageId = ipDb()->insert('formExample', $image);
        ipBindFile($image['imageFile'], 'Table_formExample_imageFile', $imageId);

    }
}
