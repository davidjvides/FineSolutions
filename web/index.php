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
	$dbconn = pg_pconnect("host=ec2-34-235-62-201.compute-1.amazonaws.com port=5432 bdname=ddhgeqsn80f2cj user=ihbstqzjlnctoz password=b500e682b709fa43bf979f2296ed9091a6287ffb4dcefd7d6a51f469503bfc61")

	if ($dbconn) {
		return "Conexion Exitosa"
	}
	   else { 
	   	return "Sin Conexion"
	   }

   	$nombre = $request->get('nombre');
	$respuesta = "David Vides? " .$nombre;
   	return $respuesta;
});


$app->post('/postArduino', function (Request $request) use ($app) {
   	return "OK";
});

$app->run();
