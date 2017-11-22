<?php

require('../vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// Our web handlers

$app->get('/', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  $app->render('/views/home.php');
});
$app->get('/todo', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  $app->render('/views/todo.php');
});
$app->get('/todo-settings', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  $app->render('/views/todo-settings.php');
});
$app->get('*', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  $app->render('/views/404.php');
});
?>
