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

        $form = Helper::createForm();
        $data['form'] = $form;
        $renderedHtml = ipView('view/form.php', $data)->render();

        return $renderedHtml;
    }

    public function save()
    {

        $form = Helper::createForm();

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
                'imageTitle' => ipRequest()->getPost('imageTitle'),
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


}
