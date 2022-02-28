<link rel="shortcut icon" href="/img/economy.ico" type="image/x-icon">
<script type="text/javascript" src="js/search.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div style="width: 90%; margin: 0 5%; display: inline-flex; flex-wrap: wrap; ">
<div style="position: fixed; padding: 0; margin: 0; left: 0.5%; top: 0.5%;">
			<!-- GTranslate: https://gtranslate.io/ -->
		<a href="#" onclick="doGTranslate('ru|en');return false;" title="English" class="gflag nturl" style="background-position:-0px -0px;">
			<img src="//gtranslate.net/flags/blank.png" height="24" width="24" alt="English" /></a><br>
			<a href="#" onclick="doGTranslate('ru|ru');return false;" title="Russian" class="gflag nturl" style="background-position:-500px -200px;"><img src="//gtranslate.net/flags/blank.png" height="24" width="24" alt="Russian" /></a>

		<style type="text/css">
		<!--
		a.gflag {vertical-align:middle;padding:1px 0;background-repeat:no-repeat;background-image:url(//gtranslate.net/flags/24.png);}
		a.gflag img {border:0;}
		a.gflag:hover {background-image:url(//gtranslate.net/flags/24a.png);}
		#goog-gt-tt {display:none !important;}
		.goog-te-banner-frame {display:none !important;}
		.goog-te-menu-value:hover {text-decoration:none !important;}
		body {top:0 !important;}
		#google_translate_element2 {display:none!important;}
		-->
		</style>

		<div id="google_translate_element2"></div>
		<script type="text/javascript">
		function googleTranslateElementInit2() {new google.translate.TranslateElement({pageLanguage: 'ru',autoDisplay: false}, 'google_translate_element2');}
		</script><script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>


		<script type="text/javascript">
		/* <![CDATA[ */
		eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('6 7(a,b){n{4(2.9){3 c=2.9("o");c.p(b,f,f);a.q(c)}g{3 c=2.r();a.s(\'t\'+b,c)}}u(e){}}6 h(a){4(a.8)a=a.8;4(a==\'\')v;3 b=a.w(\'|\')[1];3 c;3 d=2.x(\'y\');z(3 i=0;i<d.5;i++)4(d[i].A==\'B-C-D\')c=d[i];4(2.j(\'k\')==E||2.j(\'k\').l.5==0||c.5==0||c.l.5==0){F(6(){h(a)},G)}g{c.8=b;7(c,\'m\');7(c,\'m\')}}',43,43,'||document|var|if|length|function|GTranslateFireEvent|value|createEvent||||||true|else|doGTranslate||getElementById|google_translate_element2|innerHTML|change|try|HTMLEvents|initEvent|dispatchEvent|createEventObject|fireEvent|on|catch|return|split|getElementsByTagName|select|for|className|goog|te|combo|null|setTimeout|500'.split('|'),0,{}))
		/* ]]> */
		</script>

		</div>
	<ul class="nice_navigation">
		<a href="index"><li>Главная страница</li></a>
		<a href="rate"><li>Рейтинги</li></a>
		<a href="achievments"><li>Истории успеха</li></a>
		<a href="analyze"><li>Анализ показателей</li></a>
		<a href="all_catalog"><li>Экспортный каталог</li></a>
		<li style="display: inline-flex; width: 270px; position: relative;">
			<input type="text" name="searchinput" id="searchinput" onchange="search()" onfocusout="cringe()">
			<div id="search_result" style="text-align: center;position: absolute;background: #1c75bc5c;top: 50px;width: 270px;margin: 0;padding: 0; z-index: 5555; height: 300pxs;overflow-y: scroll; display: none;">

			</div>
			<button type="submit" onclick="search()">
				<img src="img/search.png">
			</button>
		</li>	
		<?php if(!isset($_SESSION['user_id'])) {  echo '<a href="registration" style="position: relative;"><li>Вступить в каталог</li></a>';
												  echo '<a href="login" style="position: relative; right: 0;"><li>Авторизация</li></a>'; } 
		else { echo '<a href="editor/" style="position: relative; right: 0;"><li>Личный кабинет</li></a>';} ?>
		
	</ul>
</div>

<script> 
// 	$(document).keyup(function(e) {
//     if (e.keyCode === 27) { 
//         $('#search_result').css("display", 'none');
//     }
// });
	
	function cringe() {
		setTimeout(function() {
	        $('#search_result').css("display", 'none');
		}, 1000);
	}
</script>
