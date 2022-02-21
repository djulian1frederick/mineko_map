<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<title>История успеха</title>
<meta charset="utf-8">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript" src="js/func.js"></script>
<link rel="stylesheet" href="css/index.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
	<div class="content">
		<?php require_once('admin/connection.php'); $id = $_GET['history']; ?>
		<?php 
			$select = "SELECT * from news where id_news='".$id."'";
			$query = mysqli_query($bd, $select);
			$row = mysqli_fetch_array($query);
		?>
			<div class="blocks_info" style="background: #fbfbfb;">
					<div class="block_new">
						<div class="image_new" style="padding: 0;">
							<?php echo '<img src="'.$row['news_img'].'">';?>
						</div>
						<div class="new_title" style="padding: 10px 0;">
							<?php echo $row['news_title'];?>
						</div>
						<div class="new_text" style="border-bottom: 1px solid; padding: 10px 0;">
							<?php echo $row['news_text'];?>
						</div>
						<div class="new_date">
							<?php echo $row['news_date'];?>
						</div>
						<div style="width: 80%;margin: -2.5% 10% 0 10%; padding: 10px;">
							<script src="https://yastatic.net/share2/share.js"></script>
							<div class="ya-share2" data-curtain data-shape="round" data-limit="4" data-services="vkontakte,facebook,odnoklassniki,telegram,twitter,viber,whatsapp"></div>
							<div style="border: 0.5px dotted #cecece;">
							<span>Читайте также:</span>
								<ul>
									<?php
										$all_news = mysqli_query($bd, "SELECT * from news where id_news != '".$id."'");
										$news_row = mysqli_fetch_array($all_news);
											do {
												echo '<li style="list-style: inside;"><a class="hrefs" href="success_history?history='.$news_row['id_news'].'">'.$news_row['news_title'].'</a></li>';
											}while($news_row = mysqli_fetch_array($all_news));
									?>
								</ul>
							</div>
						</div>
					</div>
			</div>
	</div>
</div>
</body>
</html>

<style>
	.block_new {
		display: block;
		width: 100%;
		height: auto;
		margin: 0 auto;
		padding: 10px 0;
		background: #fff;
	}
	.image_new {
		width:80%; 
		margin: 0 10%;
		max-height: 480px;
		overflow: hidden;
		text-align: center;
	}
	.image_new img {
		width: 100%;
		height: auto;
	}
	.new_title {
		padding: 0;
		margin: auto;
		text-align: center;
		width: 80%;
		margin: 0 10%; 
		color: #fff;
		background: #1c75bc;
	}
	.new_text {
		width: 80%;
		margin: 0 10%;
	}
	.new_date {
		margin-left: 80%;
		font-family: Circe ExtraLight;
	}
</style>