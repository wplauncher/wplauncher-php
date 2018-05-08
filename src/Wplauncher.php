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
     * @return string The name of the class, with namespacing and underscores
     *    stripped.
     */
    public static function className()
    {
        $class = get_called_class();
        // Useful for namespaces: Foo\Instance
        if ($postfixNamespaces = strrchr($class, '\\')) {
            $class = substr($postfixNamespaces, 1);
        }
        if (substr($class, 0, strlen('Wplauncher')) == 'Wplauncher') {
            $class = substr($class, strlen('Wplauncher'));
        }
        $class = str_replace('_', '', $class);
        $name = urlencode($class);
        $name = strtolower(preg_replace('%([a-z])([A-Z])%', '\1-\2', $name));
        return $name;
    }

    /**
     * @return string The endpoint URL for the given class.
     */
    public static function classUrl()
    {
        $base = static::className();
		if($base == 'connect-stripe'){
			return "$base";
		} else {
			return "${base}s";
		}
        
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
        $object_url = self::classUrl();
		$response = self::$client->post($object_url, ['form_params' => $params]);
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
        $object_url = self::classUrl();
		$response = self::$client->get($object_url . '/' . $id);
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
		$object_url = self::classUrl();
		//PUT v PATCH - https://stackoverflow.com/questions/28459418/rest-api-put-vs-patch-with-real-life-examples
        $response = self::$client->patch($object_url . '/' . $id, ['form_params' => $params]);
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
		$object_url = self::classUrl();
        $response = self::$client->delete($object_url, ['query' => [$params]]);
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
		$object_url = self::classUrl();
        $response = self::$client->get($object_url, ['query' => [$params]]);
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
