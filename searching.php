<?php session_start();?>
<?php require_once('admin/connection.php'); ?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<title>Подробный поиск</title>
	<link rel="stylesheet" href="css/index.css">
	<link rel="stylesheet" href="css/search.css">
	<script type="text/javascript" src="/js/func.js"></script>
</head>
<body>
<?php include 'header.php'; ?>
<div class="container">
	<div class="content">
		<div class="forma">
			<form id="search_all" method="GET">
				<div class="block-inline">
					<div style="display: inline-flex; width: 80%;">
						<input type="text" name="searchinput" id="searchinp" minlength="3" placeholder="Введите не менее 3 символов для начала поиска" <?php  if(isset($_GET['searchinput'])) { echo 'value="'.$_GET['searchinput'].'"';} ?>>
						<button id="searchbut" type="submit"><img src="img/search.png" width="26px"></button>
					</div>
				</div>
				<div class="align-center">
					<input type="radio" value="1" name="param" <?php  if(isset($_GET['param']) && $_GET['param']=='1') { echo 'checked';} ?>><label>Код ТН ВЭД</label>
					<input type="radio" value="2"  name="param" <?php  if(isset($_GET['param']) && $_GET['param']=='2') { echo 'checked';} ?>><label>Район</label>
					<input type="radio" value="3"  name="param" <?php  if(isset($_GET['param']) && $_GET['param']=='3') { echo 'checked';} ?>><label>ИНН</label>
					<button onclick="reset_radio()" style="margin-left: 25px;">Сбросить фильтры</button>
				</div>
			</form>
		
		<div id="search_result">
			<?php 
				$string_search = $_GET['searchinput'];
				$check = $_GET['param'];

				if($string_search <> NULL ) {
					echo '<span class="ressearch">Результаты поиска:</span>
						<ol class="ololo">';
						if(!isset($check)){
						$sql_query = "SELECT id_predpriyatiya, name from predpriyatiya where name LIKE '%$string_search%' group by name";	
						$result = mysqli_query($bd, $sql_query);
						$row_result_organizaton = mysqli_fetch_array($result);
						if($row_result_organizaton <> NULL) { 
						do {
							echo 
								'<li>
									<a href="organization?id='.$row_result_organizaton['id_predpriyatiya'].'">'.$row_result_organizaton['name'].'</a>
								</li>';
						}while($row_result_organizaton = mysqli_fetch_array($result));}

						
						$query_production = "SELECT name_production, id_product from production where name_production LIKE '%$string_search%' group by name_production";
						$result_production = mysqli_query($bd, $query_production);
						$row_result_production = mysqli_fetch_array($result_production);	
						if($row_result_production <> NULL){
						do {	
							echo 
								'<li>
									<a href="production?id='.$row_result_production['id_product'].'">'.$row_result_production['name_production'].'</a>
								</li>';
						}while($row_result_production = mysqli_fetch_array($result_production));}
					}
					
					if(isset($check) && $check=='1') {
						$query_code = "SELECT predpriyatiya.id_predpriyatiya, name, code_tn_ved from predpriyatiya join code_tn_veds on code_tn_veds.id_predpriyatiya=predpriyatiya.id_predpriyatiya where code_tn_ved LIKE '%$string_search%' group by name";
						$result_code_tn_ved = mysqli_query($bd, $query_code);
						$row_result_code = mysqli_fetch_array($result_code_tn_ved);
						if($row_result_code <> NULL){
						do {
							echo 
								'<li>
									<a href="organization?id='.$row_result_code['id_predpriyatiya'].'">'.$row_result_code['name'].'</a>
								</li>';
						}while($row_result_code = mysqli_fetch_array($result_code_tn_ved));}
					}
					
					if(isset($check) && $check=='2') {
						$query_raion = "SELECT id_predpriyatiya, name, raion, predpriyatiya.id_mo, raions.id_raion from predpriyatiya join mo on mo.id_mo=predpriyatiya.id_mo join raions on mo.id_raion=raions.id_raion where raion LIKE '%$string_search%' group by name";
						$result_raion = mysqli_query($bd, $query_raion);
						$row_result_raion = mysqli_fetch_array($result_raion);
						if($row_result_raion <> NULL) {
						do {
							echo 
								'<li>
									<a href="organization?id='.$row_result_raion['id_predpriyatiya'].'">'.$row_result_raion['name'].' ('.$row_result_raion['raion'].')</a>
								</li>';
						}while($row_result_raion = mysqli_fetch_array($result_raion));}
					}
					
					if(isset($check) && $check=='3') {
						$query_inn = "SELECT id_predpriyatiya, name, inn from predpriyatiya where inn LIKE '%$string_search%' group by name";
						$result_query_inn = mysqli_query($bd, $query_inn);
						$row_result_inn = mysqli_fetch_array($result_query_inn);
						if($row_result_inn <> NULL) {
						do {
							echo 
								'<li>
									<a href="organization?id='.$row_result_inn['id_predpriyatiya'].'">'.$row_result_inn['name'].'</a>
								</li>';
						}while($row_result_inn = mysqli_fetch_array($result_query_inn));}
					}
					echo '</ol>';
				}
			?>
			</div>
		</div>
	</div>
</div>
<?php require_once('footer.php'); ?>
</body>
</html>