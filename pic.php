<?php
	// Classes
	require_once('inc/classes.php');

	// Variables
	$debug = true;
	$portal = 1;
	$web_base = '/php_hsz2/';
	$page = '';
	$title = '404';
	$body = '404 Not found! A keresett oldal nem található!';
	$timeout_length = 15 * 60;
	$menu = array();
	$messages = array();
	$permissions = array();
	$user_data = new User();

	// Hazudunk jól :-D
	header("X-Powered-By: ASP 45.8.7");

	// Requires
	require_once('inc/functions.php');
	require_once('inc/connect.php');
	require_once('inc/session.php');
	require_once('inc/user.php');
	require_once('inc/pic.php');
?>