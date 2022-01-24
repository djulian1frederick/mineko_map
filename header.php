<?php 


?>
<script type="text/javascript" src="js/search.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div style="width: 90%; margin: 0 5%; display: inline-flex; flex-wrap: wrap;">
	<ul class="nice_navigation">
		<a href="index.php"><li>Главная страница</li></a>
		<a href="rate.php"><li>Рейтинги</li></a>
		<a href="achievments.php"><li>Достижения</li></a>
		<a href="analyze.php"><li>Анализ показателей</li></a>
		<a href="all_catalog.php"><li>Экспортный каталог</li></a>
		<li style="display: inline-flex; width: 270px; position: relative;">
			<input type="text" name="searchinput" id="searchinput" onchange="search()">
			<div id="search_result" style="text-align: center;position: absolute;background: #1c75bc5c;top: 50px;width: 270px;margin: 0;padding: 0; z-index: 5555; height: 300pxs;overflow-y: scroll; display: none;">

			</div>
			<button type="submit" onclick="search()">
				<img src="img/search.png">
			</button>

		</li>
		<a href="auth.php" style="position: relative; right: 0;"><li>Авторизация в системе</li></a>
	</ul>
</div>

