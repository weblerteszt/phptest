<?php
$json_obj = new StdClass();
$json_obj->status = false;
$json_obj->message = 'Egyéb hiba!';
if($permissions['módosítás'] & $user_data->getPerm()) {
	if(isset($_POST['mod']) && preg_match('/modperm(\d+)_(\d+)_([01])/', $_POST['mod'], $matches)) {
		// $matches[1] a felhasználó azonosítója
		// $matches[2] jog helyiértéke
		// $matches[3] jog értéke
		$sql = "SELECT email FROM users WHERE id = {$matches[1]};";
		$rs = $db->Execute($sql);
		if($rs) {
			$json_obj->message = 'Nincs módosítandó felhasználó!';
			if($row = $rs->FetchRow()) {
				$user = new User();
				$user->setUser($row['email']);
				if($user->getUser() === $user_data->getUser()) {
					$json_obj->message = 'Saját jog nem módosítható!';
				} else {
					if($matches[3] === '1') {
						$new_perm = $user->getPerm() | ((int) $matches[2]);
					} else {
						$new_perm = $user->getPerm() & (~ ((int) $matches[2]));
					};
					if((int) $new_perm === (int) $user->getPerm()) {
						$json_obj->message = 'Nem módosult a jog!';
					} else {
						if($user->setPerm($new_perm)) {
							$json_obj->message = 'Sikeres módosítás!';
							$json_obj->status  = true;
							$json_obj->user    = $matches[1];
							$json_obj->perm    = $matches[2];
							$json_obj->value   = $matches[3];
						} else {
							$json_obj->message = 'Egyéb hiba! 5237236';
						};
					};
				};
			};
		} else {
			$json_obj->message = 'Egyéb hiba! 4623567';
		};
	} else {
		$json_obj->message = 'Nincs módosítandó jog!';
	};
} else {
	$json_obj->message = 'Nincs jogosultság!';
};
header('Content-type: application/json; charset=utf8');
echo json_encode($json_obj);
?>