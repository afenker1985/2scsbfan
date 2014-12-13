<?php
require 'Slim/autoload.php';
require 'db/2scsb.php';
$app = new \Slim\Slim();
$scsb = new scsb();

$app->get('/', function () {
	$path = "/";
	include 'header.php';
	include 'welcome.php';
	include 'footer.php';
});

$app->get('/links', function () {
	$path = "/";
	include 'header.php';
	include 'links.php';
	include 'footer.php';
});

$app->get('/albums/:id', function ($id) {
	$path = "../";
	include 'header.php';
	include 'album.php';
	include 'footer.php';
});

$app->run();

?>