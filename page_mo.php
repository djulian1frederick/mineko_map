<?php session_start();?>
<?php 
	#подключение к бд
		require_once('admin/connection.php');
		#полученый номер района с карты
		$id = $_GET['id'];
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Страница мунициапальное образование</title>
	<link rel="stylesheet" href="css/index.css">
	<link rel="stylesheet" href="css/page-mo.css">
</head>
<body>
<?php include 'header.php'; ?>
<div class="container">
	<div class="content">
	<?php 
		if ($id < 43) {

		#запрос на выборку фио руководителя, герб, название МО, контактной информации
		$sql_info_mo = "SELECT * from mo join raions join rukovoditeli join contacts where mo.id_raion = raions.id_raion and rukovoditeli.id_contact = contacts.id_contact and mo.id_rukovod = rukovoditeli.id_rukovoditel and mo.id_raion='".$id."' and raions.id_raion='".$id."'";
		
		$result_info_mo = mysqli_query($bd, $sql_info_mo);
		#если запрос выполнился
		if($result_info_mo){
			#создать массив с данными из БД
			$row_info_mo = mysqli_fetch_array($result_info_mo);
			
			#название района и герб
			$raion_name = $row_info_mo['raion'];
			$herb_href = $row_info_mo['herb'];
		
			do {
				echo '<div class="info_mo">
						<div class="blockinfo">
								<div class="column-con">
								<div class="rukovoditel">
									<div style="text-align: center; margin: auto;">
									<img src="'.$row_info_mo['img_href'].'" alt="Фотография руководителя МО"></div>
									<h2>Руководитель:</h2>'; 
								
								$post_choose_sql = "SELECT name_post from posts where id_post='".$row_info_mo['id_post']."'";
								$post_choose = mysqli_query($bd, $post_choose_sql);
								$post_choose_row = mysqli_fetch_array($post_choose);
								$post_rukovoditel = $post_choose_row['name_post'];
								if($post_rukovoditel <> NULL) {
									echo '<h2><i><u>'.$post_rukovoditel.'</u></i></h2>';
								}
								echo'<h2>'.$row_info_mo['second_name'].' '.$row_info_mo['first_name'].' '.$row_info_mo['last_name'].'</h2>';
									if($row_info_mo['phone1'] <> NULL || $row_info_mo['email'] <> NULL && isset($_SESSION['level']) && $_SESSION['level'] >= '1'){
									echo '<div class="contacts-block">';
									if($row_info_mo['phone1'] <> NULL){echo'<p><img src="img/phone-call.png" style="width: 20px; height: 20px; border: none; margin: -5px 0; padding: 0 5px;">'.$row_info_mo['phone1'].'</p>';}
									if($row_info_mo['email'] <> NULL){echo'<p><img src="img/email.png" style="width: 20px; height: 20px; padding: 0 5px; border: none; margin: -6px 0;"><a href="mailto:'.$row_info_mo['email'].'">'.$row_info_mo['email'].'</a></p>';}
									echo '</div>';}
							echo	'</div>
								';
						#ответственный за экспорт 
						$sql = "SELECT second_name_resp, last_name_resp, first_name_resp, name_post, id_contact from responsiblies join posts on posts.id_post = responsiblies.id_post where responsiblies.id_mo='".$row_info_mo['id_mo']."'";
						$sql_responsible = mysqli_query($bd, $sql);
						$responsiblies_row = mysqli_fetch_array($sql_responsible);
						
						if ($responsiblies_row <> NULL) {
							
							$contact_respons_sql = "SELECT * from contacts where id_contact='".$responsiblies_row['id_contact']."'";
							$contact_respons = mysqli_query($bd, $contact_respons_sql);
							$contact_respons_row = mysqli_fetch_array($contact_respons);
							echo '<div class="responsiblie-row">
								<h2>Ответственный за экспорт в МО:</h2>';
							do {
								echo'
								<h2>'.$responsiblies_row['second_name_resp'].' '.$responsiblies_row['first_name_resp'].' '.$responsiblies_row['last_name_resp'].'</h2>
								<h2 class="post-name">'.$responsiblies_row['name_post'].'</h2>';
								if($contact_respons_row <> NULL && isset($_SESSION['level']) && $_SESSION['level'] >= '1') {
								echo '<div class="contacts-block"><p><img src="img/phone-call.png" style="width: 20px; height: 20px; border: none; margin: -5px 0; padding: 0 5px;">'.$contact_respons_row['phone1'].'</p>
									<p><img src="img/email.png" style="width: 20px; height: 20px; padding: 0 5px; border: none; margin: -6px 0;"><a href="mailto:'.$contact_respons_row['email'].'">'.$contact_respons_row['email'].'</a></p></div>';}
								
							}while($responsiblies_row = mysqli_fetch_array($sql_responsible));
						echo '</div>
								';}
						echo '</div></div>
					';
			}while($row_info_mo=mysqli_fetch_array($result_info_mo));
		} 
			$id_mo_sql = "SELECT id_mo from mo where id_raion='".$id."'";
	  				$id_mo_query= mysqli_query($bd, $id_mo_sql);
	  				$id_mo_list =  mysqli_fetch_array($id_mo_query);
	  				$id_mo = $id_mo_list['id_mo'];
			$sql = "SELECT count(*) from predpriyatiya where id_mo='".$id_mo."'";
					$select_count=mysqli_query($bd,$sql);
					$count = mysqli_fetch_array($select_count);
		echo '<div class="blockinfo">
			<div class="blockherb">
				<div style="text-align: center; margin: auto;">
					<img class="mini-img" src="mo/'.$herb_href.'" alt="Герб">
				</div>
				<h3>'.$raion_name.'</h3>
			</div>';
	?>
		
	  			<?php
	  				
					$sql = "SELECT * from predpriyatiya where id_mo='".$id_mo."'";
					$select_predpriyatiya=mysqli_query($bd,$sql);
					$list_predpr = mysqli_fetch_array($select_predpriyatiya);
						if($list_predpr <> NULL) {
							echo '<span class="expo_count">Количество экспортеров: '.$count['count(*)'].'</span>
							<h3 style="text-align: left;">Список организаций в МО</h3>
							<ol class="rectangle">';	
							do {
								echo '<li><a href="organization?id='.$list_predpr['id_predpriyatiya'].'">'.$list_predpr['name'].'</a></li>';
							} while($list_predpr=mysqli_fetch_array($select_predpriyatiya));
						}
					echo '</ol>
							</div>
							</div>';
					}
					else {
						include('404.php');
					}
				?>
			
	</div>
</div>
<?php require_once('footer.php'); ?>
</body>
</html>
