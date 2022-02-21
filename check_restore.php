<?php 
	session_start();
	require_once("admin/connection.php");
	$email = $_GET['e'];
	$activation = $_GET['i'];
	$date = date("dmY");

	$sql_check = mysqli_query($bd, "SELECT user_login, user_email, activation from users where user_email='".$email."'");
	$check_row = mysqli_fetch_array($sql_check);
	if ($check_row <> NULL) {
		$check_activation = $check_row['user_login'];
		$check_activation .=$date;
				if(password_verify($check_activation, $activation)) {
					header('Location: change_password.php');
					$_SESSION['this_email'] = $email;
				}
				else {
					$_SESSION = [];
					header('Location: change_password.php?failed=1');
				}
	}
?>

