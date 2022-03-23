<?php session_start();
	if(!isset($_SESSION['user_id']) or $_SESSION['user_id'] == NULL) {
		header('Location: ../index');
	}
?>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Кабинет отслеживания статуса заявки</title>
	<link rel="stylesheet" href="../css/index.css">
<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
</head>
<body>
	<?php include('header.php');?>	
	<div class="container">
	<div class="blocks_info">
		<?php 
			$level = intval($_SESSION['level']);
			$id = $_SESSION['user_id'];
			require_once('connection.php');

			if($level == 0){
				$sql = "SELECT first_name_reg, last_name_reg, second_name_reg, inn, name_org, mo, raion, status_check from checking_registration join raions join mo on mo.id_raion = raions.id_raion where id_user='".$id."' and mo=id_mo";

			$query = mysqli_query($bd, $sql);
			$row = mysqli_fetch_array($query);
			if($row <> NULL) {
				if($row['status_check'] == '0') {
					$status = 'Находится на проверке администратором';
				}
				elseif($row['status_check'] == '1') {
					$status = 'Успешно проверена. Войдите в систему снова, чтобы начать работать с данными.';
				}
				elseif($row['status_check'] == '2') {
					$status = 'В заявке на регистрацию организации отказано. Для уточнения причин свяжитесь с администратором';
				}
				echo '<table>
						<th>Вы</th>
						<th>Организация</th>
						<th>Статус</th>
						<tr>
							<td>'.$row['second_name_reg'].' '.$row['first_name_reg'].' '.$row['last_name_reg'].'</td>
							<td> '.$row['name_org'].' <br> ИНН:'.$row['inn'].' <br> местоположение: '.$row['raion'].'</td>
							<td>'.$status.'</td>
						</tr>
					</table>';
			}
		}
		elseif($level == 3) {
			$sql = "SELECT first_name_reg, last_name_reg, second_name_reg, id_user, id_check, inn, name_org, mo, raion, status_check from checking_registration join raions join mo on mo.id_raion = raions.id_raion where status_check='0' group by id_check";

			$query = mysqli_query($bd, $sql);
			$row = mysqli_fetch_array($query);
			if($row <> NULL) {
				echo '<table>
						<th>Пользователь</th>
						<th>Организация</th>
						<th>ИНН</th>
						<th>Действие</th>';
						do {
				echo '
						<tr>
							<td>'.$row['second_name_reg'].' '.$row['first_name_reg'].' '.$row['last_name_reg'].'</td>
							<td> '.$row['name_org'].' <br> местоположение: '.$row['raion'].'</td>
							<td>'.$row['inn'].'</td>
							<td><form action="/editor/scripts/check.php" method="post" target="_blank">
								<input type="hidden" name="checks" value="'.$row['id_check'].'">
								<button type="submit" name="button" value="confirm">Подтвердить регистрацию организации</button>
								<button type="submit" name="button" value="deny">Отклонить регистрацию организации</button>
								</form>
							</td>
						</tr>
					';}
					while($row = mysqli_fetch_array($query));
				echo '</table>';
			}
			else {
				echo '<div style="margin: auto; text-align: center;"><span><center>На текущий момент оставленных заявок на регистрацию нет</center></span></div>';
			}
		}
		?>	
	</div>
</div>
</body>
</html>
<style>
	table {
		width: 100%;
		background: #fff;
	}
	table td,th {
		border: 1px solid black;
		padding: 25px;
		text-align: center;
	}
</style>


