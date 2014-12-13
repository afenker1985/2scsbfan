<?php
require 'Slim/autoload.php';
$app = new \Slim\Slim();

$app->get('/', function () {
	$path = "/";
	$scsb = new scsb();
	include 'db/2scsb.php';
	include 'header.php';
	include 'welcome.php';
	include 'footer.php';
});

$app->get('/links', function () {
	$path = "/";
	$scsb = new scsb();
	include 'db/2scsb.php';
	include 'header.php';
	include 'links.php';
	include 'footer.php';
});

$app->get('/albums/:id', function ($id) {
	$path = "../";
	$scsb = new scsb();
	include 'db/2scsb.php';
	include 'header.php';
	include 'album.php';
	include 'footer.php';
});

$app->run();

?>