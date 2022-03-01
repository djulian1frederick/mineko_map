

<?php require_once("connection.php");?>
	<?php 	
		$org = $_POST['org'];
		$style='';
		if($_SESSION['level'] == '1') {
			$userid = $_SESSION['user_id'];
			$sql = "SELECT id_predpriyatiya from contacts_people join predpriyatiya on predpriyatiya.id_con_people=contacts_people.id_con_people where contacts_people.id_user='".$userid."'";
			$query = mysqli_query($bd, $sql);
			$id_predpriyatiya = mysqli_fetch_array($query);
			$id_predpriyatiya = $id_predpriyatiya['id_predpriyatiya'];
			$org = $id_predpriyatiya;
			$style='style="width: 90%; margin: 0.5% auto;"';}
			echo '<div class="blockinfo" '.$style.'>';
			echo '<input type="hidden" id="org_ident" value="'.$org.'">';
	
	?>

		<div style="margin: auto; text-align: center; border-bottom: 2px solid #0e0e73;">
			<ul class="navigation-horizontal">
				<li  onclick="open_menu('info_upd_organization')">Основная информация об организации</li>
				<li onclick="open_menu('rukovoditeli')">Руководители организаций</li>
				<li onclick="open_menu('contacts')">Контакты</li>
				<li onclick="open_menu('addresses')">Адрес</li>
				<li onclick="open_menu('attach')">Дополнительно</li>
				<li onclick="open_menu('exports')">Экспортный рынок</li>
				<li onclick="open_menu('production')">Продукция</li>
				<li onclick="open_menu('facilities')">Производство</li>
			</ul>
		</div>
		<div id="updateinfo" style="width: 50%;margin: 0 25%;text-align: center;"></div>
		<div id="position_result" style="width: 90%;margin: auto;"></div>
</div>
			


