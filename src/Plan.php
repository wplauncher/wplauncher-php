<?php

namespace Wplauncher;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Wplauncher\WplauncherClient;

class Plan extends WplauncherClient
{
	/**
	 * Returns a specific plan
	 *
	 * @param int $id
	 *
	 * @return mixed
	 */
	public function get($id) {
	    if (!is_numeric($id)) {
	        throw new \InvalidArgumentException('The plan id must be numeric.');
	    }
	    $response = $this->client->get('plans/' . $id);
	    $this->checkResponseStatusCode($response, 200);
	    return json_decode($response->getBody(), true);
	}
	/**
	 * Creates a new Plan
	 *=
	 * @param array $plan
	 *
	 * @return mixed
	 */
	public function create($plan = []) {
		/*
		    'name' => 'required|string',
			'instance_type_id' => 'required|exists:instance_types,id|integer',
			'price' => 'bail|required|integer',
			'interval' => 'bail|required|exists:intervals,name|string',
			'interval_count' => 'bail|required|integer',
			'currency' => 'bail|required|string',
			'trial_period_days' => 'integer',
			'environment' => 'string'
		*
		if (!is_numeric($user_id)) {
     	    throw new \InvalidArgumentException('The user id must be numeric.');
     	}*/
		
		$response = $this->client->post('plan', ['body' => json_encode($plan)]);
	    $this->checkResponseStatusCode($response, 201);
	    return json_decode($response->getBody());
	}
	/**
	 * Return all the plans of a given user
	 *
	 * @param array $conditions
	 *
	 * @return array()
	 */
	public function all($conditions) {
	    // user_id doesn't need to be set but if it is then it has to be numeric
		 if (isset($conditions['user_id']) && !is_numeric($conditions['user_id'])) {
	        throw new \InvalidArgumentException('The user id must be numeric.');
	    }
    	 $response = $this->client->get('plans', ['query' => [$conditions]]);
	     $this->checkResponseStatusCode($response, 200);
	     return json_decode($response->getBody());
	 }
	 
	/**
	 * Updates a plan
	 *
	 * @param int $plan_id
	 * @param array $plan
	 * @return mixed
	 */
	public function update($plan) {
	    if (!is_numeric($plan['id'])) {
	        throw new \InvalidArgumentException('The plan id must be numeric.');
	    } 
		if (!is_array($plan)) {
	        throw new \InvalidArgumentException('The plan must be an array.');
	    }
	    $response = $this->client->patch('plans/' . $plan['id'], ['body' => json_encode($plan)]);
	    $this->checkResponseStatusCode($response, 200);
	    return json_decode($response->getBody());
	}
	
}
