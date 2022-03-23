<?php require_once("../connection.php");?>
<?php 
$rname=trim($_POST['name']);
$rname=mysqli_real_escape_string($bd,$rname);

$rfam=trim($_POST['fam']);
$rfam=mysqli_real_escape_string($bd,$rfam);

$rotch=trim($_POST['otch']);
$rotch=mysqli_real_escape_string($bd,$rotch);

$org_con=trim($_POST['org_con']);
$org_con=mysqli_real_escape_string($bd,$org_con);

$phone=trim($_POST['phone']);
$phone=mysqli_real_escape_string($bd,$phone);

$email=trim($_POST['organ_email']);
$email=mysqli_real_escape_string($bd,$email);

$post = trim($_POST['post']);
$post=mysqli_real_escape_string($bd,$post);


$sql_query = "INSERT into rukovoditeli (first_name, second_name, last_name) values ('".$rname."','".$rfam."','".$rotch."')";
$result = mysqli_query($bd, $sql_query);
if ($result) {
		$sql_select_this_ruk = "SELECT * from rukovoditeli where first_name='".$rname."' and second_name='".$rfam."' and last_name='".$rotch."'";
		$takeidruk=mysqli_query($bd, $sql_select_this_ruk);
			$idrukrow = mysqli_fetch_array($takeidruk);
			$idruk = $idrukrow['id_rukovoditel'];
					
					if ($org_con <> NULL) {
						$sql_update = "UPDATE predpriyatiya set id_rukovoditel='".$idruk."' where id_predpriyatiya='".$org_con."'";
						$result_update = mysqli_query($bd, $sql_update);
					}
					if ($idruk <> NULL) {
						$sql = "INSERT into contacts(phone1, email, id_predpriyatiya) values ('".$phone."','".$email."', '".$org_con."')";
						$result = mysqli_query($bd, $sql);
	
					}
				if(isset($post) && $post <> NULL) {
					$sql = mysqli_query($bd, "INSERT into posts (name_post) values ('".$post."')");
					if($sql){
						$id_post = mysqli_query($bd, "SELECT from posts where name_post='".$post."'");
						$id_post = mysqli_fetch_array($id_post);
						$id_post = $id_post['id_post'];
						$update = mysqli_query($bd, "UPDATE rukovoditeli set id_post='".$id_post."' where id_rukovoditel='".$idruk."'");
					}
				}
}

?>