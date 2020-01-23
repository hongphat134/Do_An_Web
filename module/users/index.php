<?php 

	$users_clt = new User();
	$ac = getIndex('ac','');
	if($ac == 'sign_in')
		include 'sign_in.php';
	else if($ac == 'sign_up')
		include 'sign_up.php';
	else if($ac == 'edit')
		include 'edit.php';
	else if($ac =='forgot')
		include 'forgot.php';
	else if($ac =='contact')
		include 'contact_us.php';
 ?>