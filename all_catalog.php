<?php session_start();?>
<?php 
		#подключение к бд
		require_once('admin/connection.php');
		$sql_info_org = "SELECT * from predpriyatiya";
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Общий каталог экспортеров</title>
	<link rel="stylesheet" href="css/index.css">
</head>
<body>
<?php include 'header.php'; ?>
<div class="container">
	<div class="content">
		<?php 
		
		
		// количество записей, выводимых на странице
		$per_page=15;
		// получаем номер страницы
		if (isset($_GET['page'])) $page=($_GET['page']-1); else $page=0;
		// вычисляем первый оператор для LIMIT
		$start=abs($page*$per_page);
		// составляем запрос и выводим записи
		// переменную $start используем, как нумератор записей.
		$q="SELECT * FROM `predpriyatiya` ORDER BY id_predpriyatiya LIMIT $start,$per_page";
		$this_org=mysqli_query($bd,$q);
		while($org_row=mysqli_fetch_array($this_org)) {
		
			$size_sql = mysqli_query($bd, "SELECT name_size from size_predpr where id_size='".$org_row['id_size']."'");
			$size_predpr = mysqli_fetch_array($size_sql);
			$size = $size_predpr['name_size'];

			$raion_sql = mysqli_query($bd, "SELECT raion,raions.id_raion from raions join mo where raions.id_raion=mo.id_raion and mo.id_mo='".$org_row['id_mo']."'");
			$raion_predpr = mysqli_fetch_array($raion_sql);
			$raion = $raion_predpr['raion'];
			$id_raion = $raion_predpr['id_raion'];

			$code_sql = mysqli_query($bd, "SELECT code from code_product where id_code_product='".$org_row['id_code_product']."'");
			$code_predp = mysqli_fetch_array($code_sql);
			$code = $code_predp['code'];

			$address_sql = mysqli_query($bd, "SELECT full_address from addresses where id_addr='".$org_row['id_address']."'");
			$address_predp = mysqli_fetch_array($address_sql);
			$address = $address_predp['full_address'];

			$rukovod_sql = mysqli_query($bd, "SELECT * from rukovoditeli where id_rukovoditel='".$org_row['id_rukovoditel']."'");
			$rukovod_predpr= mysqli_fetch_array($rukovod_sql);
			$rukovoditel = '';
			if ($rukovod_predpr <> NULL || $rukovod_predpr <> '')	{$rukovoditel = ''.$rukovod_predpr['second_name'].' '.$rukovod_predpr['first_name'].' '.$rukovod_predpr['last_name'];}
			else { $rukovoditel == '';}

			$vid_sql = mysqli_query($bd, "SELECT vid_deyatelnosti from vid_deyat where id_vid_deyat='".$org_row['id_vid_deyat']."'");
			$vid_predpr = mysqli_fetch_array($vid_sql);
			$vid = $vid_predpr['vid_deyatelnosti'];

			$contact_sql = mysqli_query($bd, "SELECT * from contacts where id_contact='".$org_row['id_contact']."'");
			$contact = mysqli_fetch_array($contact_sql);


			$code_tn_ved_sql = mysqli_query($bd, "SELECT code_tn_ved, id_predpriyatiya from code_tn_veds where id_predpriyatiya='".$org_row['id_predpriyatiya']."'");
			$code_tn_ved_list = mysqli_fetch_array($code_tn_ved_sql);

			echo '<div class="block_organization">
					<div>
						<div class="organization_info_logo">
							<div>
								<img src="/'.$org_row['logo'].'" style="height: 100px; margin: 5px auto;">
							</div>
						<a href="organization?id='.$org_row['id_predpriyatiya'].'"><h2>'.$org_row['name'].'</h2></a>
						<li style="display: none;">'.$org_row['name'].'</li>
						<h4>'.$size.'</h4>
						</div>';
					if(isset($code) && $code <> NULL) 
						{echo '<span style="text-align: center;font-size: 18px; margin: auto; padding: 2px 7px; word-break: break-all; display: flex; width: 60%;""><p><b>ОКВЭД</b> '.$code.'</p></span>';}
					echo '<div style="width: 80%; margin: 0 10%; text-align: center; border-bottom: 1px solid #dcdcdc;">
							<div class="info_about">';
							echo '<span><b>ИНН</b> <p>'.$org_row['inn'].'</p></span>';
							if($org_row['ogrn'] <> NULL && $org_row['ogrn'] <> '') {echo '<span><b>ОГРН</b> <p>'.$org_row['ogrn'].'</p></span>';}
					echo '</div>';
						if($code_tn_ved_list <> NULL) {
							if (count($code_tn_ved_list) > 1) { $word = "Коды"; } else { $word = "Код";}
							echo '<br><br><h5>'.$word.' ТН ВЭД ЕАЭС</h5><ul class="export_list">';
							do { echo '<li>'.$code_tn_ved_list['code_tn_ved'].'</li>'; }
							while($code_tn_ved_list=mysqli_fetch_array($code_tn_ved_sql)); }
							echo '</ul><br>';
						echo '</div>';
						

			echo '<div class="main-info-organization">';
				if (isset($org_row['yearstart']) && $org_row['yearstart'] <> NULL) {
					echo '<div class="block-with-image">
						<img src="img/calendar.png" class="organization_info_logo_img">
						<p><i style="color: #848484; font-family: Circe ExtraLight; font-style: normal;">Экспортер с</i>
						'.$org_row['yearstart'].'
						<i style="color: #848484; font-family: Circe ExtraLight; font-style: normal;">года</i></p>
						</div>';}
					if(isset($raion) && $raion <> NULL){echo '<div class="block-with-image">
					<img src="img/location.png" class="organization_info_logo_img">';
					echo '<p><a href="page_mo?id='.$id_raion.'">'.$raion.'</a></p>';
				echo '</div>';}
				if(isset($vid) && $vid <> NULL) {
					echo '<div class="block-with-image">
					<img src="img/team.png">';
					echo '<p>'.$vid.'</p></div>';}
				echo '</div>
			</div>';
			echo '<div class="main-info-organization" style="width: 75%; margin-left: 25%;">';
					if(isset($address) && $address<>NULL) { 
						echo '<div class="block-with-image">
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

			if(isset($rukovoditel) && $rukovoditel <> NULL) 
					{ echo '<div class="block-with-image">
								<img src="img/manager.png">
								<p><i>Руководитель:</i> '.$rukovoditel.'</p>
							</div>';}
					
			echo '</div></div>';			
		}
		// дальше выводим ссылки на страницы:
		$q="SELECT count(*) FROM predpriyatiya";
		$res=mysqli_query($bd,$q);
		$row=mysqli_fetch_row($res);
		$total_rows=$row[0];

		$num_pages=ceil($total_rows/$per_page);
		echo '<div class="pagination-block">';
		for($i=1;$i<=$num_pages;$i++) {
		  if ($i-1 == $page) {
		    echo $i." ";
		  } else {
		    echo '<a href="all_catalog?page='.$i.'">'.$i."</a>";
		  }
		}
		echo '</div>';
		?>
	</div>
</div>
</body>
</html>
