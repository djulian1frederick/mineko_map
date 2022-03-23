<?php 
	require_once("../connection.php");

	$address = $_POST['address'];
	$numberhouse = $_POST['numberhouse'];
	$addr = $_POST['addr'];
	$organization = $_POST['organization'];

	$fulladdress = $address.', '.$numberhouse;
	$msg = "Успешно обновлено";

	explode(' ', $fulladdress);
	$fulladdress[count($fulladdress)];

	if($address <> NULL && $addr <> NULL) {
		$sql = "UPDATE addresses set full_address='".$fulladdress."' where id_addr='".$addr."'";
		$sql_upd = mysqli_query($bd, $sql);
		echo $msg;
	}
	
	else {
		$sql = "INSERT into addresses(full_address) values ('".$fulladdress."')";
		$sql_add = mysqli_query($bd, $sql);
		if ($sql_add) {
			$select  = "SELECT id_addr from addresses where full_address='".$fulladdress."'";
			$select_query= mysqli_query($bd,$select);
				if ($select_query) {
					$id_addr_ro = mysqli_fetch_array($select_query);
					$id_addr = $id_addr_ro['id_addr'];
						$sql_update = "UPDATE predpriyatiya set id_address='".$id_addr."' where id_predpriyatiya='".$organization."'";
						$update = mysqli_query($bd, $sql_update);
						if ($update) {
							echo "<script>alert('".$msg."');</script>";
						} 
				}
		}
	}

?>