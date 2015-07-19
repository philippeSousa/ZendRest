<?php

namespace Restapi\Form;

use Zend\Form\Form;
use Zend\Validator;

class Register extends Form
{
	public function __construct($name = null)
	{
		parent::__construct('Register');
		
		/*
		 * configuration du formulaire
		 * */
		$this->setAttribute('method', 'post');
		$this->setAttribute('enctype', 'multipart/form-data');
		
		$this->add([
			'name' => 'alpha2',
			'attributes' =>	[
					'type' => 'text',
					'required' => 'required'
			],
			'options' => [
					'label' => 'Alpha 2 '
			]
		]);
		
		$this->getInputFilter()->add([
			'name' => 'alpha2',
			'filters' => [
				['name' => 'StringTrim'],
				['name' => 'StripTags'],
			],
			'validators' => [
				[
					'name' => 'StringLength',
					'options' => [
						'min' => 2,
						'max' => 2
					]
				]
			]
		]);
		
		$this->add([
			'name' => 'alpha3',
			'attributes' =>	[
					'type' => 'text',
					'required' => 'required'
			],
			'options' => [
					'label' => 'Alpha 3 '
			]
		]);
		
		$this->getInputFilter()->add([
			'name' => 'alpha3',
			'filters' => [
				['name' => 'StringTrim'],
				['name' => 'StripTags'],
			],
			'validators' => [
				[
					'name' => 'StringLength',
					'options' => [
						'min' => 3,
						'max' => 3
					]
				]
			]
		]);
		
		$this->add([
			'name' => 'code',
			'attributes' =>	[
					'type' => 'text',
					'required' => 'required'
			],
			'options' => [
					'label' => 'Code'
			]
		]);		

		$this->getInputFilter()->add([
				'name' => 'code',
				'filters' => [
						['name' => 'StringTrim'],
						['name' => 'Int']
				]
		]);
		
		$this->add([
			'name' => 'txTva',
			'attributes' =>	[
					'type' => 'text',
					'required' => 'required'
			],
			'options' => [
					'label' => 'Taux TVA'
			]
		]);		

		$this->getInputFilter()->add([
				'name' => 'txTva',
				'filters' => [
						['name' => 'StringTrim'],
						['name' => 'Int']
				]
		]);
		

		$this->add([
		    'name' => 'devise',
		    'attributes' =>	[
		        'type' => 'text',
		        'required' => 'required'
		    ],
		    'options' => [
		        'label' => 'Devise '
		    ]
		]);
		
		$this->getInputFilter()->add([
		    'name' => 'devise',
		    'filters' => [
		        ['name' => 'StringTrim'],
		        ['name' => 'StripTags'],
		    ]
		]);

		$this->add([
		    'name' => 'nom_en_gb',
		    'attributes' =>	[
		        'type' => 'text',
		        'required' => 'required'
		    ],
		    'options' => [
		        'label' => 'Nom anglais '
		    ]
		]);
		
		$this->getInputFilter()->add([
		    'name' => 'nom_en_gb',
		    'filters' => [
		        ['name' => 'StringTrim'],
		        ['name' => 'StripTags'],
		    ]
		]);
		

		$this->add([
		    'name' => 'nom_fr_fr',
		    'attributes' =>	[
		        'type' => 'text',
		        'required' => 'required'
		    ],
		    'options' => [
		        'label' => 'Nom francais '
		    ]
		]);
		
		$this->getInputFilter()->add([
		    'name' => 'nom_fr_fr',
		    'filters' => [
		        ['name' => 'StringTrim'],
		        ['name' => 'StripTags'],
		    ]
		]);
		
		
		
		$this->add([
			'name' => 'submit',
			'attributes' =>	[
					'type' => 'submit',
					'value' => 'V',
					'required' => 'required'
			],
			'options' => [
					'label' => 'Submit'
			]
		]);
		
		
	}
}

?>