<?php

namespace Wplauncher;

use Wplauncher\Wplauncher;

class StripeConnect extends Wplauncher
{
    
    function __construct()
    {
        self::$object_url = 'connect/stripe';
    }
    
    /**
     * Returns a specific object
     *
     * @param int $id
     * @param array $opts
     *
     * @return mixed
     */
    public static function retrieve($id = '', $opts = null)
    {
        return self::_retrieve($id, $opts);
    }
    /**
     * May not need stripe callback because it's easier to just throw stripe directly to the api.wplauncher.com/v1/connect/stripe-callback
    */
}
