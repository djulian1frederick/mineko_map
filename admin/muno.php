<?php session_start();
	if(!isset($_SESSION['user_id']) or $_SESSION['user_id'] == NULL) {
		header('Location: ../index');
	}
?>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../js/func_admin.js"></script>
<link href="../js/jquery.fias.min.css" rel="stylesheet">
<script src="../js/lib/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="../js/jquery.fias.min.js" type="text/javascript"></script>
<script src="../js/script.js" type="text/javascript"></script>
<script src="../js/select2.min.js"></script>
<link rel="stylesheet" href="../css/index.css">
<script src="js/menu.js"></script>
<script src="../js/func.js"></script>
<?php include('header.php');?>	

<?php require_once("connection.php");?>
<div class="container">

<ul class="edit-navigation">
			<li  onclick="position('mo_rukovoditel')">Руководители муниципальных образований</li>
			<li onclick="position('pic_rukovoditel')">Дополнительно</li>
		</ul>	

		<div id="position_result" style="width: 90%; padding: 0 5%; background: #fff;">
			
		</div>
</div>