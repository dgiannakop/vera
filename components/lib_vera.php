<?php
require_once('db_functions.php');

class VeraUnit{
	public $Address;
	public $Port=3480;
	
	//get the vera config json file as an object
	public function getConfig(){
		$url="http://".$this->Address.":".$this->Port."/data_request?id=lu_sdata";
		//echo "$url";
		$ch=curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$json_output=curl_exec($ch);
		curl_close($ch);
		return json_decode($json_output);
	}
} 

class Device{
	public $Name;
	public $Type;
	public $DeviceNum;
	public $ServiceId;
	public $Variable;
	public $Location;
	public $box;
	
	function __construct($box){
	}
	public function getValue($var){
		$url="http://".$this->box->Address.":".$this->box->Port."/data_request?id=lu_variableget&DeviceNum=".$this->DeviceNum."&serviceId=".$this->ServiceId."&Variable=".$var;
		//echo "\n$url\n";
		$ch=curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$json_output=curl_exec($ch);
		curl_close($ch);
		return json_decode($json_output);
	}
}

class Room{
	public $Name;
	private $roomId;
	function __construct($id,$name){
		$this->roomId=$id;
		$this->Name=$name;
	}
}

class TemperatureDevice extends Device{
	function __construct($box,$name,$device_id){
		$this->Type="RFXCOM Temperature Sensor";
		$this->ServiceId="urn:upnp-org:serviceId:TemperatureSensor1";
		$this->Variable="CurrentTemperature";
		$this->DeviceNum=$device_id;
		$this->Name=$name;
		$this->box=$box;		
	}
	//get the temperature value from the device
	function getTemperature(){
		return $this->getValue($this->Variable);
	}
}
class HygroDevice extends Device{
	function __construct($box,$name,$device_id){
		$this->Type="RFXCOM Hygrometry Sensor";
		$this->ServiceId="urn:micasaverde-com:serviceId:HumiditySensor1";
		$this->Variable="CurrentLevel";
		$this->DeviceNum=$device_id;
		$this->Name=$name;
		$this->box=$box;
	}
	function getHum(){
		return $this->getValue($this->Variable);
	}
}
?>