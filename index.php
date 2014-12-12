<?php
require 'Slim/autoload.php';

$app = new \Slim\Slim();

$app->get('/', function () {
	readfile('header.php');
	readfile('welcome.php');
	readfile('footer.php');
});

$app->get('/albums', function () {
	readfile('header.php');
	
	readfile('footer.php');
});

$app->get('/links', function () {
	readfile('header.php');
	
	readfile('footer.php');
});

$app->run();

?>