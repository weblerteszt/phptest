<?php
	if(isset($_GET['page']) && ($_GET['page'] !== '')) {
		$page = preg_replace('/\W/', '', $_GET['page']);
	} else {
		$page = 'index';
	};
	//$file .= $page . '.inc.php';
	$sql = "SELECT * FROM pages WHERE page_deleted IS NULL AND page_id = '$page';";
	$rs = $db->Execute($sql);
	if($rs) {
		if($row = $rs->FetchRow()) {
			$title = $row['page_title'];
			$body  = $row['page_body'];
		} else {
			$sql = "SELECT * FROM pages WHERE page_deleted IS NULL AND page_id = '404';";
			$rs2 = $db->Execute($sql);
			if($rs2) {
				while($row2 = $rs2->FetchRow()) {
					$title = $row2['page_title'];
					$body  = $row2['page_body'];
				};
			};
		};
	} else {
		$sql = "SELECT * FROM pages WHERE page_deleted IS NULL AND page_id = '404';";
		$rs2 = $db->Execute($sql);
		if($rs2) {
			while($row2 = $rs2->FetchRow()) {
				$title = $row2['page_title'];
				$body  = $row2['page_body'];
			};
		};
	};
	/* * /
	if(!is_file($file)) {
		$file = 'pages/404.inc.php';
	};
	require_once($file);
	/* */
?>