<?php require_once("../connection.php");?>
<?php 
$rname=$_POST['name']; 
$rfam=$_POST['fam'];
$rotch=$_POST['otch'];
$org_con=$_POST['org_con'];
	$phone=$_POST['phone'];
	$email=$_POST['organ_email'];

$sql_query = "INSERT into rukovoditeli (first_name, second_name, last_name) values ('".$rname."','".$rfam."','".$rotch."')";
$result = mysqli_query($bd, $sql_query);
if ($result) {
		$sql_select_this_ruk = "SELECT * from rukovoditeli where first_name='".$rname."' and second_name='".$rfam."' and last_name='".$rotch."'";
		$takeidruk=mysqli_query($bd, $sql_select_this_ruk);
			$idrukrow = mysqli_fetch_array($takeidruk);
			$idruk = $idrukrow['id_rukovoditel'];
				if ($org_con <> NULL) {
					$sql_update = "UPDATE predpriyatiya set id_rukovoditel='".$idruk."' where id_predpriyatiya='".$org_con."'";
					$result_update = mysqli_query($bd, $sql_update);}

					if ($idruk <> NULL) {
						$sql = "INSERT into contacts(phone1, email) values ('".$phone."','".$email."')";
						$result = mysqli_query($bd, $sql);
						if ($result) {
							$select= "SELECT id_contact from contacts where phone1='".$phone."' and email='".$email."'";
							$select_r=mysqli_query($bd, $select);
							$id_con_arr=mysqli_fetch_array($select_r);
							
							$id_con=$id_con_arr['id_contact'];
							$sql_update="UPDATE predpriyatiya set id_contact='".$id_con."' where id_predpriyatiya='".$org_con."'";
							$update=mysqli_query($bd, $sql_update);
						}
					}
}

?>