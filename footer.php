<?php session_start(); ?>
<div class="prefooter">
	<div class="footer">
		<div class="row-start">
			<div class="logo_footer">
				<img src="/img/footer-logo.png" alt="Логотип">
			</div>
		</div>
			<div class="row_footer">
				<span>Контакты</a></span>
				<div style="margin-top: 15px;"><a href="http://orbexport.ru/">Центр поддержки экспорта Оренбургской области</a></div>
				<div><a href="https://mb-orb.ru/support/po-categoriyam/tsentr-podderzhki-predprinimatelstva/">Центр поддержки предпринимательства Оренбургской области</a></div>
				<div><a href="www.orenmfc.ru/site/mfc-dlya-biznesa/mfc-dlya-biznesa-v-g.-orenburge1/mfc-dlya-biznesa-v-g.-orenburge.html">МФЦ для бизнеса</a></div>
				<div><a href="">обратная связь</a></div>
			</div>
			<div class="row_footer">
				<span>Организации</span>
				<div style="margin-top: 15px;"><a href="index">Карта Оренбургской области</a></div>
				<div><a href="all_catalog">Экспортный каталог (все организации)</a></div>
				<div><a href="rate">Рейтинг организаций</a></div>
				<div><a href="searching">Поиск</a></div><br><br>
				<span>Продукция</span>
				<div style="margin-top: 15px;"><a href="searching">Поиск</a></div>
			</div>
			<div class="row_footer">
				<span>Личный кабинет</span>
				<?php if(!isset($_SESSION['user_id'])) {  echo '<div style="margin-top: 15px;"><a href="registration">Вступить в каталог</a></div>';
				echo '<div><a href="login">Авторизация</a></div>'; } 
				else { echo '<div style="margin-top: 15px;"><a href="/editor/my_cabinet">Перейти в кабинет</a></div>
						<div onclick="show_popup()" style="text-decoration: underline; cursor: pointer;">Выход</div>';} ?>
				<div><a href="privacy">Политика конфиденциальности</a></div>
				<div style="margin-top: 45px;"><script src="https://yastatic.net/share2/share.js"></script>
				<div class="ya-share2" data-curtain data-shape="round" data-color-scheme="whiteblack" data-limit="3" data-services="vkontakte,odnoklassniki,telegram,viber,whatsapp,skype,tumblr,evernote,linkedin"></div></div>
		</div>
		<div class="spoiler">
			<details>
				<summary>Использованные в проекте изображения, плагины</summary>
				<div>Icons made by <a href="https://www.flaticon.com/authors/creaticca-creative-agency" title="Creaticca Creative Agency">Creaticca Creative Agency</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div><div>Icons made by <a href="https://www.flaticon.com/authors/dinosoftlabs" title="DinosoftLabs">DinosoftLabs</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div><div>Icons made by <a href="https://www.freepik.com" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div><div>Icons made by <a href="https://www.flaticon.com/authors/becris" title="Becris">Becris</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div><div>Icons made by <a href="https://www.flaticon.com/authors/eucalyp" title="Eucalyp">Eucalyp</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div><div>Icons made by <a href="https://www.flaticon.com/authors/pixel-perfect" title="Pixel perfect">Pixel perfect</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div><div>Icons made by <a href="https://www.flaticon.com/authors/bombasticon-studio" title="Bombasticon Studio">Bombasticon Studio</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div><div>Icons made by <a href="https://www.flaticon.com/authors/th-studio" title="th studio">th studio</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div><div>Icons made by <a href="https://www.flaticon.com/authors/iconnut" title="iconnut">iconnut</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div><div>Icons made by <a href="https://www.flaticon.com/authors/royyan-wijaya" title="Royyan Wijaya">Royyan Wijaya</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div><div>Icons made by <a href="https://www.flaticon.com/authors/fjstudio" title="fjstudio">fjstudio</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div><div>Icons made by <a href="https://www.flaticon.com/authors/ilham-fitrotul-hayat" title="Ilham Fitrotul Hayat">Ilham Fitrotul Hayat</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div><div>Icons made by <a href="https://www.flaticon.com/authors/uniconlabs" title="Uniconlabs">Uniconlabs</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a>
				</div>
				<div>Charts created by <a href="https://github.com/chartjs/Chart.js">Chart.js</a><a href="/libs/chart-js/LICENSE.md">(MIT лицензия).</a></div>
				<div>Text Editor created by<a href="https://ckeditor.com/">ckeditor</a><a href="https://www.gnu.org/licenses/gpl-3.0-standalone.html">(GPL лицензия).</a></div>
			</details>
		</div>
	</div>
</div>