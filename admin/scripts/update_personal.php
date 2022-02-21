<?php 
	session_start();
	require_once("../connection.php");

	$name = $_POST['firstname'];
	$second = $_POST['second'];
	$last = $_POST['last'];

	$id_con = $_POST['id_con'];
	$id_check = $_POST['id_check'];

	$success = "Ваши данные были успешно обновлены";
	$unsuccess = "Произошла ошибка при попытки изменения данных";
	

	if($id_check <> NULL) {
		if(isset($_SESSION['user_id'])) {
			$sql = "UPDATE checking_registration set first_name_reg='".$name."', second_name_reg='".$second."', last_name_reg='".$last."' where id_check='".$id_check."'";
			$query_update_check = mysqli_query($bd, $sql);
			if($query_update_check) {echo "<span>".$success."</span>";}
			else {	echo "<span>".$unsuccess."</span>";	}		
		}
	}
	if($id_con <> NULL) {
		if(isset($_SESSION['user_id'])) {
			$sql = "UPDATE contacts_people set first_name_con='".$name."', second_name_con='".$second."', last_name_con='".$last."' where id_con_people='".$id_con."'";
			$query_update_check = mysqli_query($bd, $sql);
			if($query_update_check) {echo "<span>".$success."</span>";}
			else {	echo "<span>".$unsuccess."</span>";	}	
		}	
	}
	if($id_check == NULL && $id_con == NULL && isset($_SESSION['user_id']))
	{
		$sql_con = "select id_con_people from contacts_people where id_user='".$_SESSION['user_id']."' and first_name_con='".$name."' and second_name_con='".$second."'";
		$con_check = mysqli_query($bd, $sql_con);
		$con_check = mysqli_fetch_array($con_check);
		if($con_check <> NULL){
			$id_con = $con_check['id_con_people'];
		}
		else {

		$sql_insert = "INSERT into contacts_people (first_name_con, second_name_con, last_name_con, id_user) values ('".$name."','".$second."','".$last."', '".$_SESSION['user_id']."')";
		$query_insert = mysqli_query($bd,$sql_insert);
		$id_con = mysqli_query($bd, );
		$id_con = mysqli_fetch_array($id_con);
		$id_con = $id_con['id_con_people'];}
		if($id_con <> NULL) {
			$admin = mysqli_query($bd, "UPDATE admins set id_con_people='".$id_con."' where id_user='".$_SESSION['user_id']."' and level='".$_SESSION['level']."'");
			if($admin){ echo  "<span>".$success."</span>";}
			else {	echo "<span>".$unsuccess."</span>";	}	
		}
	}

?>