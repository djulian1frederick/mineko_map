<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Организации</title>
	<link rel="stylesheet" href="css/index.css">
</head>
<body>
<?php include 'header.php'; ?>
<div class="container">
		<div class="content">
			<input id="search" size="20" placeholder="Начните вводить название" />
			<ul id="search-items">
	<?php 
		#подключение к бд
		require_once('admin/connection.php');
		#полученый номер района с карты
		$sql_info_org = "SELECT * from predpriyatiya";
		$this_org = mysqli_query($bd, $sql_info_org);
		$org_row = mysqli_fetch_array($this_org);
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
						<div class="logoblock">
							<img src="/'.$org_row['logo'].'">
						</div>
					<a href="organization.php?id='.$org_row['id_predpriyatiya'].'"><h2>'.$org_row['name'].'</h2></a>
					<li style="display: none;">'.$org_row['name'].'</li>
					<h4>'.$size.'</h4>
		</div>';


		echo '<div style="width: 80%; margin: 0 10%; border-bottom: 1px solid #dcdcdc;"><div class="info_about">';
		echo '<span><b>ИНН</b> <p>'.$org_row['inn'].'</p></span>';
		echo '<span><b>ОГРН</b> <p>'.$org_row['ogrn'].'</p></span>';
		if(isset($org_row['code_tn_ved']) && $org_row['code_tn_ved'] <> NULL) {echo '<span><b>Код ТН ВЭД</b> <p>'.$org_row['code_tn_ved'].'</p></span>';}
		if(isset($code) && $code <> NULL) {echo '<span><b>ОКВЭД</b> <p>'.$code.'</p></span>';}
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
						<p>Адрес 462353, обл. Оренбургская, г. Новотроицк, ул. Промышленная, 51</p>
					</div>';}
		if(isset($contact) && $contact <> NULL) {echo '<div class="block-with-image">
						<img src="img/phone1.png">
						<p>'.$contact['phone1'].'</p>
					</div>
					<div class="block-with-image">
						<img src="img/email1.png">
						<p>'.$contact['email'].'</p>
					</div>';}

		if(isset($rukovoditel) && $rukovoditel <> NULL) { echo '<div class="block-with-image">
						<img src="img/manager.png">
						<p>Руководитель '.$rukovoditel.'</p>
					</div>
				</div>
			</div>';}

		}
		while($org_row = mysqli_fetch_array($this_org));	
	?>
		</ul></div>
</div>
</body>
</html>