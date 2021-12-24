<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../js/jquery.tinyTips.js"></script>
<script type="text/javascript" src="../js/func_update.js"></script>
<link href="../js/jquery.fias.min.css" rel="stylesheet">
<script src="../js/lib/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="../js/jquery.fias.min.js" type="text/javascript"></script>
<script src="../js/script.js" type="text/javascript"></script>
<script src="../js/func.js" type="text/javascript"></script>
<script src="../js/select2.min.js"></script>
<script src="js/func_update_organization.js"></script>
<link rel="stylesheet" href="../css/index.css">
<?php include('header.php');?>	
		
<script>
	$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>

<?php require_once("connection.php");?>
<div class="blockinfo">
<button onclick="choose_org()">Выбрать</button>
<select name="organization" id="organization" class="js-example-basic-single">
			
<option value="">Не выбрано</option>
			<?php 
				$sql = "SELECT id_predpriyatiya, name from predpriyatiya";
				$org_q = mysqli_query($bd, $sql);
				$org_l = mysqli_fetch_array($org_q);
				do {
					echo '<option value="'.$org_l['id_predpriyatiya'].'">'.$org_l['name'].'</option>';
				}while ($org_l=mysqli_fetch_array($org_q));
			?>
			</select><br>
</div>
	<div id="result" style="display: flex; flex-flow: wrap; width: 100%;"></div>