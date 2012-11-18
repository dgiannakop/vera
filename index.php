<?php
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
$app->config(array('templates.path' => './templates'));

$app->get('/', function() use($app){
	$app->render('index.php');
});

$app->get('/admin', function() use($app){
	$app->render('admin/index.html');
});
$app->get('/graph/temperature', function() use($app){
	$app->render('gtemperature.php');
});

$app->run();
?>