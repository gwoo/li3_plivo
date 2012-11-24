<?php

namespace li3_plivo\tests\mocks\net;

class MockPlivo extends \lithium\tests\mocks\net\http\MockSocket {

	public function read() {
		$login = $this->data->username;
		// get account
		if (preg_match("(\\/Account\\/{$login}\\/$)", $this->data->path)) {
			return json_encode(array(
				"city" => "VENICE",
				"name" => "Zombocom",
				"cash_credits" => "1000000000.2724",
				"created" => "2012-04-20",
				"custom_message_id" => false,
				"enabled" => true,
				"modified" => "2012-04-20",
				"api_id" => "203b1e4e-35d8-11e2-9798-12313f066d53",
				"postpaid" => false,
				"state" => "CA",
				"address" => "123 Super Awesome Ave.",
				"timezone" => "America/Los_Angeles",
				"auth_id" => "{$login}",
				"resource_uri" => "/v1/Account/{$login}/"
			));
		}
		// get available numbers
		if (preg_match("(\\/AvailableNumber\\/$)", $this->data->path)) {
			return json_encode(array(
				"meta" => array(
					"previous" => NULL,
					"total_count" => 842,
					"offset" => 0,
					"limit" => 1,
					"next" => "/v1/Account/{$login}/AvailableNumber/?limit=1&number_type=tollfree&country_code=1&country_iso=US&offset=1"
				),
				"api_id" => "c780221a-35da-11e2-8733-12313f00794c",
				"objects" => array(
					array(
						"voice_enabled" => true,
						"prefix" => "855",
						"country" => "UNITED STATES",
						"region" => "United States",
						"fax_enabled" => false,
						"number" => "18556607893",
						"voice_rate" => "0.02200",
						"monthly_rental_rate" => "1.00000",
						"lata" => NULL,
						"number_type" => "tollfree",
						"sms_rate" => "0.00800",
						"resource_uri" => "/v1/Account/{$login}/AvailableNumber/18556607893/",
						"sms_enabled" => false,
						"blocked" => false
					)
				)
			));
		}
		// register number
		if (preg_match("(\\/AvailableNumber\\/\\d+/$)", $this->data->path)) {
			$this->data->states['code'] = 202;
			return json_encode(array(
				"message" => "created",
				"api_id" => "2034e064-3656-11e2-8b13-123140016ef1"
			));
		}
		// delete number
		if (preg_match("(\\/Number\\/\\d+/$)", $this->data->path)) {
			return json_encode(array(
				"message" => "deleted",
				"api_id" => "2034e064-3656-11e2-8b13-123140016ef1"
			));
		}
		// make call
		if ($this->data->method == 'POST' && preg_match("(\\/Call\\/$)", $this->data->path)) {
			return json_encode(array(
				'message' => 'call fired',
				'request_uuid' => 'a16083d2-366f-11e2-832d-00259027060c',
				'api_id' => 'a0de9c8c-366f-11e2-a1c2-12313f0460aa'
			));
		}
		// get calls
		if (preg_match("(\\/Call\\/$)", $this->data->path)) {
			return json_encode(array(
				"meta" => array(
					"previous" => NULL,
					"total_count" => 1857,
					"offset" => 0,
					"limit" => 20,
					"next" => "/v1/Account/{$login}/Calls/?To=14155992671&limit=20&offset=20"
				),
				"api_id" => "20bbda06-3656-11e2-81a0-123141040938",
				"objects" => array(
					array(
						"bill_duration" => 19,
						"total_amount" => "0.00900",
						"parent_call_uuid" => "ac086336-ba9b-11e1-ab01-318828028a07",
						"call_direction" => "outbound",
						"to_number" => "19175761363",
						"total_rate" => "0.00900",
						"from_number" => "19175761363",
						"end_time" => "2012-06-20T05:49:40",
						"call_uuid" => "aca1e858-ba9b-11e1-ab07-318828028a07",
						"resource_uri" => "/v1/Account/{$login}/Call/aca1e858-ba9b-11e1-ab07-318828028a07/",
					),
					array(
						"bill_duration" => 15,
						"total_amount" => "0.00900",
						"parent_call_uuid" => "482c55b4-ba9d-11e1-ab1d-318828028a07",
						"call_direction" => "outbound",
						"to_number" => "19175761363",
						"total_rate" => "0.00900",
						"from_number" => "14242549169",
						"end_time" => "2012-06-20T06:01:16",
						"call_uuid" => "490664c0-ba9d-11e1-ab23-318828028a07",
						"resource_uri" => "/v1/Account/{$login}/Call/490664c0-ba9d-11e1-ab23-318828028a07/",
					),
					array(
						"bill_duration" => 24,
						"total_amount" => "0.00900",
						"parent_call_uuid" => "9eea71d8-ba9d-11e1-ab25-318828028a07",
						"call_direction" => "outbound",
						"to_number" => "19175761363",
						"total_rate" => "0.00900",
						"from_number" => "14242549169",
						"end_time" => "2012-06-20T06:03:50",
						"call_uuid" => "9fc91640-ba9d-11e1-ab2b-318828028a07",
						"resource_uri" => "/v1/Account/{$login}/Call/9fc91640-ba9d-11e1-ab2b-318828028a07/",
					)
				)
			));

		}

	}
}