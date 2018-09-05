var base_url = '/php_hsz2/';
$(function() {
	if($('select.modperm')) {
		$('select.modperm').each(function(index) {
			$(this).change(function() {
				var post_obj = {
					mod: $(this).attr('id') + '_' + $(this).val()
				};
				$.post(base_url + 'modperm.php', post_obj, function(data) {
					if(data.status) {
						var sel = '#modperm' + data.user + '_' + data.perm;
						$(sel).parent().toggleClass('danger');
						$(sel).parent().toggleClass('success');
						alert(data.message);
					} else {
						alert(data.message);
						location.href = location.href;
					};
				});
			});
		});
	};
	var my_num = -8; // 52 bit integer + 1 bit előjel => 64 bit lebegőpontos szám (IEEE 754 Double precision)
	my_num /= 3; // my_num = my_num / 3; // 64 bit lebegőpontos szám (IEEE 754 Double precision)
	my_num *= 3.0; // 52 bit integer + 1 bit előjel
	my_num &= 9; // 32 bit integer (előjel ebből 1 bit)
	//alert(my_num);
	my_num = 9223372036854775807 + 1;
	//alert(my_num - 1);
	var my_string = '';
	my_num = 0;
	my_string += '0 '; if(my_num) my_string += 'igaz'; else my_string += 'hamis'; my_string += "\n";
	my_string += ''; my_string += typeof(my_num); my_string += "\n";
	my_num = 1;
	my_string += '1 '; if(my_num) my_string += 'igaz'; else my_string += 'hamis'; my_string += "\n";
	my_string += ''; my_string += typeof(my_num); my_string += "\n";
	my_num = -1;
	my_string += '-1 '; if(my_num) my_string += 'igaz'; else my_string += 'hamis'; my_string += "\n";
	my_string += ''; my_string += typeof(my_num); my_string += "\n";
	my_num = 0.0;
	my_string += '0.0 '; if(my_num) my_string += 'igaz'; else my_string += 'hamis'; my_string += "\n";
	my_string += ''; my_string += typeof(my_num); my_string += "\n";
	my_num = 0.1;
	my_string += '0.1 '; if(my_num) my_string += 'igaz'; else my_string += 'hamis'; my_string += "\n";
	my_string += ''; my_string += typeof(my_num); my_string += "\n";
	my_num = -0.1;
	my_string += '-0.1 '; if(my_num) my_string += 'igaz'; else my_string += 'hamis'; my_string += "\n";
	my_string += ''; my_string += typeof(my_num); my_string += "\n";
	my_num = true;
	my_string += 'true '; if(my_num) my_string += 'igaz'; else my_string += 'hamis'; my_string += "\n";
	my_string += ''; my_string += typeof(my_num); my_string += "\n";
	my_num = false;
	my_string += 'false '; if(my_num) my_string += 'igaz'; else my_string += 'hamis'; my_string += "\n";
	my_string += ''; my_string += typeof(my_num); my_string += "\n";
	my_num = null;
	my_string += 'null '; if(my_num) my_string += 'igaz'; else my_string += 'hamis'; my_string += "\n";
	my_string += ''; my_string += typeof(my_num); my_string += "\n";
	my_num = '0';
	my_string += '0 '; if(my_num) my_string += 'igaz'; else my_string += 'hamis'; my_string += "\n";
	my_string += ''; my_string += typeof(my_num); my_string += "\n";
	my_num = '00';
	my_string += '00 '; if(my_num) my_string += 'igaz'; else my_string += 'hamis'; my_string += "\n";
	my_string += ''; my_string += typeof(my_num); my_string += "\n";
	my_num = '1';
	my_string += '1 '; if(my_num) my_string += 'igaz'; else my_string += 'hamis'; my_string += "\n";
	my_string += ''; my_string += typeof(my_num); my_string += "\n";
	my_num = '-1';
	my_string += '-1 '; if(my_num) my_string += 'igaz'; else my_string += 'hamis'; my_string += "\n";
	my_string += ''; my_string += typeof(my_num); my_string += "\n";
	my_num = '0.0';
	my_string += '0.0 '; if(my_num) my_string += 'igaz'; else my_string += 'hamis'; my_string += "\n";
	my_string += ''; my_string += typeof(my_num); my_string += "\n";
	my_num = '0.1';
	my_string += '0.1 '; if(my_num) my_string += 'igaz'; else my_string += 'hamis'; my_string += "\n";
	my_string += ''; my_string += typeof(my_num); my_string += "\n";
	my_num = '-0.1';
	my_string += '-0.1 '; if(my_num) my_string += 'igaz'; else my_string += 'hamis'; my_string += "\n";
	my_string += ''; my_string += typeof(my_num); my_string += "\n";
	my_num = 'true';
	my_string += 'true '; if(my_num) my_string += 'igaz'; else my_string += 'hamis'; my_string += "\n";
	my_string += ''; my_string += typeof(my_num); my_string += "\n";
	my_num = 'false';
	my_string += 'false '; if(my_num) my_string += 'igaz'; else my_string += 'hamis'; my_string += "\n";
	my_string += ''; my_string += typeof(my_num); my_string += "\n";
	my_num = 'null';
	my_string += 'null '; if(my_num) my_string += 'igaz'; else my_string += 'hamis'; my_string += "\n";
	my_string += ''; my_string += typeof(my_num); my_string += "\n";
	my_num = '';
	my_string += 'üres string '; if(my_num) my_string += 'igaz'; else my_string += 'hamis'; my_string += "\n";
	my_string += ''; my_string += typeof(my_num); my_string += "\n";
	my_num = 't';
	my_string += 't '; if(my_num) my_string += 'igaz'; else my_string += 'hamis'; my_string += "\n";
	my_string += ''; my_string += typeof(my_num); my_string += "\n";
	my_num = 'f';
	my_string += 'f '; if(my_num) my_string += 'igaz'; else my_string += 'hamis'; my_string += "\n";
	my_string += ''; my_string += typeof(my_num); my_string += "\n";
	$('#jstext').text(my_string);

});
/*
00 00000 00000 00000 00000 00000 01001 =  9
00 00000 00000 00000 00000 00000 01000 =  8
00 00000 00000 00000 00000 00000 00111 =  7
00 00000 00000 00000 00000 00000 00000 =  0
11 11111 11111 11111 11111 11111 11111 = -1
11 11111 11111 11111 11111 11111 11110 = -2
11 11111 11111 11111 11111 11111 11101 = -3
11 11111 11111 11111 11111 11111 11100 = -4
11 11111 11111 11111 11111 11111 11011 = -5
11 11111 11111 11111 11111 11111 11010 = -6
11 11111 11111 11111 11111 11111 11001 = -7
11 11111 11111 11111 11111 11111 11000 = -8
*/