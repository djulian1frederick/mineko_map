<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Мунициапальное образование ""</title>
	<link rel="stylesheet" href="css/index.css">
</head>
<body>
<?php include 'header.php'; ?>
<div class="container">
	<div class="content">
	<?php 
		#подключение к бд
		require_once('admin/connection.php');
		#полученый номер района с карты
		$id = $_GET['id'];
		if ($id < 43) {

		#запрос на выборку фио руководителя, герб, название МО, контактной информации
		$sql_info_mo = "SELECT * from mo join raions  join rukovoditeli join contacts where mo.id_raion = raions.id_raion and rukovoditeli.id_contact = contacts.id_contact and mo.id_rukovod = rukovoditeli.id_rukovoditel and mo.id_raion='".$id."' and raions.id_raion='".$id."'";
		

		// join contactsrukovoditeli.id_contact = contacts.id_contact 

		$result_info_mo = mysqli_query($bd, $sql_info_mo);
		#если запрос выполнился
		if($result_info_mo){
			#создать массив с данными из БД
			$row_info_mo = mysqli_fetch_array($result_info_mo);
			do {
				echo '<div class="info_mo">
						<div class="blockinfo" style="display: flex;">
								<div class="rukovoditel">
									<img src="'.$row_info_mo['img_href'].'" alt="">
									<h2>Руководитель:</h2> <h2>'.$row_info_mo['second_name'].' '.$row_info_mo['first_name'].' '.$row_info_mo['last_name'].'</h2>
								
									<div style="margin-top: 10px;padding: 5px;background: #fbfbfb;"><p><img src="img/phone-call.png" style="width: 20px; height: 20px; border: none; margin: -5px 0; padding: 0 5px;">'.$row_info_mo['phone1'].'</p>
									<p><img src="img/email.png" style="width: 20px; height: 20px; padding: 0 5px; border: none; margin: -6px 0;"><a href="mailto:'.$row_info_mo['email'].'">'.$row_info_mo['email'].'</a></p>
									</div>
								</div>
								<div class="blockherb"><img class="mini-img" src="mo/'.$row_info_mo['herb'].'" alt="Герб">
								<h3>'.$row_info_mo['raion'].'</h3>
								</div>
						</div>
					';
			}while($row_info_mo=mysqli_fetch_array($result_info_mo));
		} 
		echo '<div class="blockinfo" style="min-width: 60%; max-width: 100%;">
			<h3 style="font-size: 18px;">Предприятия:</h3>
			<ol class="rectangle">';
	?>
		
	  			<?php
	  				$id_mo_sql = "SELECT id_mo from mo where id_raion='".$id."'";
	  				$id_mo_query= mysqli_query($bd, $id_mo_sql);
	  				$id_mo_list =  mysqli_fetch_array($id_mo_query);
	  				$id_mo = $id_mo_list['id_mo'];
					$sql = "SELECT * from predpriyatiya where id_mo='".$id_mo."'";
					$select_predpriyatiya=mysqli_query($bd,$sql);
					$list_predpr = mysqli_fetch_array($select_predpriyatiya);
						if($list_predpr <> NULL) {
							do {
								echo '<li><a href="organization.php?id='.$list_predpr['id_predpriyatiya'].'">'.$list_predpr['name'].'</a></li>';
							} while($list_predpr=mysqli_fetch_array($select_predpriyatiya));
						}
					echo '</ol>
							</div>
							</div>';
					}
					else {
						include('404.html');
					}
				?>
			
	</div>
</div>
</body>
</html>
