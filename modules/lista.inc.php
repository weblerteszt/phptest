<?php
	if(!isset($portal)) {
		echo 'Nem nyert!';
		exit;
	};
	$tabs = 0;
	$start = '';
	if(is_array($params)) {
		/* * /
		echo '<pre>';
		var_dump($params);
		echo '</pre>';
		/* */
		$tabs = $params[1] - 0;
	};
	for($i = 0; $i < $tabs; $i++) {
		$start .= "\t";
	};
	if(is_loggedin() && ($permissions['olvasás'] & $user_data->getPerm())) {
		$sql = 'SELECT id, nev, email, user_perm FROM users;';
		$rs = $db->Execute($sql);
		if($rs) {
			echo $start, '<table class="table table-striped table-bordered table-hover table-autow">', "\n";
			echo $start, '	<thead>', "\n";
			echo $start, '	<tr>', "\n";
			echo $start, '		<th rowspan="2">Név</th>', "\n";
			echo $start, '		<th rowspan="2">E-mail</th>', "\n";
			echo $start, '		<th colspan="', count($permissions), '">Jogok</th>', "\n";
			echo $start, '	</tr>', "\n";
			echo $start, '	<tr>', "\n";
			foreach(array_keys($permissions) as $perm) {
				echo $start, '		<th>', $perm, '</th>', "\n";
			};
			echo $start, '	</tr>', "\n";
			echo $start, '	</thead>', "\n";
			echo $start, '	<tbody>', "\n";
			while($row = $rs->FetchRow()) {
				echo $start, '	<tr>', "\n";
				echo $start, '		<td>', $row['nev'],   '</td>', "\n";
				echo $start, '		<td>', $row['email'], '</td>', "\n";
				foreach($permissions as $perm) {
					echo $start, '		<td class="';
					echo ($row['user_perm'] & $perm) ? 'success' : 'danger';
					echo '">';
					if(($permissions['módosítás'] & $user_data->getPerm()) && ($row['email'] !== $user_data->getUser())) {
						echo '<select class="modperm" id="modperm', $row['id'], '_', $perm, '">', "\n";
						echo $start, '			<option value="1"';
						echo ($row['user_perm'] & $perm) ? ' selected="selected"' : '';
						echo '>igen</option>', "\n";
						echo $start, '			<option value="0"';
						echo ($row['user_perm'] & $perm) ? '' : ' selected="selected"';
						echo '>nem</option>', "\n";
						echo $start, '		</select>';
					} else {
						echo ($row['user_perm'] & $perm) ? 'igen' : 'nem';
					};
					echo '</td>', "\n";
				};
				echo $start, '	</tr>', "\n";
			};
			echo $start, '	</tbody>', "\n";
			echo $start, '</table>', "\n";
		} else {
			echo $start, '<p>Nincs adat!</p>', "\n";
		};
	} else {
		echo $start, '<p>Az adatok megtekintéséhez lépj be fent!</p>', "\n";
	};
?>