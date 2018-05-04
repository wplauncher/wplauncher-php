<?php

namespace Wplauncher;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class StripeConnect extends WplauncherClient
{
	
	/**
	 * Returns Stripe Connect Status
	 *
	 * @return array
	 */
	public function getStatus() {
	    $response = $this->client->get('connect/stripe');
	    $this->checkResponseStatusCode($response, 200);
	    return json_decode($response->getBody(), true);
	}
	/**
	 * May not need this because it's easier to just throw stripe directly to the api.wplauncher.com/v1/connect/stripe-callback 
	 * Returns Stripe Connect information after connecting the user to the WPLauncher Stripe Account
	 *
	 * @param array $request
	 *
	 * @return mixed
	 *
	public function getCallback($request) {
		/*
            'state' => 'required|exists:users,stripe_connect_state|string',
			'scope' => 'required|string',
			'code' => 'required|string',
		*
		
	    if (!is_array($request)) {
	        throw new \InvalidArgumentException('The request var must be an array.');
	    }
	    $response = $this->client->get('connect/stripe-callback' . $request);
	    $this->checkResponseStatusCode($response, 200);
	    return json_decode($response->getBody(), true);
	}
	*/
	
}
