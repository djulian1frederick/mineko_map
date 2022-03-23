<?php session_start();?>
<!DOCTYPE html5>
<html>
<head>
	<title>Рейтинг </title>
<meta charset="utf-8">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<meta name='viewport' content='width=device-width,initial-scale=1'/>
<script type="text/javascript" src="js/func.js"></script>
<link rel="stylesheet" href="css/index.css">
</head>
<body onload="loadgraph()">

<?php include 'header.php'; ?>
<?php require_once('admin/connection.php'); ?>
<?php 
$count_all_predpr = mysqli_query($bd, "SELECT count(*) from predpriyatiya");
$count_all_predpr = mysqli_fetch_array($count_all_predpr);
$count_all_predpr = $count_all_predpr['count(*)']; ?>
<div class="container">
	<div class="content" style="background: #fff;">
		<div class="update-block" style="margin: auto; text-align: center; background: #fff; width: 100%; border: none; height: 100%;">
			<p>Для просмотра информации по МО наведите  курсор на элемент диаграммы</p> 
			<br>
			<span style="font-size: 24px; font-family: Circe Light;">Рейтинг экспортеров по муниципальным образованиям Оренбургской области</span>
			<br>
			<span>Всего в системе - <u><?php echo $count_all_predpr; ?></u></span>
			<canvas id="common_rate" height="250%"></canvas>
			<div id="result"></div>
			<div class="infoaboutrate" id="notice_aboutrate">
			<span onclick="hide_notice()">x</span>
			При просмотре с мобильного устройства отображается не вся легенда!
			</div>
			
		</div>
	</div>
</div>
</div>
<?php require_once('footer.php'); ?>
</body>
</html>
<script>
	function hide_notice() {
		$('#notice_aboutrate').hide();
	}
</script>