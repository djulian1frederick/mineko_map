<?php 
	$level = intval($_SESSION['level']);
	switch($level) {
	case 0:
		$pages = '<a href="status_check"><li>Отслеживание изменения статуса регистрации организации</li></a>';
		break;
	case 1:
		$pages = '<a href="organization_updating"><li>Личный кабинет организации</li></a>';
		break;
	case 2:
		$pages = '<a href="my_cabinet"><li>Личный кабинет</li></a>
		<a href="muno"><li>Муниципальные образования</li></a>
		<a href="organization"><li>Организации</li></a>';
		break;
	case 3:
		$pages = '<a href="muno"><li>Муниципальные образования</li></a>
			<a href="organization"><li>Организации</li></a>
			<a href="production_add"><li>Продукция</li></a>
			<a href="export_catalog"><li>Экспортный каталог</li></a>
			<a href="history_success"><li>Истории успеха</li></a>
			<a href="search"><li>Поиск</li></a>
			<a href="users"><li>Пользователи системы</li></a>
			<a href="status_check"><li>Отслеживание изменения статуса регистрации организации</li></a>
			<a href="organization_updating"><li>Личный кабинет организации</li></a>';
		break;
	default:
		break;	
	}
?>
<link rel="shortcut icon" href="../img/economy.ico" type="image/x-icon"> 
<script type="text/javascript" src="../js/functions.js"></script>

		<div class="container">
		<ul class="nice_navigation">
			<a href="../index"><li>Главная страница</li></a>
			<a href="my_cabinet"><li>Личный кабинет</li></a>
			<?php echo $pages; ?>
			<a href="#" onclick="show_popup()"><li>Выход</li></a>
		</ul>
		</div>
<div id="popup" style="display: none;">
	<div class="back">
		
	</div>
	<div class="popup">
		<div style="height: 60px;">
			<p style="color: #7b6f6f;">Вы уверены, что хотите выйти?</p>
		</div>
		<div style="display: flex; flex-flow: row;">
			<div class="popup-yes" onclick="yes_i_do()">
				<p>да</p>
			</div>
			<div class="popup-no" onclick="abort_operation()">
				<p>нет</p>
			</div>
		</div>
	</div>
</div>

