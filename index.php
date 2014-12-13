<?php
require 'Slim/autoload.php';

$app = new \Slim\Slim();

$app->get('/', function () {
	include 'db/create_menu.php';
	include 'header.php';
	include 'welcome.php';
	include 'footer.php';
});

$app->get('/links', function () {
	include 'db/create_menu.php';
	include 'header.php';
	include 'links.php';
	include 'footer.php';
});

$app->get('/albums/:id', function ($id) {
	include 'db/create_menu.php';
	include 'header.php';
	include 'album.php'
	include 'footer.php';
});

$app->run();

?>