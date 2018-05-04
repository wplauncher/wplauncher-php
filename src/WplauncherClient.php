<?php

namespace Wplauncher;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class WplauncherClient
{
    
	/**
	 * @var Client
	 * protected shares this with the extended classes
	 */
	protected $client;
	
    public function __construct()
    {
    }
	
    /**
     * Create a new WPLauncher Instance
     */
	public function setApiKey($access_token)
	{
		$wplauncher_guzzle = new Client(
		    [
		        'base_uri' => 'https://api.wplauncher.com/api/v1/',
		        'headers' => [
					'Content-Type' => 'application/json',
					'Authorization' => 'Bearer '.$access_token,
					'Accept' => 'application/json'
				]
		    ]
		);
		$this->client = $wplauncher_guzzle;
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
	
}
