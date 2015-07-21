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
    	
    	/* Instanciation d'un tableGateway pour country */
    	$sm = $this->getServiceLocator();
    	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
    	$resultSetPrototype = new \Zend\Db\ResultSet\ResultSet;
    	$resultSetPrototype->setArrayObjectPrototype(new Country);
    	$tableGateWay = new TableGateway('country', $dbAdapter, null, $resultSetPrototype);
    	
    	$countryTable = new CountryTable($tableGateWay);
    	$form = new Form\Register;
    	$libelleValidation = "";
    	
    	if ($this->request->isPost())
    	{
    		$dataPosted = $this->request->getPost();
    		//var_dump($dataPosted);
    		
    		/* S'il a cliqué sur le bouton suppression, on supprime l'id, sinon c'est un create ou update */
    		if (isset($dataPosted->suppression))
    		{
    			$countryTable->deleteCountry($dataPosted->id);
    		}
    		else {
        		$formReceivedData = new Form\Register;
        		$formReceivedData->setData($dataPosted);
        		if ($formReceivedData->isValid())
        		{
        			$libelleValidation = "Enregistrement effectué ";
        			$newCountry = new Country();
        			$newCountry->exchangeArray($dataPosted);
        			$countryTable->saveCountry($newCountry);
        		} else {
        			$libelleValidation = "Les données inserées ne sont pas valides";
        			$form->setData($dataPosted);
        		}
    		}
    		
    		
    	}
    	//saveCountry
    	

    	$form2 = new Form\RegisterArrayLine;
    	
    	$allCountries = $countryTable->fetchAll(); 
    	$viewModel = new ViewModel([
    			                     "allCountries" => $allCountries, 
    			                     "form" => $form, 
    			                     "form2" => $form2,
    			                     "libelleValidation" => $libelleValidation
    			
                                	]);

        return $viewModel;
    }

    public function homeAction()
    {
        return new ViewModel();
    }

}

?>