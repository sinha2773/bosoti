<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Database Error</title>
<link href='https://fonts.googleapis.com/css?family=Dosis:400,300,200,500' rel='stylesheet' type='text/css'>
<style type="text/css">
	* { margin:0; padding-top: 0; }
	body { background: #303030; font-family: "Dosis"; color: #fff; text-align: center; }
	#container { padding: 10% 0; }
	h1 {  font-size:200px; }
</style>
</head>
<body>
	<div id="container">
		<h1><?php echo $heading; ?></h1>
		<p><?php echo $message; ?></p>
	</div>
</body>
</html>