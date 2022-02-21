<div class="login">
	<form action="auth.php" method="POST" class="login_form">
		<img src="img/logo.png" alt="Логотип сайта" style="margin: 25px 0;padding: 0 0 15px 0;"><br>
			<span>Авторизация в личном кабинете</span><br>
			<label>логин*</label>
			<input type="text" name="ulogin" required placeholder="введите логин или email">
			<br>
			<label>пароль*</label>
			<input type="password" name="password" required placeholder="введите пароль">
			<p onclick="show_popup()" class="pass_login" style="margin-top: -20px;">Забыли пароль?</p>
			<button type="submit"><img src="img/enter.png" width="24px">войти</button><br><br><br>
			<p>Отсутствует учетная запись? <a href="registration">Подать заявку на регистрацию</a></p>
	</form>
</div>

<?php include('pass-restore.php'); ?>

