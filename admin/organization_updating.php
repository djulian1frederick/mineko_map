<?php session_start();
	if(!isset($_SESSION['user_id']) or $_SESSION['user_id'] == NULL) {
		header('Location: ../index');
	}
?>
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
<?php include('header.php');?>	
		
<script>
	$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>

<?php require_once("connection.php");?>
<div class="container">

	
<?php if($_SESSION['level'] == '3') {
		echo '<div class="blocks_info" style="height: 400px;">
			<select name="organization" id="organization" class="js-example-basic-single" style="width: 450px;">	
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
	elseif($_SESSION['level'] == '1') {
		require_once('choose_org.php');
	} 
?>
	
</div>