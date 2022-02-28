<?php 
	session_start();
?>
<?php if(isset($_SESSION['this_email'])) {$email = $_SESSION['this_email'];} else { $msg .= 'ошибка';} ?>
<?php if(isset($_GET['failed']) and $_GET['failed'] == 1) { $msg = '!!! Код сброса пароля является недействительным. Сброс пароля не был произведен.'; } ?>
<!DOCTYPE html5>
<html>
<head>
	<title>Cброс пароля</title>
<meta charset="utf-8">
<script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="css/index.css">
</head>
<body>
<?php require_once('admin/connection.php');?>
<?php include 'header.php'; ?>

<div class="container">
	<div class="content">
	<?php if(isset($email)) { echo '<div class="registrate">
			<div class="login_form">	
				<img src="img/logo.png" alt="Логотип сайта" style="margin: 25px 0;padding: 0 0 15px 0;"><br>
					<span>Сброс пароля учетной записи</span><br><br>';
			echo '<div class="restoring">
			<form id="changepwd">';	
			echo '<div class="password">
				<input type="password" name="password_once" id="password-input" required placeholder="придумайте пароль*">
				<a href="#" class="password-control"><img src="img/show.svg" class="img-pwd" width="20px"></a>
			</div>';
			echo '<br><div class="password">
				<input type="password" name="password_repeat" id="password_repeat" required placeholder="повторите пароль*">
				<a href="#" class="password-control"><img src="img/show.svg" class="img-pwd-1" width="20px"></a>
			</div>';
			echo '<br><button id="submit_change">Сбросить пароль</button>';
			echo '</div></form>';
			echo '<div id="result"></div>';
			echo '</div>';}?>
		<?php if(isset($msg)) { echo '<div class="form_block">
					<span class="error">'.$msg.'</span>
					<div class="attention"><p>Для того, чтобы начать процедуру сброса пароля заново <a onclick=show_popup()>нажмите сюда</a></p></div>';
					 echo '</div>';
					 include("pass-restore.php");
					} ?>
	</div>
</div>
</body>
</html>
<style>
	.password {
		position: relative;
	}

	.password input {
		width: 70%;
		font-family: Circe Light;
		font-size: 16px;
	}

	.password-control {
		position: absolute;
		top: 5px;
		right: 25px;
		display: inline-block;
		width: 20px;
		height: 20px;
	}
	.restoring {
		width: 60%;
		padding: 15px 0;
		margin: 0 auto;
	}
	.login_form {
		background: #fbfbfb;
		text-align: center;
	}
	.error {
		margin: 2.5% auto;
		padding:  2.5%;
		text-align: center;
		background: #1c75bc;
		color:  white;
		font-size: 22px;
		font-family: Circe Light;
		display: block;
		margin-bottom: 0;
	}
	.form_block p, .form_block a {
		color:  #1c75bc;
		margin: 0;
		padding: 15px;
	}
	.form_block a {
		font-size: 18px;
		text-decoration: underline;
		cursor: pointer;
	}
	.form_block {
		margin: auto;
		text-align: center;
		background: #fbfbfb;
		width: 70%;
		min-height: 250px;
	}
	.attention {
		background: #fff;
		width: 70%;
		margin: auto;
		display: block;
	}
</style>
<script>
	$('body').on('click', '.password-control', function(){
		if ($('#password-input').attr('type') == 'password'){	
			$('#password-input').attr('type', 'text');
			$('.img-pwd').attr("src", "img/hide.png");
		} else {
			$('#password-input').attr('type', 'password');
			$('.img-pwd').attr("src", "img/show.png");
		}
		return false;
	});
	$('body').on('click', '.password-control', function(){
		if ($('#password_repeat').attr('type') == 'password'){	
			$('#password_repeat').attr('type', 'text');
			$('.img-pwd').attr("src", "img/hide.png");
		} else {
			$('#password_repeat').attr('type', 'password');
			$('.img-pwd').attr("src", "img/show.png");
		}
		return false;
	});
</script>
<script>
	$('#submit_change').on('click', function(e) {
			e.preventDefault();
			 var form_data = new FormData($('#changepwd')[0]); 
	$.ajax({
			url: 'change_pass.php', // point to server-side PHP script
			dataType: 'text',
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: 'post',
				success: function(html){
					$('#result').html(html);
				}
		});
	});
</script>