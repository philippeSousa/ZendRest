<?php

namespace Restapi\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Db\TableGateway\TableGateway;
use Restapi\Model\Country;
use Restapi\Model\CountryTable;
use Restapi\Form;

class ApiController extends AbstractActionController
{

    public function indexAction()
    {
    	
    	$retour = Array();
    	 
    	$request = new \Zend\Http\PhpEnvironment\Request();
    	$methode = $request->getServer('REQUEST_METHOD');
    	//echo ">>";var_dump($request->getContent());echo "<<";
    	//$postRequest = new Request();
    	
    	// accept : $this->getRequest()
    	
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
    		$sm = $this->getServiceLocator();
    		$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
    		$resultSetPrototype = new \Zend\Db\ResultSet\ResultSet;
    		$resultSetPrototype->setArrayObjectPrototype(new Country);
    		$tableGateWay = new TableGateway('country', $dbAdapter, null, $resultSetPrototype);
    		
    		$countryTable = new CountryTable($tableGateWay);
    		
    		$postContent = $request->getContent();
    		if (trim($postContent))
    		{
        		//$retour["content"] = json_decode($postContent);
        		
        		$formReceivedData = new Form\Register;
        		$formReceivedData->setData(json_decode($postContent,true));
        		//$retour["insert"] = json_decode($postContent,true);
        		if ($formReceivedData->isValid())
        		{
        			$newCountry = new Country();
        			$newCountry->exchangeArray(json_decode($postContent,true));
        			$countryTable->saveCountry($newCountry);
        			
        			$retour["success"] = "Donnees valides";
        		} else {
        			$retour["error"] = "Donnees recues non valides";
        		}
        		
        		
        		
    		} else {
    			$retour["error"] = "Pas de donnees recues";
    		}

    		
    		//$retour["method"] = "POST";
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
            	
    		    case "PATCH":
            		$country = $countryTable->getCountryWithSearch($iso);
            		if (isset($country))
            		{
            			$postContent = $request->getContent();
            			if (trim($postContent))
            			{
            			    //$retour["content"] = json_decode($postContent);
            			
            			    $formReceivedData = new Form\Register;
            			    $formReceivedData->setData(json_decode($postContent,true));
            			    //$retour["insert"] = json_decode($postContent,true);
            			    if ($formReceivedData->isValid())
            			    {
            			        $newCountry = new Country();
            			        $newCountry->exchangeArray(json_decode($postContent,true));
            			        $countryTable->saveCountry($newCountry);
            			         
            			        $retour["success"] = "Donnees valides";
            			    } else {
            			        $retour["error"] = "Donnees recues non valides";
            			    }
            			
            			
            			
            			} else {
            			    $retour["error"] = "Pas de donnees recues";
            			}

            			
            			
            		} else {
            			$retour["error"] = "Pays non trouve";
            		}
            	break;
            	
    		    case "DELETE":
            		$country = $countryTable->getCountryWithSearch($iso);
            		if (isset($country))
            		{
            	       	$countryTable->deleteCountryWithSearch($iso);
            	       	$retour["success"] = "Suppression reussie";            	       	
            		} else {
            			$retour["error"] = "Pays non trouve";
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

