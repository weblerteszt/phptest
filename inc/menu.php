<?php
	$sql = "SELECT menu_points.*
		FROM menu_points JOIN pages
		ON menu_points.page_id = pages.page_id AND pages.page_deleted IS NULL
		ORDER BY menu_points.menu_point_rank;";
	$rs = $db->Execute($sql);
	if($rs) {
		while($row = $rs->FetchRow()) {
			$menu[($row['page_id'] === 'index') ? '' : $row['page_id']] =
				$row['menu_point_name'];
		};
	};
	/* * /
	$menu = array(
		''          => 'Home',
		'lista'     => 'Lista',
		'kapcsolat' => 'Kapcsolat'
	);
	/* */
?>