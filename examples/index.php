<?php
require 'vendor/autoload.php';
require_once 'keys.php';

use GuzzleHttp\Client;
use Wplauncher\WplauncherClient as Wplauncher;
$loader = new Twig_Loader_Filesystem(__DIR__ . '/examples/templates');
$twig = new Twig_Environment($loader);
$guzzle = new Client(
    [
        'base_uri' => 'https://api.wplauncher.com/api/v1/',
        'headers' => [
			'Content-Type' => 'application/json',
			'Authorization' => 'Bearer '.$wplauncher_access_token,
			'Accept' => 'application/json'
		]
    ]
);
$wplauncher = new Wplauncher($guzzle);
try {
    $plans = $wplauncher->getPlans($plan_id);
    echo $twig->render('plan.html.twig', array('plans' => $plans));
}
catch (\Exception $e) {
    echo 'An error occurred';
}