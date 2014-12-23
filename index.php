<?php
require 'vendor/autoload.php';
$app = new \Slim\Slim();

$app->notFound(function() use($app) {
	echo "PASS";
	$app->response()->redirect('/404');
});

$app->get('/404', function() {
	$path = "/";
	include 'db/scsb.php';
	$scsb = new scsb();
	include 'header.php';
	include '404.php';
	include 'footer.php';
});

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

$app-run();

?>