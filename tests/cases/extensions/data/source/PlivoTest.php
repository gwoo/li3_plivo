<?php

namespace li3_plivo\tests\cases\extensions\data\source;

use lithium\data\Connections;

class PlivoTest extends \lithium\test\Integration {

	public $plivo = null;

	public $config = array();

	public $result = array();

	public function skip() {
		$isAvailable = (
			Connections::get('test-plivo', array('config' => true)) &&
			Connections::get('test-plivo')->isConnected(array('autoConnect' => true))
		);
		$this->skipIf(!$isAvailable, "No test-plivo connection available.");
	}

	public function setUp() {
		$this->plivo = Connections::get('test-plivo');
		$this->config = $this->plivo->config();
		$this->login = $this->config['login'];
	}

	public function testSetup() {
		$this->assertTrue($this->plivo->methods());
		$this->assertEqual('api.plivo.com', $this->config['host']);
		$this->assertEqual('/v1/Account/' . $this->login, $this->config['path']);
	}

	public function testConnection() {
		$this->assertTrue($this->plivo->isConnected());
	}

	public function testGetAccounts() {
		$result = $this->plivo->getAccount();
		$this->assertTrue($result['enabled']);
		//var_dump($result, (string) $this->plivo->last->request);
	}

	public function testGetAvailableNumbersTollFree() {
		$this->result = $this->plivo->getAvailableNumbers(array(
			'limit' => 1,
			'number_type' => 'tollfree',
			'country_code' => 1,
			'country_iso' => 'US'
		));
		$this->assertTrue($this->result);
		$expected = "United States";
		$this->assertEqual($expected, $this->result['objects'][0]['region']);
	}

	public function testRegisterNumber() {
		$result = (object) $this->result;

 		if ($result->objects) {
			$result = $this->plivo->registerNumber($result->objects[0]);
			$this->assertTrue($result);
			//var_dump($result, (string) $this->plivo->last->request);
		}
	}

	public function testDeleteNumber() {
		$result = (object) $this->result;

 		if ($result->objects) {
			$result = $this->plivo->deleteNumber(array('number' => '18556607893'));
			$this->assertTrue($result);
			//var_dump((string) $this->plivo->last->request, (string) $this->plivo->last->response);
		}
	}

	public function testCalls() {
		$result = $this->plivo->getCalls(array('To' => "14155992671"));
		$this->assertTrue($result);
		//var_dump($result, (string) $this->plivo->last->request);
	}

	public function testMakeCall() {
		$result = $this->plivo->makeCall(array(
			'to' => "13108046531",
			'from' => "13108046531",
			'answer_url' => $this->config['urls']['voice']
		));
		$this->assertTrue($result);
		//var_dump($result, (string) $this->plivo->last->request);
	}
}