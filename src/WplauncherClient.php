<?php

namespace Wplauncher;

use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

class WplauncherClient
{
    /**
     * Create a new WPLauncher Instance
     */
    public function __construct(ClientInterface $client)
    {
		$this->client = $client;
    }
	
	/**
	 * Check the response status code.
	 *
	 * @param ResponseInterface $response
	 * @param int $expectedStatusCode
	 *
	 * @throws \RuntimeException on unexpected status code
	 */
	private function checkResponseStatusCode(ResponseInterface $response, $expectedStatusCode)
	{
	    $statusCode = $response->getStatusCode();
	    if ($statusCode !== $expectedStatusCode) {
	        throw new \RuntimeException('WPLauncher API returned status code ' . $statusCode . ' expected ' . $expectedStatusCode);
	    }
	}
	
	/**
	 * Returns all the plans
	 *
	 * @return array
	 */
	public function getPlans() {
	    $response = $this->client->get('plans');
	    $this->checkResponseStatusCode($response, 200);
	    return json_decode($response->getBody(), true);
	}
	/**
	 * Returns a specific plan
	 *
	 * @param int $id
	 *
	 * @return mixed
	 */
	public function getPlan($id) {
	    if (!is_numeric($id)) {
	        throw new \InvalidArgumentException('The plan id must be numeric.');
	    }
	    $response = $this->client->get('plans/' . $id);
	    $this->checkResponseStatusCode($response, 200);
	    return json_decode($response->getBody(), true);
	}
	/**
	 * Return all the tasks of a given list
	 *
	 * @param int $list_id
	 *
	 * @return array()
	 */
	public function getListTasks($list_id) {
	    if (!is_numeric($list_id)) {
	        throw new \InvalidArgumentException('The list id must be numeric.');
	    }
	    $response = $this->client->get('tasks', ['query' => ['list_id' => $list_id]]);
	    $this->checkResponseStatusCode($response, 200);
	    return json_decode($response->getBody());
	}
	/**
	 * Creates a new Instance
	 *
	 * @param array $instance
	 *
	 * @return mixed
	 */
	public function createInstance($instance = []) {
	    /*if (!is_numeric($instance)) {
	        throw new \InvalidArgumentException('The instance id must be numeric.');
	    }*/
	    $response = $this->client->post('instances', ['body' => json_encode($instance)]);
	    $this->checkResponseStatusCode($response, 201);
	    return json_decode($response->getBody());
	}
	/**
	 * Creates a new Plan
	 *=
	 * @param array $plan
	 *
	 * @return mixed
	 */
	public function createPlan($plan = []) {
	    $response = $this->client->post('plan', ['body' => json_encode($plan)]);
	    $this->checkResponseStatusCode($response, 201);
	    return json_decode($response->getBody());
	}
	/**
	 * Completes a task
	 *
	 * @param int $task_id
	 * @param int $revision
	 * @return mixed
	 */
	public function completeTask($task_id, $revision) {
	    if (!is_numeric($task_id)) {
	        throw new \InvalidArgumentException('The list id must be numeric.');
	    } elseif (!is_numeric($revision)) {
	        throw new \InvalidArgumentException('The revision must be numeric.');
	    }
	    $response = $this->client->patch('tasks/' . $task_id, ['body' => json_encode(['revision' => (int) $revision, 'completed' => true])]);
	    $this->checkResponseStatusCode($response, 200);
	    return json_decode($response->getBody());
	}
	
}
