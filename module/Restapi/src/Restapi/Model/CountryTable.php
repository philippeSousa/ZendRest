<?php
namespace Restapi\Model;

use Zend\Db\TableGateway\TableGateway;
use \Zend\Db\Sql\Select;
use \Zend\Db\Sql\Where;

class CountryTable
{
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway)
	{
	    $this->tableGateway = $tableGateway;		
	}
	
	public function getCountry($id)
	{
		$rowset = $this->tableGateway->select(array('id' => $id));
		$row = $rowset->current();
		
		if (!$row){
			throw new \Exception("Could not find row $id");
		}
		
		return $row;
	}
	
	public function getCountryWithSearch($search)
	{
		
		$where = new Where();
		$where->equalTo( 'code', $search );
		$where->OR->equalTo( 'alpha2', $search );
		$where->OR->equalTo( 'alpha3', $search );
		
		$rowset = $this->tableGateway->select(function ($select)
		use ($where){
		    $select->where($where);
		});
		
		$row = $rowset->current();
		
		if (!$row){
		   return null;
		}
		
		return $row;
	}
	
	public function deleteCountryWithSearch($search)
	{
		
		$where = new Where();
		$where->equalTo( 'code', $search );
		$where->OR->equalTo( 'alpha2', $search );
		$where->OR->equalTo( 'alpha3', $search );
		
		$rowset = $this->tableGateway->delete(function ($delete)
		use ($where){
		    $delete->where($where);
		});
	}
	
	public function saveCountry(Country $country)
	{
		
		$data = [
				    'alpha2'  => $country->getAlpha2(),
				    'alpha3'  => $country->getAlpha3(),
				    'code'  => $country->getCode(),
				    'devise'  => $country->getDevise(),
				    'nom_en_gb'  => $country->getNom_en_gb(),
				    'nom_fr_fr'  => $country->getNom_fr_fr(),
				    'txTva'  => $country->getTxTva()
		];
		
		$id = $country->getId();
		
		if ($id == 0){
		    $this->tableGateway->insert($data);
		} else {
			if ($this->getCountry($id)){
				$this->tableGateway->update($data, array('id' => $id));
			}
			 else {
			    throw new \Exception(" The country id has not been found dude");			 	
			 }
		}

	}
	
	public function deleteCountry($id)
	{

		if ($this->getCountry($id)){
			$this->tableGateway->delete(array('id' => $id));
		}
		 else {
		    throw new \Exception(" The country id has not been found dude");			 	
		 }
		

	}
	
	public function fetchAll()
	{
		$sql = $this->tableGateway->getSql();
		$select = $sql->select();
		$select->limit(30)
		        ->order(array('alpha2'));
		
		return $this->tableGateway->selectWith($select);
	}
	
	public function fetchAllToArray()
	{
		$result = Array();
		$allCountries = $this->fetchAll();
		
		foreach($allCountries as $country)
		{
			$result[] = $country->toArray();
		}
		
		return $result;
	}
	
}

?>