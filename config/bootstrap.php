<?php
use lithium\data\Connections;

Connections::add('test-plivo', array(
	'type' => 'Plivo',
	'login' => 'foo',
	'password' => 'bar',
	'urls' => array('voice' => 'http://localhost'),
	'socket' => 'li3_plivo\tests\mocks\net\MockPlivo'
));