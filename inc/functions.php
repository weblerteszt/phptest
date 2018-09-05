<?php
function is_loggedin() {
	global $user_data;
	if(
		isset($user_data)
		&& (gettype($user_data) === 'object')
		&& isset($user_data->loggedin)
		&& $user_data->loggedin
	) {
		return true;
	} else {
		return false;
	};
}
function create_sid() {
	global $db;
	global $user_data;
	// Adatgyűjtés
	$sid = sha1($user_data->useragent . $user_data->ip . date('Uu'));
	$user_data->sid = $sid;
	// Adatbázisban létrehozás
	$sql = "INSERT INTO sessions(session_id, session_ip, session_useragent)
		VALUES('$sid', '{$user_data->ip}', '{$user_data->useragent}');";
	$db->Execute($sql);
	// Csinálunk sütit
	header('Set-Cookie: sid=' . $sid . '; expires=Fri, 31-Dec-9999 23:59:59 GMT');	
}
?>