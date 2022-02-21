<?php session_start();?>
<!DOCTYPE html5>
<html>
<head>
	<title>Истории успеха</title>
<meta charset="utf-8">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript" src="js/func.js"></script>
<link rel="stylesheet" href="css/index.css">
</head>

<?php include 'header.php'; ?>

<div class="container">
	<div class="content">
		<div class="blocks_info">
			<?php require_once('admin/connection.php'); ?>
			<?php 
			$select = "SELECT * from news";
			$query = mysqli_query($bd, $select);
			$row = mysqli_fetch_array($query);
			do {
				$string = strip_tags($row['news_text']);
				$string = substr($string, 0, 450);
				$string = rtrim($string, "!,.-");
				$string = substr($string, 0, strrpos($string, ' '));

				echo '<div class="news_block">
						<div class="new_image">
							<img src="'.$row['news_img'].'">
						</div>
						<div class="new_text">
							<div class="new_title">
								<a class="hrefs" href="success_history?history='.$row['id_news'].'">'.$row['news_title'].'</a> 
							</div>
							<div style="padding: 0 25px;">'.$string.'...</div>
							<div>
								<span class="prev_button">'.$row['news_date'].'</span>
								<a href="success_history?history='.$row['id_news'].'" class="next_button">читать далее</a>
							</div>
						</div>
				</div>
			';
			}while($row = mysqli_fetch_array($query)); 
				?>
		</div>
	</div>
</div>
</body>
</html>