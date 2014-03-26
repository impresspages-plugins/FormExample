<?php
namespace Plugin\FormExample;

class ValidateUpload extends \Ip\Form\Validator
{
    public function getError($values, $valueKey, $environment)
    {
        if (!isset($values['imageFile']['file'][0]) || (count($values['imageFile']['file']) != 1)) {
            return "Please upload a single image";
        } else {
            return false;
        }
    }
}