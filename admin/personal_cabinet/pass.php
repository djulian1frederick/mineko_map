<?php session_start(); ?>
<?php require_once('../connection.php'); ?>
<div class="blocks_info">
	<?php if(isset($_SESSION['user_id'])) { echo '<div class="registrate">
	<div class="login_form">';
			echo '<div class="restoring">
			<form id="changepwd">';	
			echo '<div class="password">
				<input type="password" name="password_cur" id="password-cur" required placeholder="текущий пароль*">
				<a href="#" class="password-control"><img src="../../img/show.svg" class="img-pwd" width="20px"></a>
			</div>';
			echo '<div class="password">
				<input type="password" name="password_once" id="password-input" required placeholder="придумайте пароль*">
				<a href="#" class="password-control"><img src="../../img/show.svg" class="img-pwd" width="20px"></a>
			</div>';
			echo '<br><div class="password">
				<input type="password" name="password_repeat" id="password_repeat" required placeholder="повторите пароль*">
				<a href="#" class="password-control"><img src="../../img/show.svg" class="img-pwd-1" width="20px"></a>
			</div>';
			echo '<br><button id="submit_change">Сбросить пароль</button>';
			echo '</div></form>';
			echo '<div id="result"></div>';
			echo '</div>';}?>
</div>
<script>
	$('body').on('click', '.password-control', function(){
		if ($('#password-input').attr('type') == 'password'){	
			$('#password-input').attr('type', 'text');
			$('.img-pwd').attr("src", "../../img/hide.png");
		} else {
			$('#password-input').attr('type', 'password');
			$('.img-pwd').attr("src", "../../img/show.png");
		}
		return false;
	});
	$('body').on('click', '.password-control', function(){
		if ($('#password_repeat').attr('type') == 'password'){	
			$('#password_repeat').attr('type', 'text');
			$('.img-pwd').attr("src", "../../img/hide.png");
		} else {
			$('#password_repeat').attr('type', 'password');
			$('.img-pwd').attr("src", "../../img/show.png");
		}
		return false;
	});
</script>
<script>
	$('#submit_change').on('click', function(e) {
			e.preventDefault();
			 var form_data = new FormData($('#changepwd')[0]); 
	$.ajax({
			url: '/editor/scripts/change_pass.php', // point to server-side PHP script
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
		margin: 10px 70px;
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
	.form_block p {
		color:  #1c75bc;
		margin: 0;
		padding: 15px;
	}
	.form_block a {
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