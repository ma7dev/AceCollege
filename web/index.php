<?php

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
$app->get('/insert', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('insert.twig');
});
$app->get('/list-users', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('list-users.twig');
});
$app->get('/log-in', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('log-in.twig');
});
$app->get('/search', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('search.twig');
});
$app->get('/sign-up', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('sign-up.twig');
});
$app->get('*', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('404.twig');
});
$app->run();
