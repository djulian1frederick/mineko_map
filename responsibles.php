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
	
	<title>Ответственные за экспорт</title>
	<link rel="stylesheet" href="css/index.css">
</head>
<body>
<?php include 'header.php'; ?>
<div class="container">
	<div class="content">
		<ul class="contacts-exports">
			<span style="display: block; font-size: 22px; text-align: center;font-weight: bold; text-decoration: underline; margin-bottom: 20px;">Ответственные за экспорт в Оренбургской области</span>
			<li>
				<table>
					<tr><th colspan="2">Министерство экономического развития, инвестиций, туризма и внешних связей Оренбургской области</th></tr>
					<tr>
						<td>Юридический адрес</td>
						<td>460015, Оренбург, Дом Советов</td>
					</tr>
					<tr>
						<td>Почтовый адрес</td>
						<td>460015, Оренбург, Дом Советов</td>
					</tr>
					<tr>
						<td>Телефон приемной</td>
						<td>+7 (3532) 78-60-19</td>
					</tr>
					<tr>
						<td>Прочие контакты</td>
						<td>
							<a href="https://mineconomy.orb.ru/upload/uf/22c/SPRAVOCHNIK_20_21.pdf">Телефоны сотрудников</a><br>
							Для сми: +7 (3532) 78-66-13<br>
							Телеграм: @mineconomyorb
						</td>
					</tr>
					<tr>
						<td>Факс</td>
						<td>+7 (3532) 77-68-24</td>
					</tr>
					<tr>
						<td>Email</td>
						<td><a href="mailto:office22@mail.orb.ru">office22@mail.orb.ru</a></td>
					</tr>
				</table>
				
			</li>
			<li>
				<table>
					<tr>
						<th colspan="2">Министерство сельского хозяйства, торговли, пищевой и перерабатывающей промышленности Оренбургской области</th>
					</tr>
					<tr>
						<td>Юридический адрес</td>
						<td>460046, г.Оренбург, ул. 9 Января, 64</td>
					</tr>
					<tr>
						<td>Почтовый адрес</td>
						<td>460046, г.Оренбург, ул. 9 Января, 64</td>
					</tr>
					<tr>
						<td>Телефон приемной</td>
						<td>+7 (353)278-64-34</td>
					</tr>
					<tr>
						<td>Телефон канцелярии</td>
						<td>+7(353)277-55-74</td>
					</tr>
					<tr>
						<td>Факс</td>
						<td>+7(353)277-49-47</td>
					</tr>
					<tr>
						<td>Email</td>
						<td><a href="mailto:office03@mail.orb.ru">office03@mail.orb.ru</a></td>
					</tr>
				</table>
			</li>
			<li>
			
				<table>
					<tr>
						<th colspan="2">Министерство промышленности и энергетики Оренбургской области</th>
					</tr>
					<tr>
						<td>Юридический адрес</td>
						<td>460016, Оренбургская область, г. Оренбург, ул. 9 Января, 62</td>
					</tr>
					<tr>
						<td>Почтовый адрес</td>
						<td>460040, Оренбургская область, г. Оренбург, ул. 20 Линия, 24</td>
					</tr>
					<tr>
						<td>Телефон приемной</td>
						<td>+7(3532) 32-40-00</td>
					</tr>
					<tr>
						<td>Email</td>
						<td><a href="mailto:office56@mail.orb.ru">office56@mail.orb.ru</a></td>
					</tr>
				</table>
			</li>
		</ul>
	</div>
</div>
<?php require_once('footer.php'); ?>
</body>
</html>

<style>
	.contacts-exports {
		background: #fff;
		margin: 0 auto;
		padding: 2.5%;
	}
	.contacts-exports table tr, .contacts-exports table td {
		border: 1px solid;
		padding: 5px;
		color:  #474873;
	}
	.contacts-exports tr td:nth-child(1){
		width: 30%;
	}
	.contacts-exports tr td:nth-child(2) {
		width: 70%;
	}
</style>