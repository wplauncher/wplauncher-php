<?php

namespace Wplauncher;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class Wplauncher
{
    
    /**
     * @var client
     */
    public static $client;
    
    /**
     * @var object_url
     * endpoint for each object
     */
    public static $object_url;
    
    /**
     * Create a new WPLauncher Instance
     */
    public static function setApiKey($access_token)
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
        self::$client = $wplauncher_guzzle;
    }
    /**
     * Creates a new Object
     *
     * @param array $params
     * @param array $opts
     *
     * @return mixed
     */
    public static function _create($params = null, $opts = null)
    {
        $response = self::$client->post(self::$object_url, ['body' => json_encode($params)]);
        self::checkResponseStatusCode($response, 201);
        return json_decode($response->getBody());
    }
    /**
     * Returns a specific object
     *
     * @param int $id
     * @param array $opts
     *
     * @return mixed
     */
    public static function _retrieve($id, $opts = null)
    {
        $response = self::$client->get(self::$object_url . '/' . $id);
        self::checkResponseStatusCode($response, 200);
        return json_decode($response->getBody(), true);
    }
    /**
     * Updates an object
     *
     * @param int $id
     * @param array $params
     * @param array $opts
     * @return mixed
     */
    public static function _update($id, $params = null, $opts = null)
    {
        if (!is_numeric($id)) {
            throw new \InvalidArgumentException('The object id must be numeric.');
        }
        if (!is_array($params)) {
            throw new \InvalidArgumentException('Params must be an array.');
        }
        $response = self::$client->patch(self::$object_url . '/' . $id, ['body' => json_encode($params)]);
        self::checkResponseStatusCode($response, 200);
        return json_decode($response->getBody());
    }
    /**
     * Delete the provided object
     *
     * @param int $id
     * @param array $params
     * @param array $opts
     *
     * @return array()
     */
    public static function _delete($id, $params = null, $opts = null)
    {
        if (isset($id) && !is_numeric($id)) {
            throw new \InvalidArgumentException('The object id must be numeric.');
        }
        $response = self::$client->delete(self::$object_url, ['query' => [$params]]);
        self::checkResponseStatusCode($response, 200);
        return json_decode($response->getBody());
    }
    /**
     * Return all the objects of a given affiliate's user
     *
     * @param array $params
     * @param array $opts
     *
     * @return array()
     */
    public static function _all($params = null, $opts = null)
    {
        // user_id doesn't need to be set but if it is then it has to be numeric
        if (isset($params['user_id']) && !is_numeric($params['user_id'])) {
            throw new \InvalidArgumentException('The user id must be numeric.');
        }
        $response = self::$client->get(self::$object_url, ['query' => [$params]]);
        self::checkResponseStatusCode($response, 200);
        return json_decode($response->getBody());
    }
    /**
     * Check the response status code.
     *
     * @param ResponseInterface $response
     * @param int $expectedStatusCode
     *
     * @throws \RuntimeException on unexpected status code
     */
    public static function checkResponseStatusCode(ResponseInterface $response, $expectedStatusCode)
    {
        $statusCode = $response->getStatusCode();
        if ($statusCode !== $expectedStatusCode) {
            throw new \RuntimeException('WPLauncher API returned status code ' . $statusCode . ' expected ' . $expectedStatusCode);
        }
    }
}
