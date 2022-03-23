<?php session_start(); ?>
<link rel="shortcut icon" href="/img/economy.ico" type="image/x-icon">
<meta name='viewport' content='width=device-width,initial-scale=0.7'/>
<meta content='true' name='HandheldFriendly'/>
<meta content='width' name='MobileOptimized'/>
<meta content='yes' name='apple-mobile-web-app-capable'/>
<script type="text/javascript" src="js/search.js"></script>
<script type="text/javascript" src="../js/functions.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div style="width: 90%; margin: 0 5%; display: inline-flex; flex-wrap: wrap; ">
<?php require_once('transliting.php'); ?>
	<ul class="nice_navigation">
		<a href="index"><li>Главная страница</li></a>
		<a href="rate"><li>Рейтинги</li></a>
		<a href="achievments"><li>Истории успеха</li></a>
		<a href="searching"><li>Поиск</li></a>
		<a href="all_catalog"><li>Экспортный каталог</li></a>
		<a href="responsibles"><li>Ответственные за экспорт</li></a>
		<li style="display: inline-flex; width: 270px; position: relative;">
			<input type="text" name="searchinput" id="searchinput" onchange="search()" onfocusout="hide_modal()">
			<div id="search_result" style="text-align: center;position: absolute;background: #1c75bc5c;top: 50px;width: 270px;margin: 0;padding: 0; z-index: 5555; height: 300pxs;overflow-y: scroll; display: none;">

			</div>
			<button type="submit" onclick="search()">
				<img src="img/search.png">
			</button>
		</li>	
		<?php if(!isset($_SESSION['user_id'])) {  echo '<a href="registration" style="position: relative;"><li>Вступить в каталог</li></a>';
												  echo '<a href="login" style="position: relative; right: 0;"><li>Авторизация</li></a>'; } 
		else { echo '<li class="down"><a href="editor/" style="position: relative; right: 0;">Личный кабинет</a>
										<ul class="submenu" id="sub">
												<li><a href="chat">Внутренний чат</a></li>
												<li onclick="show_popup()">выход</li>
												</ul></li>';} ?>	
			
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

<?php 
	require_once('admin/connection.php');

	if(isset($_SESSION['user_id'])){
		$userid = $_SESSION['user_id'];

		$sql_check_unread = mysqli_query($bd,"SELECT count(*) from status_chat where id_receiver='".$userid."'");
		$row_check_unread = mysqli_fetch_array($sql_check_unread);
		$unread_count = $row_check_unread['count(*)'];
		if($unread_count > "0") {
			switch ($unread_count) {
							case '1':
								$count = "непрочитанное сообщение";
								break;
							case $unread_count < 5:
								$count = "непрочитанных сообщения";
								break;	
							default:
								$count = "непрочитанных сообщений";
								break;
						}			
			
			echo '<div class="you-have-unread"><span>У вас есть <a href="chat">'.$unread_count.' '.$count.'</a></span></div>';
		}

	}
?>