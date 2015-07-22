<?php

namespace Restapi\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Db\TableGateway\TableGateway;
use Restapi\Model\Country;
use Restapi\Model\CountryTable;

class ApiController extends AbstractActionController
{

    public function indexAction()
    {
    	
    	$retour = Array();
    	 
    	$request = new \Zend\Http\PhpEnvironment\Request();
    	$methode = $request->getServer('REQUEST_METHOD');
    	
    	if ($methode == "GET")
    	{
        	/* Instanciation d'un tableGateway pour country */
        	$sm = $this->getServiceLocator();
        	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
        	$resultSetPrototype = new \Zend\Db\ResultSet\ResultSet;
        	$resultSetPrototype->setArrayObjectPrototype(new Country);
        	$tableGateWay = new TableGateway('country', $dbAdapter, null, $resultSetPrototype);
        	 
        	$countryTable = new CountryTable($tableGateWay);
        	
        	$response = new \Zend\Http\Response();
        	
        	$retour = $countryTable->fetchAllToArray();
        	
    	} else if ($methode == "POST")
    	{
    		$retour["method"] = "POST"; 
    	} else {
    		$retour["error"] = "405 : Forbidden method";    		
    	}
    	
    	return  new JsonModel($retour);
    }

    public function postAction()
    {
        return new ViewModel();
    }

    public function getAction()
    {
        return new ViewModel();
    }

    public function singleRecordAction()
    {
    	$retour = Array();
    	$iso = $this->params('iso3166');

    	$request = new \Zend\Http\PhpEnvironment\Request();
    	$methode = $request->getServer('REQUEST_METHOD');
    	
    	if (isset($iso))
    	{
    		$retour["search"] = $iso;
    		
    		$sm = $this->getServiceLocator();
    		$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
    		$resultSetPrototype = new \Zend\Db\ResultSet\ResultSet;
    		$resultSetPrototype->setArrayObjectPrototype(new Country);
    		$tableGateWay = new TableGateway('country', $dbAdapter, null, $resultSetPrototype);
    		
    		$countryTable = new CountryTable($tableGateWay);
    		
    		switch ($methode)
    		{
    		    case "GET":
            		$country = $countryTable->getCountryWithSearch($iso);
            		if (isset($country))
            		{
            	       	$retour[] = $country->toArray();
            		} else {
            			$retour["error"] = "Pas de resultat";
            		}
            	break;
            	
    		    case "DELETE":
            		$country = $countryTable->getCountryWithSearch($iso);
            		if (isset($country))
            		{
            	       	$countryTable->deleteCountryWithSearch($iso);
            	       	$retour["success"] = "Suppression reussie";            	       	
            		} else {
            			$retour["error"] = "Pays non trouvé";
            		}
            	break;
            	
    		    default :
    		        $retour["error"] = "405 : Forbidden method";     		    	
    		    break;
    		}
    		
    	} else {
    	    $retour["error"] = "Pas d'iso3166 specifie";
    	}
    	
    	return  new JsonModel($retour);
    }


}

