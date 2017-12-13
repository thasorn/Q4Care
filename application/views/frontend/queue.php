<!DOCTYPE html>
<html>
<head>
	<title>YOUR QUE</title>
	<script type="text/javascript" src="CONNECT JS HERE"></script>
	<style type="text/css">
	body{
		margin-top: 100px;
		background-image: url("<?php echo HTTP_IMAGES_PATH ?>medical.jpg");
		background-repeat: no-repeat;
    	background-attachment: fixed;
    	background-position: center;
    	background-size: cover;
    	color: white;
	}
	#bor {
		border: 5px solid red;
		padding: 10px;
		border-radius: 50%;
		width: 200px;
		height: 200px;
		font-size: 4em;
		color: black;
    	background-color: snow;
	}
	#p_bor{
		margin-top: 55px;
	}
	.card{
		width: 350px;
		height: 490px;
		border: 5px solid rgba(51, 51, 51, 0);
		background-color: rgba(51, 51, 51, 0.5);
	}
</style>
</head>
<body><center>
	<div class="card">
		<!-- HEAD -->
		<section id="head">
			<div class="topic"><center><p><h1>YOUR QUEUE <h1></p></center></div>
		</section>
		<!-- SHOW QUE & SHOW QUE LEFT -->
		<section id="qued">
			<center>
				<!--QUE IN BORDER-->
				<div id="bor">
					<center><p id="p_bor"><span id="que"><?php echo $queNumber; ?></span></p></center>
				</div>
				<!-- CURRENT & QUE LEFT -->
				<div class="que_left">
					<div><p><h3>Current queue : <span id="current">0</span></h3></p></div>
					<div><p><h3>Queue number : <span id="wait">0</span><h3></p></div>
				</div>
			</center>
		</section>
	</div>
</center></body>
</html>
