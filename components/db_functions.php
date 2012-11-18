<?php
require_once dirname(__FILE__).'/../config.php';

function write_measure($vera_device_id,$value){
	global $db;

	$local_id=get_device_local_id($vera_device_id);
	//echo "insert into measures(id,value,device_id,ts) values(NULL,$value,$local_id,CURRENT_TIMESTAMP)\n";
	$stmt=$db->exec('insert into measures(id,value,device_id,ts) values(NULL,'.$value.','.	$local_id.',CURRENT_TIMESTAMP)');
}

function get_device_local_id($vera_id){
	global $db;

	$stmt=$db->query('select * from devices_mapping where vera_id='.$vera_id);
	$row=$stmt->fetch(PDO::FETCH_OBJ);
	return $row->local_id;
}

?>