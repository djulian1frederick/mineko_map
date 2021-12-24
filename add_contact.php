<?php require_once("connection.php");?>
<?php 
	
	$rfam=$_POST['rukovoditel'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];

if ($rfam <> NULL) {
	$sql = "INSERT into contacts(phone1, email) values ('".$phone."','".$email."')";
	$result = mysqli_query($bd, $sql);
	if ($result) {
		$select= "SELECT id_contact from contacts where phone1='".$phone."' and email='".$email."'";
		$select_r=mysqli_query($bd, $select);
		$id_con_arr=mysqli_fetch_array($select_r);
		$id_con=$id_con_arr['id_contact'];
		$sql_update="UPDATE rukovoditeli set id_contact='".$id_con."' where id_rukovoditel='".$rfam."'";
		$update=mysqli_query($bd, $sql_update);
			if($update){
			#echo "Привязан контакт";
			}
		}
	}
	else {
		echo "Не был выбран руководитель";
	}


?>