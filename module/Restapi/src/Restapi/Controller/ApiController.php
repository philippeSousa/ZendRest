<?php

namespace Restapi\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class ApiController extends AbstractActionController
{

    public function indexAction()
    {


    	 $response = new \Zend\Http\Response();
//     	 $this->getResponse()
//     	     ->setHeader('Content-Type', 'application/json; charset=UTF-8');
    	 
    	$result = new JsonModel(array(
    	    'some_parameter' => 'some value',
    	    'success'=>true,
    	));
    	
    	return $result;
    	 
    	return;
    	//return new ViewModel();
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

