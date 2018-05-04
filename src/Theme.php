<?php

namespace Wplauncher;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Wplauncher\WplauncherClient;

class Theme extends WplauncherClient
{
	
	/**
	 * Returns all the instances
	 *
	 * @return array
	 */
	public function all() {
	    $response = $this->client->get('instances');
	    $this->checkResponseStatusCode($response, 200);
	    return json_decode($response->getBody(), true);
	}
	/**
	 * Returns a specific instance
	 *
	 * @param int $id
	 *
	 * @return mixed
	 */
	public function get($id) {
	    if (!is_numeric($id)) {
	        throw new \InvalidArgumentException('The instance id must be numeric.');
	    }
	    $response = $this->client->get('instances/' . $id);
	    $this->checkResponseStatusCode($response, 200);
	    return json_decode($response->getBody(), true);
	}
	/**
	 * Creates a new Instance
	 *=
	 * @param array $instance
	 *
	 * @return mixed
	 */
	public function create($instance = []) {
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
		
		$response = $this->client->post('instance', ['body' => json_encode($instance)]);
	    $this->checkResponseStatusCode($response, 201);
	    return json_decode($response->getBody());
	}
	/**
	 * Return all the instances of a given user
	 *
	 * @param int $user_id
	 *
	 * @return array()
	 */
	public function all($conditions) {
	    // user_id doesn't need to be set but if it is then it has to be numeric
		 if (isset($conditions['user_id']) && !is_numeric($conditions['user_id'])) {
	        throw new \InvalidArgumentException('The user id must be numeric.');
	    }
    	 $response = $this->client->get('themes', ['query' => [$conditions]]);
	     $this->checkResponseStatusCode($response, 200);
	     return json_decode($response->getBody());
	 }
	 
	/**
	 * Updates a instance
	 *
	 * @param array $instance
	 * @return mixed
	 */
	public function update($instance) {
	    if (!is_numeric($instance['id'])) {
	        throw new \InvalidArgumentException('The instance id must be numeric.');
	    } 
		if (!is_array($instance)) {
	        throw new \InvalidArgumentException('The instance must be an array.');
	    }
	    $response = $this->client->patch('instances/' . $instance['id'], ['body' => json_encode($instance)]);
	    $this->checkResponseStatusCode($response, 200);
	    return json_decode($response->getBody());
	}
	
}
