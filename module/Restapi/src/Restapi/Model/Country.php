<?php
namespace Restapi\Model;

class Country
{
	
	protected $id;
	protected $alpha2;
	protected $alpha3;
	protected $code;
	protected $devise;
	protected $nom_en_gb;
	protected $nom_fr_fr;
	protected $txTva;
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getAlpha2()
	{
		return $this->alpha2;
	}
	
	public function getAlpha3()
	{
		return $this->alpha3;
	}
	
	public function getCode()
	{
		return $this->code;
	}
	
	public function getDevise()
	{
		return $this->devise;
	}
	
	public function getNom_en_gb()
	{
		return $this->nom_en_gb;
	}
	
	public function getNom_fr_fr()
	{
		return $this->nom_fr_fr;
	}
	
	public function getTxTva()
	{
		return $this->txTva;
	}
	
	public function setId($val)
	{
		$this->id = $val;
	}
	
	public function setAlpha2($val)
	{
		$this->alpha2 = $val;
	}
	
	public function setAlpha3($val)
	{
		$this->alpha3 = $val;
	}
	
	public function setCode($val)
	{
		$this->code = $val;
	}
	
	public function setDevise($val)
	{
		$this->devise = $val;
	}
	
	public function setNom_en_gb($val)
	{
		$this->nom_en_gb = $val;
	}
	
	public function setNom_fr_fr($val)
	{
		$this->nom_fr_fr = $val;
	}
	
	public function setTxTva($val)
	{
		$this->txTva = $val;
	}	
	
    public function exchangeArray($data)
    {
    	    $this->id = (isset($data['id']))? $data['id'] : null;
    	    $this->alpha2 =  (isset($data['alpha2']))? $data['alpha2'] : null;
    	    $this->alpha3 =  (isset($data['alpha3']))? $data['alpha3'] : null;
    	    $this->code =  (isset($data['code']))? $data['code'] : null;
    	    $this->devise =  (isset($data['devise']))? $data['devise'] : null;
    	    $this->nom_en_gb =  (isset($data['nom_en_gb']))? $data['nom_en_gb'] : null;
    	    $this->nom_fr_fr =  (isset($data['nom_fr_fr']))? $data['nom_fr_fr'] : null;
    	    $this->txTva =  (isset($data['txTva']))? $data['txTva'] : null;
    }
	
    public function toArray()
    {
    	    return Array (
    	    	"id" => $this->id,
        	    "alpha2" => $this->alpha2,
        	    "alpha3" => $this->alpha3,
        	    "code" => $this->code,
        	    "devise" => $this->devise,
        	    "nom_en_gb" => $this->nom_en_gb,
        	    "nom_fr_fr" => $this->nom_fr_fr,
        	    "txTva" => $this->txTva
    	    );
    }
	
}

?>