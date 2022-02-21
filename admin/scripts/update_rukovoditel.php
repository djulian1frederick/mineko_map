<?php require_once("../connection.php");?>
<?php 
	$organization = $_POST['org_id'];
	$o_name = $_POST['o_name'];
	$o_fam = $_POST['o_fam'];
	$o_otch = $_POST['o_otch'];
	$ruk_id = $_POST['ruk_id'];

	if (isset($ruk_id) && $ruk_id <> "" ) {
		if($o_otch <> '' && $o_otch <> NULL) {
			$sql_update = "UPDATE rukovoditeli set rukovoditeli.first_name='".$o_name."', rukovoditeli.second_name = '".$o_fam."', rukovoditeli.last_name = '".$o_otch."' where id_rukovoditel='".$ruk_id."'";
		}
		else {$sql_update = "UPDATE rukovoditeli set rukovoditeli.first_name='".$o_name."', rukovoditeli.second_name = '".$o_fam."' where id_rukovoditel='".$ruk_id."'";}

	$query_update = mysqli_query($bd, $sql_update);
		if ($query_update) {
			echo '<span>Информация о текущем руководителе обновлена</span>';
		}
	}
	else {
		if($o_otch <> '' & $o_otch <> NULL) {
		$sql_insert = "INSERT into rukovoditeli (first_name, second_name, last_name) values ('".$o_name."','".$o_fam."','".$o_otch."')";}
		else { $sql_insert = "INSERT into rukovoditeli (first_name, second_name) values ('".$o_name."','".$o_fam."')"; }
		$query_insert = mysqli_query($bd, $sql_insert);
			$sql_select = "SELECT id_rukovoditel from rukovoditeli where first_name='".$o_name."' and second_name = '".$o_fam."'";
			$query_select = mysqli_query($bd, $sql_select);
			$selected_row  = mysqli_fetch_array($query_select);
			$id_rukovoditel = $selected_row['id_rukovoditel'];
				$sql_update_org = "UPDATE predpriyatiya set id_rukovoditel =  '".$id_rukovoditel."' where id_predpriyatiya = '".$organization."'";
				$update_org = mysqli_query($bd, $sql_update_org);
					if($update_org) {
						echo '<span>Информация о руководителе обновлена</span>';
					}
	}
?>