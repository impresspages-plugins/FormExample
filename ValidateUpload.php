<?php
namespace Plugin\FormExample;

class ValidateUpload extends \Ip\Form\Validator
{

    // Custom data validator
    public function getError($values, $valueKey, $environment)
    {

        // Validate if only a single image is uploaded
        if (!isset($values['imageFile']['file'][0]) || (count($values['imageFile']['file']) != 1)) {
            return __("Please upload a single image", 'FormExample');
        } else {
            return false;
        }
    }
}