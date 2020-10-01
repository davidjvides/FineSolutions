<?php

use Symfony\Component\HttpFoundation\Request;

require('../vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// Register view rendering
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Our web handlers

$app->get('/', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('index.twig');
});



$app->post('/enviodato', function (Request $request) use ($app) {
   return $request;
});


$app->post('/quien', function (Request $request) use ($app) {
   	$nombre = $request->get('nombre');
	$respuesta = "David Vides? " .$nombre;
   	return $respuesta;
});


$app->post('/postArduino', function (Request $request) use ($app) {
   	return "OK";
});

$app->run();
