<?php
	header('Content-type: application/javascript; charset=utf-8');
	if(isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/MSIE\s*[5-8]/', $_SERVER['HTTP_USER_AGENT'])) {
		$ie5_8 = true;
		$let = 'var';
		$const = 'var';
	} else {
		$ie5_8 = false;
		$let = 'let';
		$const = 'const';
	};
?>
// User agent: <?php echo $_SERVER['HTTP_USER_AGENT']; ?>


y = 'Barack';

c();

//alert(y);

<?=$let?> x = 'Alma';


alert(osszead(3, 5));
alert(hatvanyoz(2, 10));
alert(x);

<?=$const?> car = {type:x, model:"500", color:"white"};

console.log(car);

car.color = "red";

var y = 'Körte';

function c() {
	y = 'Citrom';
}

function hatvanyoz(a, b) {
<?php if($ie5_8) { ?>
	var hatvany = 1;
	for(var i = 0; i < b; i++) {
		hatvany *= a;
	};
	return hatvany;
<?php } else { ?>
	return a ** b;
<?php }; ?>
}
function osszead(a, b) {
	//x = a;
	//y = b;
	var x = a;
	var y = b;
	return x + y;
}