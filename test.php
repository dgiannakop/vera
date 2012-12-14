<?php
	
$host='localhost';
$dbname='vera';
$username='vera';
$password='vera$2012';

$days=365;
$series=array();


$db = mysql_connect($host, $username, $password); 
mysql_select_db($dbname,$db); 

$sql= 'select * from devices_mapping where category=17';
//echo $sql."\r\n";
$req=mysql_query($sql);
while ($device=mysql_fetch_object($req)){
	echo $device->descr."\n";
	$serie=array();
	$sub_sql="select * from measures where device_id=".$device->local_id." order by ts desc limit 0,".$days*144;
	//echo $sub_sql."\r\n";
	/*
	$sub_req=mysql_query($sub_sql);
	while ($measure=mysql_fetch_object($sub_req)){
		$serie[]=array(strtotime($measure->ts)*1000,(float)$measure->value);
	}
	$serie=array_reverse($serie);
	$series[]=array('name'=>$device->descr,'data'=>$serie);
*/
}
	//echo @json_encode($series);

?>