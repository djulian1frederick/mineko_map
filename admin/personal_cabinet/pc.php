<?php session_start(); ?>
<?php require_once('../connection.php'); ?>
<div class="blocks_info">
	<div class="update-blocks">
	
	<?php  if(isset($_SESSION['user_id']) && $_SESSION['level'] == '0') 
		{ $query=mysqli_query($bd, "SELECT first_name_reg, second_name_reg, last_name_reg, id_check from checking_registration where id_user='".$_SESSION['user_id']."'"); 
			$row = mysqli_fetch_array($query); 
			$last = $row['last_name_reg'];
			$second = $row['second_name_reg'];
			$name = $row['first_name_reg'];
			echo '<input type="hidden" id="id_check" value="'.$row['id_check'].'">'; 
		} 
		elseif(isset($_SESSION['user_id']) && $_SESSION['level'] = '1') 
		{ $query=mysqli_query($bd, "SELECT first_name_con, second_name_con, last_name_con, id_con_people from contacts_people where id_user='".$_SESSION['user_id']."'"); 
			$row = mysqli_fetch_array($query); 
			$last = $row['last_name_con'];
			$second = $row['second_name_con'];
			$name = $row['first_name_con'];
			echo '<input type="hidden" id="id_con_people" value="'.$row['id_con_people'].'">'; 
		}
		elseif(isset($_SESSION['user_id']) && $_SESSION['level'] > '1'){
			$query=mysqli_query($bd, "SELECT first_name_user, second_name_user, last_name_user, from users where id_user='".$_SESSION['user_id']."'"); 
			$row = mysqli_fetch_array($query); 
			$last = $row['last_name_user'];
			$second = $row['second_name_user'];
			$name = $row['first_name_user'];
		}
		$login = mysqli_query($bd, "SELECT user_login from users where id_user='".$_SESSION['user_id']."'");
		$login = mysqli_fetch_array($login);
		$login = $login['user_login'];
		?>
		<?php echo '<input type="text" id="second" value="'.$second.'" placeholder="Фамилия">';?><br>
		<?php echo '<input type="text" id="name" value="'.$name.'" placeholder="Имя">';?><br>
		<?php echo '<input type="text" id="last" value="'.$last.'" placeholder="Отчество">';?><br><br>
		<label>Ваш логин:</label><br>
		<?php echo '<input type="text" id="login" value="'.$login.'" placeholder="Ваш логин">'; ?><br>
		<button class="edit_but" onclick="update_personal_info()"><img src="../img/edit.png" width="16px" height="16px"></button>
		<div id="result" style="margin: 20px; padding: 15px;">
			
		</div>
	</div>
</div>