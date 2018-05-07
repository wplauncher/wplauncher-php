<?php

namespace Wplauncher;

use Wplauncher\Wplauncher;

class ConnectStripe extends Wplauncher
{
	
    /**
     * Returns a specific object
     *
     * @param int $id
     * @param array $opts
     *
     * @return mixed
     */
    public static function retrieve($id = null, $opts = null)
    {
		if(!$id){
        	$id = '';
        }
		return self::_retrieve($id, $opts);
    }
    /**
     * May not need stripe callback because it's easier to just throw stripe directly to the api.wplauncher.com/v1/connect/stripe-callback
    */
}
