<?php session_start();?>
<?php 
	$id = $_GET['id'];
		require_once('admin/connection.php');
		$sql_info_production = "SELECT * from production where id_product='".$id."'";
		$this_org = mysqli_query($bd, $sql_info_production);
		$production_row = mysqli_fetch_array($this_org);
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<title><?php echo $production_row['name_production'];?></title>
	<link rel="stylesheet" href="css/index.css">
</head>
<body>
<?php include 'header.php'; ?>
<div class="container">
	<div class="content">
		<?php $sql_org = mysqli_query($bd, "SELECT name, id_predpriyatiya from predpriyatiya where id_predpriyatiya='".$production_row['id_predpriyatiya']."'"); $org_row = mysqli_fetch_array($sql_org); ?>
			<div style="background: #ee161f85; padding: 5px 0; width: fit-content; border-top-right-radius: 15px;"><?php echo '<a style=" color: white; padding: 7.5px; margin: 2px 0; text-decoration: none; cursor: pointer;" href="organization?id='.$org_row['id_predpriyatiya'].'">К организации '.$org_row['name'].'</a>';?></div>
		<div style="background: #fff; margin: auto; text-align: center;">
			<div class="product">
				<div class="img-product">
						<?php echo '<img src="'.$production_row['image_href'].'" alt="'.$production_row['name_production'].'" title="'.$production_row['name_production'].'">';?>
						<span><a href="#">Презентационный материал</a></span>
				</div>
				<div class="info-product">
					<span class="product-span"><?php echo $production_row['name_production'];?></span>
					<?php if ($production_row['description'] <> NULL && $production_row['description'] <> "") {
						echo '<blockquote style="margin: 2.5% 0;font-family: Circe ExtraLight;font-size: 16px;text-align: left;">
								'.$production_row['description'].'</blockquote>';
					} ?>
					
					<!-- КОД ТН -->
					<?php 
						$code_sql = "SELECT * from code_tn_veds where id_product='".$id."'";
						$code_qu = mysqli_query($bd, $code_sql);
						$code_row = mysqli_fetch_array($code_qu);
						if ($code_row <> NULL) {
							echo '<div class="codetnved">
									<div class="block-with-image" style="display:  flex;border-bottom: 1px solid #1c75bc;background: #fbf8f8;padding: 2.5px 0.25%;margin: 0.25% 0;">
										<img src="img/codetnved.png" height="25px" style="float: left;">';
									echo '<span class="code" style="margin: 2.5px 0;">КОД ТН ВЭД ЕАС : '.$code_row['code_tn_ved'].'</span>';
							echo '</div>
									<div style="padding: 10px; background: none;border: 1px dotted #dcdcdc;border-top: 2px solid #1c75bc;width: 100%;margin: -1px auto;">
											<span class="codetnved-span">'.$code_row['description_code'].'</span>
									</div>
								</div>';
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require_once('footer.php'); ?>
</body>
</html>
