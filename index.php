<?php
require 'Slim/autoload.php';
$app = new \Slim\Slim();

$app->get('/', function () {
	$path = "/";
	include 'db/scsb.php';
	$scsb = new scsb();
	include 'header.php';
	include 'welcome.php';
	include 'footer.php';
});

$app->get('/links', function () {
	$path = "/";
	include 'db/scsb.php';
	$scsb = new scsb();
	include 'header.php';
	include 'links.php';
	include 'footer.php';
});

$app->get('/albums/:id', function ($id) {
	$path = "../";
	include 'db/scsb.php';
	$scsb = new scsb();
	include 'header.php';
	include 'album.php';
	include 'footer.php';
});

$app->run();

?>