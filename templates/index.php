<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Vera Home Monitoring</title>
	<link rel="icon" href="/vera/favicon.png">	
	<link href="/vera/bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="/vera/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>	
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
					<h4 class="muted"><small><strong><?php echo $t->Name ?></strong></small></h4>
					<h1 class="pull-right"><i class="icon-asterisk"></i> <?php echo $t->getTemperature()."°".$boxConf->temperature; ?></h1>
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
					<h4 class="muted"><small><strong><?php echo $h->Name ?></strong></small></h4>
					<h1 class="pull-right"><i class="icon-tint"></i> <?php echo $h->getHum(); ?>%</h12>
					</div>
		<?php
				}
			
			}
			?>

	</div>
		
	</div>
</div>
</body>
</html>