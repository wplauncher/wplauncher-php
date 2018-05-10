<?php

namespace Wplauncher;

use Wplauncher\Wplauncher;

class ConnectStripeCallback extends Wplauncher
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
        
        return self::_create($params, $opts);
    }
}
