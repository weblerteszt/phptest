<?php
$sql = "SELECT * FROM permissions;";
$rs = $db->Execute($sql);
if($rs) {
	while($row = $rs->FetchRow()) {
		$permissions[$row['permission_id']] = $row['permission_value'];
	};
};
?>