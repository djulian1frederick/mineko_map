<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../js/jquery.tinyTips.js"></script>
<script type="text/javascript" src="../js/func_admin.js"></script>
<link href="../js/jquery.fias.min.css" rel="stylesheet">
<script src="../js/lib/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="../js/jquery.fias.min.js" type="text/javascript"></script>
<script src="../js/script.js" type="text/javascript"></script>
<script src="../js/select2.min.js"></script>
<script src="js/menu.js"></script>
<script src="../js/func.js"></script>
<link rel="stylesheet" href="../css/index.css">
<?php include('header.php');?>	
		


<?php require_once("connection.php");?>

</div>
<div class="container">

		<ul class="edit-navigation">
			<li  onclick="position('info')">Основная информация об организациях</li>
			<li onclick="position('rukovoditeli')">Руководители организаций</li>
			<li onclick="position('addresses')">Адреса организаций</li>
			<li onclick="position('mo')">Принадлежность к муниципальному образованию</li>
		</ul>	

		<div id="position_result" style="width: 90%; padding: 0 5%; background: #fff;">
			
		</div>
</div>


<style>

</style>