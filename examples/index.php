<?php
require 'vendor/autoload.php';
require_once 'keys.php';

use Wplauncher\Plan;
//use Wplauncher\WplauncherClient as Wplauncher;
$loader = new Twig_Loader_Filesystem(__DIR__ . '/examples/templates');
$twig = new Twig_Environment($loader);

$wplauncherPlan = new Wplauncher\Plan($wplauncher_access_token);

try {
    $plans = $wplauncherPlan->all();
    echo $twig->render('plan.html.twig', array('plans' => $plans));
}
catch (\Exception $e) {
    echo 'An error occurred';
}