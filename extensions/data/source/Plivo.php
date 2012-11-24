<?php

namespace li3_plivo\extensions\data\source;

use lithium\util\String;

class Plivo extends \lithium\data\source\Http {

	private $_version = 'v1';

	protected $_methods = array(
		'getAccount' => array(
			'method' => 'get',
			'path' => "/"
		),
		'getNumbers' => array(
			'method' => 'get',
			'path' => "/Number/"
		),
		'getAvailableNumbers' => array(
			'method' => 'get',
			'path' => "/AvailableNumber/"
		),
		'registerNumber' => array(
			'method' => 'post',
			'path' =>"/AvailableNumber/{:number}/"
		),
		'deleteNumber' => array(
			'method' => 'delete',
			'path' =>"/Number/{:number}/"
		),
		'makeCall' => array(
			'method' => 'post',
			'path' => "/Call/"
		),
		'getCalls' => array(
			'method' => 'get',
			'path' => "/Call/"
		),
		'sendSms' => array(
			'method' => 'post',
			'path' =>"/Message/"
		)
	);

	protected $_classes = array(
		'service' => 'lithium\net\http\Service',
		'entity'   => 'lithium\data\entity\Document',
		'set'      => 'lithium\data\collection\DocumentSet',
		'relationship' => 'lithium\data\model\Relationship'
	);

	public function __construct(array $config = array()) {
		$defaults = array(
			'scheme'     => 'https',
			'host'       => 'api.plivo.com',
			'port'       => '',
			'auth'       => 'Basic',
			'login'      => '',
			'password'   => '',
			'encoding'   => 'UTF-8'
		);
		$config += $defaults;
		$config['path'] = "/{$this->_version}/Account/{$config['login']}";
		parent::__construct($config);
	}

	public function send($query = null, array $options = array()) {
		$options += array('type' => 'json');
		return parent::send($query, $options);
	}

	public function config() {
		return $this->_config;
	}
}
