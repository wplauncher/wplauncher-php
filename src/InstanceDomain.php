<?php

namespace Wplauncher;

use Wplauncher\Wplauncher;

/**
 * Class Sftp
 *
 * @property string $sftp_user
 * @property string $password
 * @property array $instance_id
 *
 * @package Wplauncher
 */

class InstanceDomain extends Wplauncher
{
	
    /**
     * Creates a new Object
     *
     * @param array $params
     * @param array $opts
     *
     * @return mixed
     */
    public static function create($params = null, $opts = null)
    {
        /*
		if (!is_numeric($user_id)) {
     	    throw new \InvalidArgumentException('The user id must be numeric.');
     	}*/
        
        return self::_create($params, $opts);
    }
    /**
     * Returns a specific object
     *
     * @param int $id
     * @param array $opts
     *
     * @return mixed
     */
    public static function retrieve($id, $opts = null)
    {
        /*
        if (!is_numeric($id)) {
            throw new \InvalidArgumentException('The launch button id must be numeric.');
        }
		*/
        return self::_retrieve($id, $opts);
    }
    /**
     * Updates an object
     *
     * @param int $id
     * @param array $params
     * @param array $opts
     * @return mixed
     */
    public static function update($id, $params = null, $opts = null)
    {
        /*
        if (!is_numeric($params['id'])) {
            throw new \InvalidArgumentException('The launch button id must be numeric.');
        }
        if (!is_array($params)) {
            throw new \InvalidArgumentException('Params must be an array.');
        }
		*/
        return self::_update($id, $params, $opts);
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
    public static function delete($id, $params = null, $opts = null)
    {
        /*
		if (isset($params['id']) && !is_numeric($params['id'])) {
            throw new \InvalidArgumentException('The launch button id must be numeric.');
        }
		*/
        return self::_delete($id, $params, $opts);
    }
    /**
     * Return all the objects of a given affiliate's user
     *
     * @param array $params
     * @param array $opts
     *
     * @return array()
     */
    public static function all($params = null, $opts = null)
    {
        /*
		// user_id doesn't need to be set but if it is then it has to be numeric
        if (isset($params['user_id']) && !is_numeric($params['user_id'])) {
            throw new \InvalidArgumentException('The user id must be numeric.');
        }
		*/
        return self::_all($params, $opts);
    }
}
