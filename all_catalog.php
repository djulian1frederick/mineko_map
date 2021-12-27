<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Организации</title>
	<link rel="stylesheet" href="css/index.css">
</head>
<body>
<?php include 'header.php'; ?>
<div class="container"><div class="content">
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
					<div class="main_organization">
					<h2><a href="organization.php?id='.$org_row['id_predpriyatiya'].'" style="text-decoration: none; cursor: pointer; color: #fff; font-size: 14px;">'.$org_row['name'].'</a></h2>';
						if (isset($org_row['yearstart']) && $org_row['yearstart'] <> NULL) {echo '<h3>'.$org_row['yearstart'].'</h3>';}
								echo '<h4>'.$raion.' </h4>
								<h3>'.$size.'</h3>
								</div>';
		
		echo '<div class="up-main">
				<div class="up-left">
					<table>';
						if(isset($vid) && $vid <> NULL) {echo '<tr><td>Вид деятельности</td><td>'.$vid.'</td></tr>';}
						echo '<tr><td>ИНН</td><td>'.$org_row['inn'].'</td></tr>
						<tr><td>ОГРН</td><td>'.$org_row['ogrn'].'</td></tr>';
						if(isset($code) && $code <> NULL) {echo '<tr><td>ОКВЭД</td><td>'.$code.'</td></tr>';}
						if(isset($org_row['code_tn_ved']) && $org_row['code_tn_ved'] <> NULL) {echo '<tr><td>Код ТН ВЭД</td><td>'.$org_row['code_tn_ved'].'</td></tr>';}
					echo '</table>
				</div></div>';
		
		echo '<div class="down-main">
					<div class="down-left">
						<table>';
							if(isset($address) && $address<>NULL) { echo '<tr><td>Адрес</td><td>'.$address.'</td></tr>';}
							if(isset($contact) && $contact <> NULL) {echo '<tr><td>Контакты</td><td>тел. '.$contact['phone1'].', email: '.$contact['email'].'</td></tr>';}
							if(isset($rukovoditel) && $rukovoditel <> NULL) { echo '<tr><td>Руководитель</td><td>'.$rukovoditel.'</td></tr>';}
					echo '</table>
					</div>
				</div></div>';	}
				while($org_row = mysqli_fetch_array($this_org));	

?>
		</div>
</div>
</body>
</html>