<?php require_once("connection.php");?>
<?php 
$rname=$_POST['r_name']; 
$rfam=$_POST['r_fam'];
$rotch=$_POST['r_otch'];
$rraion=$_POST['rraion'];

$sql_query = "INSERT into rukovoditeli (first_name, second_name, last_name) values ('".$rname."','".$rfam."','".$rotch."')";
$result = mysqli_query($bd, $sql_query);
if ($result) {
		$sql_select_this_ruk = "SELECT * from rukovoditeli where first_name='".$rname."' and second_name='".$rfam."' and last_name='".$rotch."'";
		$takeidruk=mysqli_query($bd, $sql_select_this_ruk);
			$idrukrow = mysqli_fetch_array($takeidruk);
			$idruk = $idrukrow['id_rukovoditel'];
				if ($rraion <> NULL) {
					$sql_update = "UPDATE mo set id_rukovod='".$idruk."' where id_raion='".$rraion."'";
					$result_update = mysqli_query($bd, $sql_update);}
}
?>