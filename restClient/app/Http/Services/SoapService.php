<?php

namespace App\Http\Services;

use \SoapClient;

final class SoapService {

	public static function handler()
	{
		return new SoapClient(null, array('uri' => 'http://localhost/',
           'location' => 'http://localhost/api/register-client'));
	}
}