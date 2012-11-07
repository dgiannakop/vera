<?php
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
$app->config(array('templates.path' => './templates'));

$app->get('/', function() use($app){
	$app->render('index.html');
});


$app->run();
?>