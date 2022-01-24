<?php 
	$id = $_GET['id'];
		require_once('admin/connection.php');
		$sql_info_org = "SELECT * from predpriyatiya where id_predpriyatiya='".$id."'";
		$this_org = mysqli_query($bd, $sql_info_org);
		$org_row = mysqli_fetch_array($this_org);
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Организация <?php echo $org_row['name'];?></title>
	<link rel="stylesheet" href="css/index.css">
</head>
<body>
<?php include 'header.php'; ?>
<div class="container"><div class="content">
	<?php 
		#подключение к бд
		#полученый номер района с карты
		do {
		$size_sql = mysqli_query($bd, "SELECT name_size from size_predpr where id_size='".$org_row['id_size']."'");
		$size_predpr = mysqli_fetch_array($size_sql);
		$size = $size_predpr['name_size'];

		$raion_sql = mysqli_query($bd, "SELECT raion from raions join mo where raions.id_raion=mo.id_raion and mo.id_mo='".$org_row['id_mo']."'");
		$raion_predpr = mysqli_fetch_array($raion_sql);
		$raion = $raion_predpr['raion'];

		$code_sql = mysqli_query($bd, "SELECT code from code_product where id_code_product='".$org_row['id_code_product']."'");
		$code_predp = mysqli_fetch_array($code_sql);
		$code = $code_predp['code'];

		$address_sql = mysqli_query($bd, "SELECT full_address from addresses where id_addr='".$org_row['id_address']."'");
		$address_predp = mysqli_fetch_array($address_sql);
		$address = $address_predp['full_address'];

		$rukovod_sql = mysqli_query($bd, "SELECT * from rukovoditeli where id_rukovoditel='".$org_row['id_rukovoditel']."'");
		$rukovod_predpr= mysqli_fetch_array($rukovod_sql);
		if ($rukovod_predpr <> NULL)	{$rukovoditel = ''.$rukovod_predpr['second_name'].' '.$rukovod_predpr['first_name'].' '.$rukovod_predpr['last_name'];}
		
		$vid_sql = mysqli_query($bd, "SELECT vid_deyatelnosti from vid_deyat where id_vid_deyat='".$org_row['id_vid_deyat']."'");
		$vid_predpr = mysqli_fetch_array($vid_sql);
		$vid = $vid_predpr['vid_deyatelnosti'];

		$contact_sql = mysqli_query($bd, "SELECT * from contacts where id_contact='".$org_row['id_contact']."'");
		$contact = mysqli_fetch_array($contact_sql);

		echo '<div class="block_organization">
				<div>
					<div class="organization_info_logo">
						<div>
							<img src="/'.$org_row['logo'].'" style="height: 100px; margin: 5px auto;">
						</div>
					<a href="organization.php?id='.$org_row['id_predpriyatiya'].'"><h2>'.$org_row['name'].'</h2></a>
					<li style="display: none;">'.$org_row['name'].'</li>
					<h4>'.$size.'</h4>
		</div>';

		if(isset($code) && $code <> NULL) {echo '<span style="text-align: center;
		font-size: 18px; margin: auto;"><p><b>ОКВЭД</b> '.$code.'</p></span>';}
		echo '<div style="width: 80%; margin: 0 10%; border-bottom: 1px solid #dcdcdc;">
			<div class="info_about" style="display: block ruby;">';
		echo '<span><b>ИНН</b> <p>'.$org_row['inn'].'</p></span>';
		echo '<span><b>ОГРН</b> <p>'.$org_row['ogrn'].'</p></span>';
		if(isset($org_row['code_tn_ved']) && $org_row['code_tn_ved'] <> NULL) {echo '<span><b>Код ТН ВЭД</b> <p>'.$org_row['code_tn_ved'].'</p></span>';}
		
		echo '</div></div>';

		echo '<div class="main-info-organization">';
				if (isset($org_row['yearstart']) && $org_row['yearstart'] <> NULL) {echo '<div class="block-with-image">
					<img src="img/calendar.png" class="organization_info_logo_img">
					<p>'.$org_row['yearstart'].'</p></div>';}
				echo '<div class="block-with-image">
					<img src="img/location.png" class="organization_info_logo_img">';
					echo '<p>'.$raion.'</p>';
				echo '</div>
				<div class="block-with-image">
					<img src="img/team.png">';
					if(isset($vid) && $vid <> NULL) {echo '<p>'.$vid.'</p>';}
				echo '</div>
				</div>
			</div>';
				
		echo '<div class="main-info-organization" style="width: 75%; margin-left: 25%;">';
					if(isset($address) && $address<>NULL) { echo '<div class="block-with-image">
						<img src="img/address.png">
						<p>'.$address.'</p>
					</div>';}
		if(isset($contact) && $contact <> NULL) {
			if ($contact['phone1'] <> NULL) 
					{echo '<div class="block-with-image">
						<img src="img/phone1.png">
						<p>'.$contact['phone1'].'</p>
					</div>';}
			if ($contact['email'] <> NULL) {
					echo '<div class="block-with-image">
						<img src="img/email1.png">
						<p>'.$contact['email'].'</p>
					</div>';}
			}

		if(isset($rukovoditel) && $rukovoditel <> NULL) { echo '<div class="block-with-image">
						<img src="img/manager.png">
						<p>Руководитель '.$rukovoditel.'</p>
					</div>
				</div>';}

		}
		while($org_row = mysqli_fetch_array($this_org));			
	
		$gallery_result = mysqli_query($bd, "SELECT * from proizvodstva where id_predpriyatiya='".$id."'");
		$gallrery = mysqli_fetch_array($gallery_result); 
					if($gallrery <> NULL) {
					echo '<div class="down-right">
						<h5>Производство</h5>
						<ul>';
					do {
					echo '<li><img  width="150px" src="/'.$gallrery['img_proizv'].'" title="Фотография производства"></li>';
					}while($gallrery = mysqli_fetch_array($gallery_result));
					echo '</ul></div>'; }
				
					$select_production = "SELECT * from production where id_predpriyatia='".$id."'";
						$production = mysqli_query($bd, $select_production);
						$production_row = mysqli_fetch_array($production);
					if ($production_row <> NULL) {
					echo'<div class="down-right">
						<h5>Продукция</h5>
						<ul>
						';
						
						do {
							echo '<li style="height: 200px; border: 1px solid #dcdcdc; margin: 0 5px;">
							<h6>'.$production_row['name_production'].'</h6>
							<img  width="150px" src="'.$production_row['image_href'].'" alt="'.$production_row['name_production'].'" title="'.$production_row['name_production'].'">
							<p class="descriptions">'.$production_row['description'].'</p>
							</li>';
						} while ($production_row = mysqli_fetch_array($production));
							echo '
					</div>';		
				}
			?>		
		<?php
			$export_select = "SELECT * from country join exports on exports.id_country=country.id_country and exports.id_predpriyatiya='".$id."'";
			$export_sql = mysqli_query($bd, $export_select);
			$export_r = mysqli_fetch_array($export_sql);
			if ($export_r <> NULL) {
				echo '<div class="down-right">
							<h5>Экспортные рынки</h5>
							<ul class="export_list">';
				do {
								echo '<li>'.$export_r['name_country'].'</li>';
								
				}while ($export_r=mysqli_fetch_array($export_sql));
			echo '</ul>
					</div>
					</div>';
			}

		?>
		<?php
			$export_serv_select = "SELECT * from expoc_services where id_predpriyatiya='".$id."'";
			$export_serv_sql = mysqli_query($bd, $export_serv_select);
			$export_serv_r = mysqli_fetch_array($export_serv_sql);
			if ($export_serv_r <> NULL) {
				echo '<div class="down-right">
							<h5>Услуги, полученные от Центра поддержки экспорта</h5>
							<ul class="export_list">';
				do {
								echo '<li>'.$export_serv_r['name_service'].'</li>';
								
				}while ($export_serv_r=mysqli_fetch_array($export_serv_sql));
			echo '</ul>
					</div>
					</div>';
			}

		?>
	</div>
</div>
</body>
</html>