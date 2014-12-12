<?php
require 'Slim/autoload.php';

$app = new \Slim\Slim();

$app->get('/', function () {
	include 'db/create_menu.php';
	include 'header.php';
	include 'welcome.php';
	include 'footer.php';
});

$app->get('/albums', function () {
	include 'header.php';
	
	include 'footer.php';
});

$app->get('/links', function () {
	include 'header.php';
	
	include 'footer.php';
});

$app->run();

?>