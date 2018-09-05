<?php
header('Content-type: image/jpeg');

$filename = 'inc/images/katica.jpg';

$handle = fopen($filename, 'rb');
	//$contents = fread($handle, filesize($filename));
	echo fread($handle, filesize($filename));
fclose($handle);

if(isset($_GET['azon']) && preg_match('/^\d+$/', $_GET['azon'])) {
	$sql = "UPDATE kikuldott_hirlevelek "
	. "SET hirlevel_info = 1, hirlevel_olvasva = NOW(), hirlevel_useragent = '"
	. $user_data->sid
	. "' WHERE kikuldott_hirlevel_azon="
	. $_GET['azon']
	. ';';
	$db2->Execute($sql);
};

//echo $contents;
?>