<?php
require_once dirname(__FILE__).'/./config.php';
require_once dirname(__FILE__).'/./components/lib_vera.php';

$box= new VeraUnit();
$box->Address='vera';
$boxConf=$box->getConfig();


foreach ($boxConf->devices as $device){
	if ($device->category==17){
		$t=new TemperatureDevice($box,$device->name,$device->id);
		write_measure($device->id,$t->getTemperature());
	}
}
?>