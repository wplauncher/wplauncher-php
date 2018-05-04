<?php

namespace Wplauncher;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Wplauncher\WplauncherClient;

class Plan extends WplauncherClient
{
	/**
	 * Creates a new Plan
	 *=
	 * @param array $plan
	 *
	 * @return mixed
	 */
	public static function create($plan = []) {
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
		
		$response = self::$client->post('plan', ['body' => json_encode($plan)]);
	    self::checkResponseStatusCode($response, 201);
	    return json_decode($response->getBody());
	}
	/**
	 * Returns a specific plan
	 *
	 * @param int $id
	 *
	 * @return mixed
	 */
	public static function retrieve($id) {
	    if (!is_numeric($id)) {
	        throw new \InvalidArgumentException('The plan id must be numeric.');
	    }
	    $response = self::$client->get('plans/' . $id);
	    self::checkResponseStatusCode($response, 200);
	    return json_decode($response->getBody(), true);
	}
 	/**
 	 * Updates a plan
 	 *
 	 * @param int $plan_id
 	 * @param array $plan
 	 * @return mixed
 	 */
 	public static function update($plan) {
 	    if (!is_numeric($plan['id'])) {
 	        throw new \InvalidArgumentException('The plan id must be numeric.');
 	    } 
 		if (!is_array($plan)) {
 	        throw new \InvalidArgumentException('The plan must be an array.');
 	    }
 	    $response = self::$client->patch('plans/' . $plan['id'], ['body' => json_encode($plan)]);
 	    self::checkResponseStatusCode($response, 200);
 	    return json_decode($response->getBody());
 	}
	 /**
	 * Delete the provided instance
	 *
	 * @param array $instance
	 *
	 * @return array()
	 */
	 public static function delete($plan) {
		 if (isset($plan['id']) && !is_numeric($plan['id'])) {
	         throw new \InvalidArgumentException('The plan id must be numeric.');
	     }
	     $response = self::$client->delete('plans', ['query' => [$instance]]);
	     self::checkResponseStatusCode($response, 200);
	     return json_decode($response->getBody());
	 }
 	/**
 	 * Return all the plans of a given user
 	 *
 	 * @param array $conditions
 	 *
 	 * @return array()
 	 */
 	public static function all($conditions) {
 	    // user_id doesn't need to be set but if it is then it has to be numeric
 		 if (isset($conditions['user_id']) && !is_numeric($conditions['user_id'])) {
 	        throw new \InvalidArgumentException('The user id must be numeric.');
 	    }
     	 $response = self::$client->get('plans', ['query' => [$conditions]]);
 	     self::checkResponseStatusCode($response, 200);
 	     return json_decode($response->getBody());
 	 }
	
}
