<?php session_start(); ?>
<?php require_once("../connection.php");?>
<?php 
	$organization = $_POST['org_id'];
	$con_id = $_POST['con_id'];
	$org_phone1 = $_POST['org_phone1'];
	$org_email = $_POST['org_email'];

		if(isset($_SESSION['user_id'])) {
		$sql_select_con = "SELECT id_con_people from contacts_people where id_user='".$_SESSION['user_id']."'";
		$sql_con = mysqli_query($bd, $sql_select_con);
		$main_row = mysqli_fetch_array($sql_main);
		$id_con_people = $main_row['id_con_people'];
	}

	if (isset($con_id) && $con_id <> "") {
		$update_cont = "UPDATE contacts set contacts.phone1='".$org_phone1."', contacts.email='".$org_email."' where id_contact = '".$con_id."'";
		$updating = mysqli_query($bd, $update_cont);
			if ($updating) {
				echo '<span>Контакты успешно обновлены</span>';
			}
	}
	else {
		$insert_cont = "INSERT into contacts (phone1, email) values ('".$org_phone1."','".$org_email."')";
		$inserting = mysqli_query($bd, $insert_cont);
			$select_cont = "SELECT id_contact from contacts where contacts.phone1='".$org_phone1."' and contacts.email ='".$org_email."'";
			$selecting = mysqli_query($bd, $select_cont);
			$select_row = mysqli_fetch_array($selecting);
			$cont_id = $select_row['id_contact'];
				
			if($id_con_people <> NULL) {
				$update_cont = "UPDATE contacts_people set id_contact='".$cont_id."' where id_con_people='".$id_con_people."'";}
				else {
					
				}
				$updating = mysqli_query($bd, $update_cont);
					if ($updating) {
						echo '<span>Информация о контактах обновлена</span>';
					}
	}
?>