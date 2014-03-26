<?php
namespace Plugin\FormExample;

class SiteController extends \Ip\Controller
{

    public function index()
    {
        $data['images'] = Model::getAllImages();
        $renderedHtml = ipView('view/list.php', $data)->render();

        return $renderedHtml;
    }

    public function showForm()
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
            // Validation error

            $status = array('status' => 'error', 'errors' => $errors);

            return new \Ip\Response\Json($status);
        } else {
            // Success

            $images = \Ip\Form\Field\File::getFiles(ipRequest()->getPost(), 'imageFile');
            $filenameInRepository = ipRepositoryAddFile($images[0]);

            $image = array(
                'imageName' => ipRequest()->getPost('imageName'),
                'personName' => ipRequest()->getPost('personName'),
                'email' => ipRequest()->getPost('email'),
                'imageFile' => $filenameInRepository,
                'dateSubmitted' => date('Y-m-d H:i')
            );

            Model::saveImageRecord($image, $filenameInRepository);

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

        $field = new \Ip\Form\Field\Text(
            array(
                'name' => 'imageName', 'label' => __('Image name', 'FormExample'), 'validators' => array('Required'),
            ));
        $form->addField($field);

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
