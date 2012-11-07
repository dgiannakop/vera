<?php
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
$app->config(array('templates.path' => './templates'));

$app->get('/', function() use($app){
	$app->render('index.html');
});

$app->get('/admin', function() use($app){
	$app->render('admin/index.html');
});

$app->run();
?>