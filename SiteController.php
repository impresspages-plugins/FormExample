<?php

namespace Plugin\FormExample;

class SiteController extends \Ip\Controller
{

    public function index() // TODO
    {
        $data['products'] = Model::getAllProducts();

        $renderedHtml = ipView('view/list.php', $data)->render();

        return $renderedHtml;
    }

    public function showForm()  // TODO
    {

        $renderedHtml = ipView('view/form.php')->render();

        return $renderedHtml;
    }

    public function save()
    {
        Model::saveProduct(ipRequest()->getPost());

        $actionUrl = ipActionUrl(array('sa' => 'FormExample.showSuccessMessage'));

        $toJson = array('redirectUrl' => $actionUrl);

        return new \Ip\Response\Json($toJson);
    }

    public function showSuccessMessage(){
        return "Form submitted successfully"; // TODO
    }


}
