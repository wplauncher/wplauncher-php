<?php

namespace Wplauncher;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Wplauncher\WplauncherClient;

class Instance extends WplauncherClient
{
	
	/**
	 * Creates a new Instance
	 *=
	 * @param array $instance
	 *
	 * @return mixed
	 */
	public static function create($instance = []) {
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
		
		$response = self::$client->post('instance', ['body' => json_encode($instance)]);
	    self::checkResponseStatusCode($response, 201);
	    return json_decode($response->getBody());
	}
	/**
	 * Returns a specific instance
	 *
	 * @param int $id
	 *
	 * @return mixed
	 */
	public static function retrieve($id) {
	    if (!is_numeric($id)) {
	        throw new \InvalidArgumentException('The instance id must be numeric.');
	    }
	    $response = self::$client->get('instances/' . $id);
	    self::checkResponseStatusCode($response, 200);
	    return json_decode($response->getBody(), true);
	}
	/**
	 * Updates a instance
	 *
	 * @param array $instance
	 * @return mixed
	 */
	public static function update($instance) {
	    if (!is_numeric($instance['id'])) {
	        throw new \InvalidArgumentException('The instance id must be numeric.');
	    } 
		if (!is_array($instance)) {
	        throw new \InvalidArgumentException('The instance must be an array.');
	    }
	    $response = self::$client->patch('instances/' . $instance['id'], ['body' => json_encode($instance)]);
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
	 public static function delete($instance) {
		 if (isset($instance['id']) && !is_numeric($instance['id'])) {
	         throw new \InvalidArgumentException('The instance id must be numeric.');
	     }
	     $response = self::$client->delete('instances', ['query' => [$instance]]);
	     self::checkResponseStatusCode($response, 200);
	     return json_decode($response->getBody());
	 }
	/**
	 * Return all the instances of a given affiliate's user
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
	     $response = self::$client->get('instances', ['query' => [$conditions]]);
	     self::checkResponseStatusCode($response, 200);
	     return json_decode($response->getBody());
	 }
	
}
