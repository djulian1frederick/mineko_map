<?php require_once("../connection.php");?>
<?php 

$rname = trim($_POST['r_name']);
$rname=mysqli_real_escape_string($bd, $rname);

$rfam=trim($_POST['r_fam']);
$rfam = mysqli_real_escape_string($bd, $rfam);

$rotch=trim($_POST['r_otch']);
$rotch = mysqli_real_escape_string($bd, $rotch);

$rraion=trim($_POST['rraion']); #mo
$rraion = mysqli_real_escape_string($bd, $rraion);

$post = trim($_POST['post']);
$post = mysqli_real_escape_string($bd, $post);

$phone=trim($_POST['phone']);
$phone = mysqli_real_escape_string($bd, $phone);

$email=trim($_POST['email']);
$email = mysqli_real_escape_string($bd, $email);

$post_sql = "INSERT into posts (name_post) values ('".$post."')";
$post_query = mysqli_query($bd, $post_sql);
$post_id_sql = "SELECT id_post from posts where name_post='".$post."'";
$post_id_q = mysqli_query($bd, $post_id_sql);

$post_id_row = mysqli_fetch_array($post_id_q);
$post_id = $post_id_row['id_post'];

if(isset($phone) || isset($email)) {
$contact_sql = "INSERT into contacts(phone1, email) values ('".$phone."','".$email."')";
$contact_result = mysqli_query($bd, $contact_sql);
	$select= "SELECT id_contact from contacts where phone1='".$phone."' and email='".$email."'";
	$select_r=mysqli_query($bd, $select);
	$id_con_arr=mysqli_fetch_array($select_r);
	$id_con=$id_con_arr['id_contact'];

$sql_query = "INSERT into rukovoditeli (first_name, second_name, last_name, id_contact, id_post) values ('".$rname."','".$rfam."','".$rotch."', '".$id_con."','".$post_id."')";
}
else {
	$sql_query = "INSERT into rukovoditeli (first_name, second_name, last_name, id_post) values ('".$rname."','".$rfam."','".$rotch."','".$post_id."')";
}
$result = mysqli_query($bd, $sql_query);

$sql_ruk = "SELECT id_rukovoditel where first_name='".$rname."' and second_name='".$rfam."' and id_post='".$post_id."'";

$id_rukovoditel_sql = mysqli_query($bd, $sql_ruk);
$id_rukovoditel_row = mysqli_fetch_array($id_rukovoditel_sql);
$id_rukovoditel = $id_rukovoditel_row['id_rukovoditel'];

$update_mo = mysqli_query($bd, "UPDATE mo set id_rukovod='".$id_rukovoditel."' where id_mo='".$rraion."'");

?>