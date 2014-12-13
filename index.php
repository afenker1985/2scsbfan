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

$app->get('/ablum/*', function () {
	echo "PASS";
});

$app->run();

?>