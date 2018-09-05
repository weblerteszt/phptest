<?php
	if(isset($_COOKIE['sid']) && preg_match('/^[0-9a-fA-F]{40}$/', $_COOKIE['sid'])) {
		$user_data->sid = $_COOKIE['sid'];
	} else {
		create_sid();
	};
	$sql = "SELECT *, NOW() AS session_now FROM sessions WHERE session_id = '{$user_data->sid}';";
	$rs = $db->Execute($sql);
	if($rs) {
		if($row = $rs->FetchRow()) {
			// Van adatbázisban is olyan SID, ami a cookie-ban
			if(($user_data->useragent === $row['session_useragent'])
				&& ($user_data->ip === $row['session_ip'])
			) {
				// Stimmel az IP és useragent
				$user_data->setUser($row['session_user']);
				setlocale(LC_ALL, 'hu_HU');
				$user_data->timeout = strtotime($row['session_timeout']);
				//$user_data->now     = strftime('%Y. %B %e., %A %H.%M.%S', strtotime($row['session_now']));
				//$user_data->now     = date('Y. F j., l H.i.s', strtotime($row['session_now']));
				$user_data->now     = strtotime($row['session_now']);
				$timeout = 5 + $user_data->timeout - $user_data->now;
				if(isset($_POST['logout']) && ($_POST['logout'] === 'yes')) {
					// Kilépés
					$user_data = null;
					$user_data = new User();
					$sql = 'UPDATE sessions SET session_user = NULL, session_timeout = NULL'
						. " WHERE session_id = '{$user_data->sid}';";
					$db->Execute($sql);
					$messages[] = array('success', 'Sikeres kilépés!', 'Viszlát! Várunk máskor is!');
				} elseif(isset($_POST['mail']) && isset($_POST['pass'])) {
					// Belépési kísérlet
					$mail = preg_replace("/['`]/", '', $_POST['mail']);
					$sql = "SELECT * FROM users WHERE email = '$mail' AND jelszo = '"
						. md5($_POST['pass']) . "';";
					$rs2 = $db->Execute($sql);
					if($row2 = $rs2->FetchRow()) {
						// Sikeres belépés
						$user_data->setUser($mail);
						$user_data->timeout  = $user_data->now + $timeout_length;
						$user_data->loggedin = true;
						$sql = 'UPDATE sessions SET session_timeout = '
							. "'" . date('Y-m-d H:i:s', $user_data->timeout) . "'"
							. ", session_user = '$mail' WHERE session_id = '{$user_data->sid}';";
						$db->Execute($sql);
						$messages[] = array('success', 'Sikeres belépés!', 'Mostantól belépett felhasználóként használhatod a portált.');
					} else {
						// Sikertelen belépés
						$user_data = null;
						$user_data = new User();
						$sql = 'UPDATE sessions SET session_user = NULL, session_timeout = NULL'
							. " WHERE session_id = '{$user_data->sid}';";
						$db->Execute($sql);
						$messages[] = array('danger', 'Sikertelen belépés!', 'A jelszó vagy a felhasználó címe hibás.');
					};
				} elseif(($timeout > 0) && ($user_data->getUser() !== '')) {
					// Még nem járt le
					$user_data->timeout  = $user_data->now + $timeout_length;
					$user_data->loggedin = true;
					$sql = 'UPDATE sessions SET session_timeout = '
						. "'" . date('Y-m-d H:i:s', $user_data->timeout) . "'"
						. " WHERE session_id = '{$user_data->sid}';";
					$db->Execute($sql);
				} elseif(($row['session_timeout'] == '') && ($row['session_user'] == '')) {
					// Nem volt belépve eleve
				} else {
					// Lejárt
					$user_data = null;
					$user_data = new User();
					$sql = 'UPDATE sessions SET session_user = NULL, session_timeout = NULL'
						. " WHERE session_id = '{$user_data->sid}';";
					$db->Execute($sql);
					$messages[] = array('info', 'Lejárt a biztonsági időkorlát!', 'Ha szükséges, jelentkezz be újra.');
				};
			} else {
				// Baj van, talán másolt cookie
				create_sid();
				$ua0 = preg_replace('/\d/', '', $user_data->useragent);
				$ua1 = preg_replace('/\d/', '', $row['session_useragent']);
				if(($ua0 === $ua1) && ($user_data->ip === $row['session_ip'])) {
					// Frissült a böngésző
					$messages[] = array('info', 'Frissült a böngésző!', 'Jelentkezz be újra!');
				} elseif($user_data->useragent === $row['session_useragent']) {
					// Megváltozott az IP
					$messages[] = array('info', 'Megváltozott az internetkapcsolat!', 'Jelentkezz be újra!');
				};
			};
		} else {
			create_sid();
		};
	} else {
		// Nem tudtunk olvasni az adatbázisban
		echo 'Hiba 654968';
		exit;
	};
?>