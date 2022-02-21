<?php session_start();?>

			<?php
				require_once('admin/connection.php');
				$login = $_POST['ulogin'];
				$plainpassword = $_POST['password'];
				$sql_users = "SELECT * from users where activation='1' and user_login='".$login."' or user_email='".$login."'";
				$users = mysqli_query($bd, $sql_users);
				$users = mysqli_fetch_array($users);
				if ($users <> NULL && $users['activation'] == '1') {
					$hash = $users['password'];
					
						if(password_verify($plainpassword, $hash)) {
							header("Location:editor/index");
							$admin_rules = mysqli_query($bd, "SELECT level from admins where id_user='".$users['id_user']."'"); 
							$admin_rules = mysqli_fetch_array($admin_rules);
							if($admin_rules == NULL) { $_SESSION['level'] ='0'; }
							else {$_SESSION['level'] = $admin_rules['level'];}
							$_SESSION['user_id']=$users['id_user'];
						    
						} else {	
							header("Refresh: 3; url=login");
							$msg = "<span>Неверный логин или пароль. Попробуйте еще раз</span>";
						}
				}
				else {
					$msg = "<span>Пользователь с введенными данными отсутствует или еще не активирован.</span>";
					$msg .="<br><span>Подайте заявку на <a href='/registration'>регистрацию</a></span>";
				}
				
			?>
<!DOCTYPE html5>
<html>
<head>
	<title>Авторизация</title>
<meta charset="utf-8">
<script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="css/index.css">
</head>
<body>
<?php require_once('admin/connection.php');?>
<?php include 'header.php'; ?>

<div class="container">
	<div class="content">
		<div class="block_info_load">
			<?php echo $msg; ?>
		</div>
	</div>
</div>
</body>
</html>