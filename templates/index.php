<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Vera Home Monitoring</title>
	<link rel="icon" href="/vera/favicon.png">	
	<link href="/vera/bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="/vera/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="/vera/css/slideControl.css" rel="stylesheet">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
	<script type="text/javascript" src="/vera/js/jquery.slideControl.js"></script>

	<script type="text/javascript" src="/vera/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/vera/bootstrap/js/bootstrap.min.js"></script>
<style>
.well:hover{
	background-color: #eee;
}
</style>
</head>
<body>
<div class="container">
	<div class="navbar">
	  <div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </a>
		<span class="brand">
			<img src="/vera/img/leaf.png"> Vera Monitoring
		</span>
			<ul class="nav nav-collapse">
				<li><a href="/vera">Home</a></li>
				<li><a href="/vera/console">Console</a></li>
				<li><a href="/vera/graph/temperature">Températures</a></li>
				<li><a href="/vera/graph/energy">Energie</a></li>
				<li><a href="/vera/graph/hum">Humidité</a></li>
				<li><a href="/vera/admin">admin</a></li>
			</ul>
		</div>
	  </div>
	</div>
</div>
<div class="container">
		<h2>Températures</h2>
		<div class="row">
			<?php
			require_once('./config.php');
			require_once('./components/lib_vera.php');
			
			$box= new VeraUnit();
			$box->Address='vera';
			$boxConf=$box->getConfig();
			
			
			foreach ($boxConf->devices as $device){
				if ($device->category==17){
					$t=new TemperatureDevice($box,$device->name,$device->id);			
			?>
			<div class="span2 well">
					<!-- <h6 class="pull-right"><i class="icon-signal"></i> <small><?php echo $t->getBatteryLevel(); ?>%</small></h6> -->
					<h6 class="muted"><strong><?php echo $t->Name ?></strong></h6>
					
					<h2 class="pull-right"><i class="icon-asterisk"></i> <?php echo $t->getTemperature()."°".$boxConf->temperature; ?></h2>
										</div>
			<?php
				}
			
			}
			?>
	
		</div>
		<h2>Hygrométrie</h2>
	<div class="row">
		<?php
			foreach ($boxConf->devices as $device){
				if ($device->category==16){
					$h=new HygroDevice($box,$device->name,$device->id);		
		?>
		<div class="span2 well">
					<!--<h6 class="pull-right"><i class="icon-signal"></i> <small><?php echo $h->getBatteryLevel(); ?> %</small></h6> -->
					<h6 class="muted"><small><strong><?php echo $h->Name ?></strong></small></h6>
					<h2 class="pull-right"><i class="icon-tint"></i> <?php echo $h->getHum(); ?>% </h2>
					
					</div>
		<?php
				}
			
			}
			?>

	</div>
		<h2>Interrupteurs</h2>
		<div class="row">
			<div class="span2 well">
				<h6 class="muted"><small><strong>Commande VMC</strong></small></h6>
				<div class="btn-group" data-toggle="buttons-radio">
  					<button class="btn btn-small"><i class="icon-plus-sign"></i></button>
					<button  class="btn btn-small active"><i class="icon-minus-sign"></i></button>
				</div>
				<h2 class="pull-right">25W </h2>
			</div>
		</div>
		<h2>Variateurs</h2>
		<div class="row">
			<div class="span2 well">
				<h6 class="muted"><small><strong>Table d'hôte</strong></small></h6>
				<div class="btn-group" data-toggle="buttons-radio">
  					<button class="btn btn-small"><i class="icon-plus-sign"></i></button>
					<button  class="btn btn-small active"><i class="icon-minus-sign"></i></button>

						
				</div>
				<div width="100px">
				<label>R:</label><input type="text" value="6.0" class="slideControl" />
				</div>
			<h2 class="pull-right">25W </h2>
	</div>
</div>
<script>
$(document).ready(function() {
	$('.slideControl').slideControl({lowerBound:0,upperBound:100});
});
</script>
</body>
</html>