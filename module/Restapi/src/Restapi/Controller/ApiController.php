<?php

namespace Restapi\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ApiController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel();
    }

    public function postAction()
    {
        return new ViewModel();
    }

    public function getAction()
    {
        return new ViewModel();
    }


}

