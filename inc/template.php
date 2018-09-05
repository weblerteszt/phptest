<?php
	/* * /
	if(!(isset($portal) && ($portal === 1))) {
	/* */
	if(!isset($portal) || ($portal !== 1)) {
		echo 'Nem nyert!';
		exit;
	};
?><!DOCTYPE html>
<html lang="hu">
<head>
	<script>
		var ieVer = -1;
	</script>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title><?=$title?> • Ez a portál kísérleti verziója</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" />
	<link href="<?=$web_base?>style.css?ver=0.0.7" rel="stylesheet" type="text/css" media="screen" />
	<script src="<?=$web_base?>main.js?ver=0.0.7"></script>
	<script src="<?=$web_base?>teszt.js?ver=0.0.7"></script>
</head>
<body>
	<header>
		Ez a portál kísérleti verziója
	</header>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span> 
				</button>
				<a class="navbar-brand" href="<?=$web_base?>">Teszt site</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
<?php
	foreach($menu as $mp_name => $mp_val) {
		//$file_now = 'pages/' . $mp_name . '.inc.php';
		echo "\t\t\t\t\t", '<li',
			//(($file === $file_now) ? ' class="active"' : ''),
			((
				($page === $mp_name)
				|| (
					($page === 'index') && ('' === $mp_name)
				)
			) ? ' class="active"' : ''),
			'><a href="', $web_base, $mp_name, '">', $mp_val, '</a></li>', "\n";
	};
?>
				</ul>
				<form class="navbar-form navbar-right" action="" method="post">
<?php
if($user_data->getUser()) {
?>
					<input type="hidden" name="logout" value="yes" />
					<div class="form-group">
						<button class="btn btn-default" type="submit">
							<i class="glyphicon glyphicon-log-out"></i>
						</button>
					</div>
<?php
} else {
?>
					<div class="form-group">
						<input name="mail" type="text" class="form-control" placeholder="E-mail cím" />
					</div>
					<div class="input-group">
						<input name="pass" type="password" class="form-control" placeholder="Jelszó" />
						<div class="input-group-btn">
							<button class="btn btn-default" type="submit">
								<i class="glyphicon glyphicon-log-in"></i>
							</button>
						</div>
					</div>
<?php
};
?>
				</form>
<?php /* * /
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
/* */
?>
			</div>
		</div>
	</nav>
<?php
foreach($messages as $message) {
?>
	<div class="alert alert-<?=$message[0]?> alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong><?=$message[1]?></strong> <?=$message[2]?>
	</div>
<?php
};
?>
	<section>
		<article>
			<h1><?=$title?></h1>
<?php
	if(preg_match('/\[module \w+( [^\]\s]+)*\]/', $body)) {
		$body_rows = explode("\n", $body);
		foreach($body_rows as $body_row) {
			if(preg_match('/\[module (\w+)(( [^\]\s]+)*)\]/', $body_row, $matches)) {
				if(is_file('modules/' . $matches[1] . '.inc.php')) {
					$params = explode(' ', '' . $matches[2]);
					include('modules/' . $matches[1] . '.inc.php');
				};
			} else {
				echo "\t\t\t", $body_row, "\n";
			};
		};
		//echo $body;
	} else {
		echo "\t\t\t", $body, "\n";
	};
?>
		</article>
<?php if($debug) {
	$my_num = -8;
	$my_num /= 3;
	$my_num *= 3;
	$my_num &= 9;
	$my_num = 9223372036854775807 + 1;
	/*
	 9223372036854776000 JS
	-9223372036854775808 Java (long)
	-9223372036854776000 Java (double)
	 9223372036854800000 PHP
	*/
	$my_num -= 1;
	/*
	 9223372036854776000 JS
	 9223372036854775807 Java (long)
	-9223372036854776000 Java (double)
	 9223372036854800000 PHP
	*/
?>
		<article>
<?php
	$my_num = 0;
	echo '			<p>0 '; if($my_num) echo 'igaz'; else echo 'hamis'; echo "</p>\n";
	echo '			<p>'; echo gettype($my_num); echo "</p>\n";
	$my_num = 1;
	echo '			<p>1 '; if($my_num) echo 'igaz'; else echo 'hamis'; echo "</p>\n";
	echo '			<p>'; echo gettype($my_num); echo "</p>\n";
	$my_num = -1;
	echo '			<p>-1 '; if($my_num) echo 'igaz'; else echo 'hamis'; echo "</p>\n";
	echo '			<p>'; echo gettype($my_num); echo "</p>\n";
	$my_num = 0.0;
	echo '			<p>0.0 '; if($my_num) echo 'igaz'; else echo 'hamis'; echo "</p>\n";
	echo '			<p>'; echo gettype($my_num); echo "</p>\n";
	$my_num = 0.1;
	echo '			<p>0.1 '; if($my_num) echo 'igaz'; else echo 'hamis'; echo "</p>\n";
	echo '			<p>'; echo gettype($my_num); echo "</p>\n";
	$my_num = -0.1;
	echo '			<p>-0.1 '; if($my_num) echo 'igaz'; else echo 'hamis'; echo "</p>\n";
	echo '			<p>'; echo gettype($my_num); echo "</p>\n";
	$my_num = true;
	echo '			<p>true '; if($my_num) echo 'igaz'; else echo 'hamis'; echo "</p>\n";
	echo '			<p>'; echo gettype($my_num); echo "</p>\n";
	$my_num = false;
	echo '			<p>false '; if($my_num) echo 'igaz'; else echo 'hamis'; echo "</p>\n";
	echo '			<p>'; echo gettype($my_num); echo "</p>\n";
	$my_num = null;
	echo '			<p>null '; if($my_num) echo 'igaz'; else echo 'hamis'; echo "</p>\n";
	echo '			<p>'; echo gettype($my_num); echo "</p>\n";
	$my_num = '0';
	echo '			<p>0 '; if($my_num) echo 'igaz'; else echo 'hamis'; echo "</p>\n";
	echo '			<p>'; echo gettype($my_num); echo "</p>\n";
	$my_num = '00';
	echo '			<p>00 '; if($my_num) echo 'igaz'; else echo 'hamis'; echo "</p>\n";
	echo '			<p>'; echo gettype($my_num); echo "</p>\n";
	$my_num = '1';
	echo '			<p>1 '; if($my_num) echo 'igaz'; else echo 'hamis'; echo "</p>\n";
	echo '			<p>'; echo gettype($my_num); echo "</p>\n";
	$my_num = '-1';
	echo '			<p>-1 '; if($my_num) echo 'igaz'; else echo 'hamis'; echo "</p>\n";
	echo '			<p>'; echo gettype($my_num); echo "</p>\n";
	$my_num = '0.0';
	echo '			<p>0.0 '; if($my_num) echo 'igaz'; else echo 'hamis'; echo "</p>\n";
	echo '			<p>'; echo gettype($my_num); echo "</p>\n";
	$my_num = '0.1';
	echo '			<p>0.1 '; if($my_num) echo 'igaz'; else echo 'hamis'; echo "</p>\n";
	echo '			<p>'; echo gettype($my_num); echo "</p>\n";
	$my_num = '-0.1';
	echo '			<p>-0.1 '; if($my_num) echo 'igaz'; else echo 'hamis'; echo "</p>\n";
	echo '			<p>'; echo gettype($my_num); echo "</p>\n";
	$my_num = 'true';
	echo '			<p>true '; if($my_num) echo 'igaz'; else echo 'hamis'; echo "</p>\n";
	echo '			<p>'; echo gettype($my_num); echo "</p>\n";
	$my_num = 'false';
	echo '			<p>false '; if($my_num) echo 'igaz'; else echo 'hamis'; echo "</p>\n";
	echo '			<p>'; echo gettype($my_num); echo "</p>\n";
	$my_num = 'null';
	echo '			<p>null '; if($my_num) echo 'igaz'; else echo 'hamis'; echo "</p>\n";
	echo '			<p>'; echo gettype($my_num); echo "</p>\n";
	$my_num = '';
	echo '			<p>üres string '; if($my_num) echo 'igaz'; else echo 'hamis'; echo "</p>\n";
	echo '			<p>'; echo gettype($my_num); echo "</p>\n";
	$my_num = 't';
	echo '			<p>t '; if($my_num) echo 'igaz'; else echo 'hamis'; echo "</p>\n";
	echo '			<p>'; echo gettype($my_num); echo "</p>\n";
	$my_num = 'f';
	echo '			<p>f '; if($my_num) echo 'igaz'; else echo 'hamis'; echo "</p>\n";
	echo '			<p>'; echo gettype($my_num); echo "</p>\n";
	$alma = 23;
	if($my_num = 0) {
		echo "			<p>Q234</p>\n";
	} else {
		echo "			<p>W234</p>\n";
	};
	echo "			<p>my_num = $alma" . ($my_num + $alma) . "</p>\n";
?>
		</article>
<?php
?>
		<pre id="jstext"></pre>
		<article>
			<h2>Debug</h2>
			<p>my_num: <?=$my_num?></p>
			<p>SID: <?=$user_data->sid?></p>
			<p>SID: <?php echo $user_data->sid; ?></p>
			<p>User: <?php echo $user_data->getUser(); ?></p>
			<p>Timeout: <?php echo strftime('%Y. %B %e., %A %H.%M.%S', ((int) $user_data->timeout - 0)); ?></p>
			<p>Now: <?php echo strftime('%Y. %B %e., %A %H.%M.%S', (int) $user_data->now); ?></p>
		</article>
<?php }; ?>
	</section>
	<footer>
    	<div id="footertext" align="center">Webler Sitebuild 2018 &copy;</div>
    </footer>
</body>
</html>