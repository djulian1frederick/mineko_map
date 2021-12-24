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

		$site = $org_row['site'];

		$gallery_select = "SELECT * from proizvodstva where id_predpriyatiya='".$id."'";
		$gallery_result = mysqli_query($bd, $gallery_select);

		echo '<div class="block_organization">
					<div class="main_organization">
					<img src="/'.$org_row['logo'].'">
					<h2>'.$org_row['name'].'</h2>'; 
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
						<table style="width: 100%;">';
							if(isset($rukovoditel) && $rukovoditel <> NULL) { echo '<tr><td>Руководитель</td><td>'.$rukovoditel.'</td></tr>';}
							if(isset($address) && $address<>NULL) { echo '<tr><td>Адрес</td><td>'.$address.'</td></tr>';}
							if(isset($contact) && $contact <> NULL) {echo '<tr><td>Контакты</td><td>тел. '.$contact['phone1'].', email: '.$contact['email'].'</td></tr>';}
							if (isset($site) && $site<> NULL) {
								echo "<tr><td>Сайт</td><td><a href='".$site."'>".$site."</a></td></tr>";
							}
					
					echo '</table>
					</div>
					
				</div>';
				$gallrery = mysqli_fetch_array($gallery_result); 
					if($gallrery <> NULL) {
					echo '<div class="down-right">
						<h5>Производство</h5>
						<ul>';
					do {
					echo '<li><img  width="150px" src="/'.$gallrery['img_proizv'].'" title="Фотография производства"></li>';
					}while($gallrery = mysqli_fetch_array($gallery_result));
					echo '</ul></div>'; }
				
					$select_production = "SELECT name_production, image_href from production where id_predpriyatia='".$id."'";
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
							</li>';
						} while ($production_row = mysqli_fetch_array($production));
							echo '
					</div>';		}

?>		
		<?php
			$export_select = "SELECT * from country join exports where exports.id_country=country.id_country and exports.id_predpriyatiya='".$id."'";
			$export_sql = mysqli_query($bd, $export_select);
			$export_r = mysqli_fetch_array($export_sql);
			if ($export_r <> NULL) {echo '<div class="down-right">
							<h5>Экспортные рынки</h5>
							<ul class="export_list">';
			do {
							echo '<li>'.$export_r['name_country'].'</li>';
							
			}while ($export_r=mysqli_fetch_array($export_sql));
			echo '</ul>
					</div>';
		}

		?>
	</div>
</div>
</body>
</html>