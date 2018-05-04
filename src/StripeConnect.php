<?php

namespace Wplauncher;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Wplauncher\WplauncherClient;

class StripeConnect extends WplauncherClient
{
	
	/**
	 * Returns Stripe Connect Status
	 *
	 * @return array
	 */
	public function get() {
	    $response = $this->client->get('connect/stripe');
	    $this->checkResponseStatusCode($response, 200);
	    return json_decode($response->getBody(), true);
	}
	/**
	 * May not need stripe callback because it's easier to just throw stripe directly to the api.wplauncher.com/v1/connect/stripe-callback 
    */
	
}
