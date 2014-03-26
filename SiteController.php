<?php
namespace Plugin\FormExample;

class SiteController extends \Ip\Controller
{

    public function index() // TODO default list
    {
        $data['products'] = Model::getAllProducts();
        $renderedHtml = ipView('view/list.php', $data)->render();

        return $renderedHtml;
    }

    public function showForm() // TODO showing form
    {

        $form = self::getForm();
        $data['form'] = $form;
        $renderedHtml = ipView('view/form.php', $data)->render();

        return $renderedHtml;
    }

    public function save()
    {

        $form = self::getForm();

        $postData = ipRequest()->getPost();
        $errors = $form->validate($postData);

        if ($errors) {
            $status = array('status' => 'error', 'errors' => $errors); //failure
            return new \Ip\Response\Json($status);
        } else {
            //success
            $images = \Ip\Form\Field\File::getFiles(ipRequest()->getPost(), 'imageFile');

            foreach ($images as $image) {
                $filenameInRepository = ipRepositoryAddFile($image);
            }

            $product = array(
                'productName' => ipRequest()->getPost('productName'),
                'personName' => ipRequest()->getPost('personName'),
                'phone' => ipRequest()->getPost('phone'),
                'email' => ipRequest()->getPost('email'),
                'imageFile' => $filenameInRepository,
                'dateSubmitted' => date('Y-m-d H:i')
            );

            Model::saveImageRecord($product, $filenameInRepository);

            $actionUrl = ipActionUrl(array('sa' => 'FormExample.showSuccessMessage'));
            $status = array('redirectUrl' => $actionUrl);
            return new \Ip\Response\Json($status);
        }

    }

    public function showSuccessMessage()
    {
        $renderedHtml = ipView('view/success.php')->render();

        return $renderedHtml;
    }

    public static function getForm() {

        $form = new \Ip\Form();

        // Add a product name text field
        $field = new \Ip\Form\Field\Text(
            array(
                'name' => 'imageName', // HTML "name" attribute
                'label' => 'Image name', // Field label that will be displayed next to input field
            ));
        $form->addField($field);


        // Add a product description text area
        $field = new \Ip\Form\Field\TextArea(
            array(
                'name' => 'imageDescription', // HTML "name" attribute
                'label' => 'Image description', // Field label that will be displayed next to input field
            ));
        $form->addField($field);


        // Add a person name
        $field = new \Ip\Form\Field\Text(
            array(
                'name' => 'personName', // HTML "name" attribute
                'label' => 'Your name', // Field label that will be displayed next to input field
            ));
        $form->addField($field);


        // Add an e-mail field
        $field = new \Ip\Form\Field\Email(
            array(
                'name' => 'email', // HTML "name" attribute
                'label' => 'E-mail', // Field label that will be displayed next to input field
            ));
        $form->addField($field);

        // Upload product images
        $field = new \Ip\Form\Field\File(
            array(
                'name' => 'imageFile', // HTML "name" attribute
                'label' => 'Your image file:' // Field label that will be displayed next to input field
            ));

        $customValidator = new ValidateUpload();
        $field->addValidator($customValidator); //$customValidator should extend \Ip\Form\Validator  class

        $form->addField($field);

        // 'sa' means Site controller action.
        $field = new \Ip\Form\Field\Hidden(
            array(
                'name' => 'sa', // HTML "name" attribute
                'value' => 'FormExample.save', // Field label that will be displayed next to input field
            ));
        $form->addField($field);

        $form->addField(new \Ip\Form\Field\Submit(array('value' => 'Save')));

        return $form;
    }

}
