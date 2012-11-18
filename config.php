<?php

$db_host='localhost';
$db_name='vera';
$db_user='root';
$db_password='patmeth';

try {
	$db=new PDO('mysql:host='.$db_host.';dbname='.$db_name,$db_user,$db_password);
} catch (Exception $e) {
	echo "no db connextion : ",$e->getMessage();
	die();
	}



?>