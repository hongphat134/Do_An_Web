<?php 
	//echo "This is Index Page";
	$ac = getIndex('ac','home');
	$comments_clt = new Comment();

	if($ac == 'home')
		include 'home.php';
	else if($ac == 'add')
		include 'add.php';
	else if($ac == 'delete')
		include 'delete.php';
	else if($ac == 'edit')
		include 'edit.php';
 ?>