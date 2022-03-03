<?php session_start();?>
<!DOCTYPE html5>
<html>
<head>
	<title>Рейтинг </title>
<meta charset="utf-8">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript" src="js/func.js"></script>
<link rel="stylesheet" href="css/index.css">
</head>
<body style="overflow: hidden;">

<?php include 'header.php'; ?>

<div class="container">
	<div>
  <canvas id="myChart"></canvas>
</div>
	
</div>
</body>
</html>