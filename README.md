# Plivo Library for Lithium
Plivo is a cloud telephony service. Learn more at http://plivo.com.

## Features
 - Data source for http api

## Methods
 - getAccount: http://plivo.com/docs/api/account/#detail
 - getNumbers: http://plivo.com/docs/api/numbers/number/#number_list
 - getAvailableNumbers: http://plivo.com/docs/api/numbers/availablenumbergroup/#number_search
 - registerNumber: http://plivo.com/docs/api/numbers/availablenumbergroup/#rent_number
 - deleteNumber: http://plivo.com/docs/api/numbers/number/#number_unrent
 - makeCall: http://plivo.com/docs/api/call/#outbound
 - getCalls: http://plivo.com/docs/api/call/#detail
 - sendSms: http://plivo.com/docs/api/message/#message

## Usage
	Connections::add('plivo', array(
		'type' => 'Plivo',
		'login' => 'foo',
		'password' => 'bar',
		'urls' => array('voice' => 'http://localhost'),
	));
	$plivo = Connections::get('plivo')
	$result = $plivo->getAccount();

## Tests
	cd li3_plivo
	li3 test tests

## Todo
 - Add Models
 - Add Helpers