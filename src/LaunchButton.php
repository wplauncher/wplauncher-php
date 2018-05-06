<?php

namespace Wplauncher;

use Wplauncher\Wplauncher;

class LaunchButton extends Wplauncher
{
	
	/**
	 * Creates a new Launch Button
	 *=
	 * @param array $launch_button
	 *
	 * @return mixed
	 */
	public static function create($launch_button = []) {
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
		
		$response = self::$client->post('launch-button', ['body' => json_encode($launch_button)]);
	    self::checkResponseStatusCode($response, 201);
	    return json_decode($response->getBody());
	}
	/**
	 * Returns a specific launch button
	 *
	 * @param int $id
	 *
	 * @return mixed
	 */
	public static function retrieve($id) {
	    if (!is_numeric($id)) {
	        throw new \InvalidArgumentException('The launch button id must be numeric.');
	    }
	    $response = self::$client->get('launch-buttons/' . $id);
	    self::checkResponseStatusCode($response, 200);
	    return json_decode($response->getBody(), true);
	}
	/**
	 * Updates a launch button
	 *
	 * @param array $launch_button
	 * @return mixed
	 */
	public static function update($launch_button) {
	    if (!is_numeric($launch_button['id'])) {
	        throw new \InvalidArgumentException('The launch button id must be numeric.');
	    } 
		if (!is_array($launch_button)) {
	        throw new \InvalidArgumentException('The launch button must be an array.');
	    }
	    $response = self::$client->patch('launch-buttons/' . $launch_button['id'], ['body' => json_encode($launch_button)]);
	    self::checkResponseStatusCode($response, 200);
	    return json_decode($response->getBody());
	}
	/**
	 * Delete the provided launch button
	 *
	 * @param array $launch_button
	 *
	 * @return array()
	 */
	 public static function delete($launch_button) {
		 if (isset($launch_button['id']) && !is_numeric($launch_button['id'])) {
	         throw new \InvalidArgumentException('The launch button id must be numeric.');
	     }
	     $response = self::$client->delete('launch-buttons', ['query' => [$launch_button]]);
	     self::checkResponseStatusCode($response, 200);
	     return json_decode($response->getBody());
	 }
	/**
	 * Return all the launch buttons of a given affiliate's user
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
	     $response = self::$client->get('launch-buttons', ['query' => [$conditions]]);
	     self::checkResponseStatusCode($response, 200);
	     return json_decode($response->getBody());
	 }
	
}
