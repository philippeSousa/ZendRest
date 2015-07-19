<?php

namespace Restapi\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\TableGateway\TableGateway;
use Restapi\Model\Country;
use Restapi\Model\CountryTable;
use Restapi\Form;

class AdminController extends AbstractActionController
{

    public function indexAction()
    {
    	
    	$form = new Form\Register;
    	
    	$allCountries = $this->getAllCountries(); 
    	
        return new ViewModel(["allCountries" => $allCountries, "form" => $form]);
    }

    public function homeAction()
    {
        return new ViewModel();
    }

    protected function getAllCountries()
    {
    	$sm = $this->getServiceLocator();
    	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
    	$resultSetPrototype = new \Zend\Db\ResultSet\ResultSet;
    	$resultSetPrototype->setArrayObjectPrototype(new Country);
    	$tableGateWay = new TableGateway('country', $dbAdapter, null, $resultSetPrototype);
    
    	$countryTable = new CountryTable($tableGateWay);
    	
    	return $countryTable->fetchAll();
    }
    
}

?>