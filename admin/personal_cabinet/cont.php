<?php session_start(); ?>
<?php require_once('../connection.php'); ?>
<div class="blocks_info">
	<div class="update-blocks">
	
	<?php  if(isset($_SESSION['user_id']) && $_SESSION['level'] == '0') 
		{ $query=mysqli_query($bd, "SELECT phone from checking_registration where id_user='".$_SESSION['user_id']."'"); 
			$row = mysqli_fetch_array($query); 
			$phone = $row['phone'];
			echo '<input type="hidden" id="id_check" value="'.$row['id_check'].'">'; 
		} 
		elseif(isset($_SESSION['user_id']) && $_SESSION['level'] >= '1') 
		{ $query=mysqli_query($bd, "SELECT phone1 from contacts join contacts_people on contacts_people.id_contact = contacts.id_contact where id_user='".$_SESSION['user_id']."'");
			$row = mysqli_fetch_array($query); 
			$phone = $row['phone1'];
			echo '<input type="hidden" id="id_con_people" value="'.$row['id_con_people'].'">'; 
		}
		$email = mysqli_query($bd, "SELECT user_email from users where id_user='".$_SESSION['user_id']."'");
			$email = mysqli_fetch_array($email);
			$email = $email['user_email'];

		?>
		<?php echo '<input type="text" id="phone" value="'.$phone.'" placeholder="Телефон">';?><br>
		<?php echo '<input type="text" id="email" value="'.$email.'" placeholder="Email">';?>
		<p>При изменении адреса email потребуется подтверждение*</p>
		<br><br>
		<button class="edit_but" onclick="update_personal_contacts()"><img src="../img/edit.png" width="16px" height="16px"></button>
		<div id="result" style="margin: 20px; padding: 15px;">
			
		</div>
	</div>
</div>