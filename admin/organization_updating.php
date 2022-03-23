<?php session_start();
	if(!isset($_SESSION['user_id']) or $_SESSION['user_id'] == NULL) {
		header('Location: ../index');
	}
?>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Режим редактирования организации</title>
	<link rel="stylesheet" href="../css/index.css">
<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../js/func_update.js"></script>
<link href="../js/jquery.fias.min.css" rel="stylesheet">
<script src="../js/jquery.fias.min.js" type="text/javascript"></script>
<script src="../js/script.js" type="text/javascript"></script>
<script src="../js/func.js" type="text/javascript"></script>
<script src="../js/select2.min.js"></script>
<script src="js/menu.js"></script>
<script src="js/func_update_organization.js"></script>
<link rel="stylesheet" href="../css/index.css">
<script>
	$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
</head>
<body>
<?php include('header.php');?>	
<?php require_once("connection.php");?>
<div class="container">

	
<?php if($_SESSION['level'] == '3') {
		echo '<div class="blocks_info">
			<select name="organization" id="organization" class="js-example-basic-single" style="width: 450px; max-width: 100%;">	
						<option value="">Не выбрано</option>';
							$sql = "SELECT id_predpriyatiya, name from predpriyatiya";
							$org_q = mysqli_query($bd, $sql);
							$org_l = mysqli_fetch_array($org_q);
								do {
									echo '<option value="'.$org_l['id_predpriyatiya'].'">'.$org_l['name'].'</option>';
								}while ($org_l=mysqli_fetch_array($org_q));
			echo '</select><br>
		<button onclick="choose_org()">Выбрать</button>';
		echo '</div>
	<div id="result" style="display: flex; flex-flow: wrap; width: 100%;"></div>';
	}
	if($_SESSION['level'] == '2') {
		$admin_id = mysqli_query($bd, "SELECT id_admin from admins where id_user='".$_SESSION['user_id']."'");
		$admin_id = mysqli_fetch_array($admin_id);
		$admin_id = $admin_id['id_admin'];
		$id_mo = mysqli_query($bd, "SELECT id_mo from mo where id_admin='".$admin_id."'");
		$id_mo = mysqli_fetch_array($id_mo);
		$id_mo = $id_mo['id_mo'];
		echo '<div class="blocks_info">
			<select name="organization" id="organization" class="js-example-basic-single" style="max-width: 450px; width: 100%;">	
						<option value="">Не выбрано</option>';
							$sql = "SELECT id_predpriyatiya, name from predpriyatiya where id_mo='".$id_mo."'";

							$org_q = mysqli_query($bd, $sql);
							$org_l = mysqli_fetch_array($org_q);
								do {
									echo '<option value="'.$org_l['id_predpriyatiya'].'">'.$org_l['name'].'</option>';
								}while ($org_l=mysqli_fetch_array($org_q));
			echo '</select><br>
		<button onclick="choose_org()" class="button-choose">Выбрать</button>';
		echo '</div>
	<div id="result" style="display: flex; flex-flow: wrap; width: 100%;"></div>';
	}
	elseif($_SESSION['level'] == '1') {
		require_once('choose_org.php');
	} 
?>
	
</div>
</body>
</html>