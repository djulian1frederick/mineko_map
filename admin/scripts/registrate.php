<?php 
	require_once("../connection.php");
	
	$success_msg = "<span>Пользователь создан. Ожидается проверка организации администратором. Для отслеживания подтвердите адрес электронной почты</span>";
	$unsuccess_msg = "<span>Пользователь не был создан. Проверьте правильность ввода данных или попробуйте позже</span>";

	$secname = $_POST['secondname'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];

	$inn_org = $_POST['inn_org'];
	$mo = $_POST['ra_mo'];
	$nameorg = $_POST['nameorg'];

	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$plainpassword = $_POST['password'];

	$password = password_hash($plainpassword, PASSWORD_DEFAULT);

	var_dump($password);
	$date_created = date("Y-m-d");

	/*$sql_query = "INSERT into users (user_email, password, date_create) values ('".$email."','".$password."','".$date_created."')";
	$query = mysqli_query($bd, $sql_query);
	if ($sql_query) {
		$sql_select = "SELECT id_user from users where password='".$password."' and user_email ='".$email."'";
		$select_query = mysqli_query($bd, $sql_select);
		$selecting_row = mysqli_fetch_array($select_query);
		$id_u = $selecting_row['id_user'];
			$checking_insert = "INSERT into checking_registration (id_user, name_org,  mo, inn, first_name_reg, second_name_reg) values ('".$id_u."','".$nameorg."','".$mo."','".$inn."','".$firstname."','".$secname."')";
			$checking_query = mysqli_query($bd, $checking_insert);
			if ($checking_query && $lastname <> NULL) {
				$update_last_name = "UPDATE checking_registration set last_name_reg='".$lastname."' where id_user='".$id."'";
				$update_last_name_query = mysqli_query($bd, $update_last_name);
				if($update_last_name_query) {
					echo $success_msg;
				}
			}
			elseif($checking_query) {
				echo $success_msg;
			}
			else {
				echo $unsuccess_msg;
			}
	}*/



?>