<?php
 
class Device{
	var $Name;
	var $Type
	var $DeviceNum;
	var $ServiceId;
	var $Variable;
	global $box;
	public function getValue($var=$this->Variable){
		$url="http://".$this->box->Address.":".$this->box->Port."/data_request?id=id=lu_variableget&DeviceNum=".$this->DeviceNum."&serviceId=".$this->ServiceId."&Variable=".$var;
		$ch=curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$json_output=curl_exec($ch);
		curl_close($ch);
		return json_decode($json_output);
	}
	public function storeValue(){
	}
}
class Vera_Unit{
	var $Adress;
	var $Port=3480;
	
	//get the vera config json file as an object
	public function getConfig(){
		$url="http://".$this->Address.":".$this->Port."/data_request?id=lu_data";
		$ch=curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$json_output=curl_exec($ch);
		curl_close($ch);
		return json_decode($json_output);
	}
}

class TemperaturDevice extends Device{
	$this->Type="RFXCOM Temperature Sensor";
	$this->ServiceId="urn:upnp-org:serviceId:TemperatureSensor1";
	$this->Variable="CurrentTemperature";
	//get the temperature value from the device
	function getTemperature(){
		return $this->getValue();
	}
}

?>