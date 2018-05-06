<?php

namespace Wplauncher;

use Wplauncher\Wplauncher;

class StripeConnect extends Wplauncher
{
	
	/**
	 * Returns Stripe Connect Status
	 *
	 * @return array
	 */
	public static function retrieve() {
	    $response = self::$client->get('connect/stripe');
	    self::checkResponseStatusCode($response, 200);
	    return json_decode($response->getBody(), true);
	}
	/**
	 * May not need stripe callback because it's easier to just throw stripe directly to the api.wplauncher.com/v1/connect/stripe-callback 
    */
	
}
