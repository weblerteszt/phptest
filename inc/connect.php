<?php
	//echo $_SERVER['PHP_SELF'], '<br />', "\n";
	if(!isset($portal)) {
		echo 'Nem nyert!';
		exit;
	};
	define('DB_TYPE', 'mysqli');
	define('DB_HOST', 'localhost');
	define('DB_PORT', 3306);
	define('DB_USER', 'phptanfolyam');
	define('DB_PASS', 'webler');
	define('DB_BASE', 'webmester');

	define('DB2_TYPE', 'mysqli');
	define('DB2_HOST', 'localhost');
	define('DB2_PORT', 3306);
	define('DB2_USER', 'ezlopjaazadatot');
	define('DB2_PASS', '1s38limkLCn3QO6I');
	define('DB2_BASE', 'ezlopjaazadatot');

	require_once($b_dir . 'inc/adodb5/adodb.inc.php');

	$db = adoNewConnection(DB_TYPE);
	$host = DB_HOST;
	if(DB_PORT !== 3306) {
		$host .= ':' . DB_PORT;
	};
	$db->connect($host, DB_USER, DB_PASS, DB_BASE);
	$sql = 'SET NAMES utf8;';
	$db->Execute($sql);

	$db2 = adoNewConnection(DB2_TYPE);
	$host2 = DB_HOST;
	if(DB2_PORT !== 3306) {
		$host2 .= ':' . DB2_PORT;
	};
	$db2->connect($host2, DB2_USER, DB2_PASS, DB2_BASE);
	$db2->Execute($sql);
?>