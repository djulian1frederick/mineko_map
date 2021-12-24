<?php require_once("connection.php");?>
<?php 
	$phone=$_POST['phone'];
	$email=$_POST['organ_email'];
	$name=$_POST['name']; 
	$fam=$_POST['fam'];
	$otch=$_POST['otch'];
	$org = $_POST['org_con'];

	$sql_rukovoditel = "INSERT into rukovoditeli(first_name, last_name, second_name) values ('".$name."','".$otch."','".$fam."')";
	$rukovoditel_add = mysqli_query($bd, $sql_rukovoditel);
		if($rukovoditel_add) {
		$select_rukovoditel = "SELECT * from rukovoditeli where first_name='".$name."' and second_name='".$fam."' and last_name='".$otch."'";
		$select_rukovoditel_q = mysqli_query($bd, $select_rukovoditel);
		if($select_rukovoditel_q) {
			$list_ruk = mysqli_fetch_array($select_rukovoditel_q);
			$id_ruk = $list_ruk['id_rukovoditel'];
			$update_rukovoditel = "UPDATE predpriyatiya set id_rukovoditel='".$id_ruk."' where id_predpriyatiya='".$org."'";
			$query_1 = mysqli_query($bd, $update_rukovoditel);
	}}


	$sql_contacts = "INSERT into contacts(phone1, email) values ('".$phone."','".$email."')";
	$contacts_add = mysqli_query($bd, $sql_contacts);
		if($contacts_add) {
		$select_con = "SELECT * from contacts where phone1='".$phone."' and email='".$email."'";
		$select_con_q = mysqli_query($bd, $select_con);
		if($select_con_q) {	
			$list_con = mysqli_fetch_array($select_con_q);
			$id_contact = $list_con['id_contact'];
			$update_contact = "UPDATE predpriyatiya set id_contact='".$id_contact."' where id_predpriyatiya='".$org."'";
			$query_2 = mysqli_query($bd, $update_contact);
	}}
	
	
	

	?>