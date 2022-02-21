<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../js/func_admin.js"></script>
<link href="../js/jquery.fias.min.css" rel="stylesheet">
<script src="../js/lib/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="../js/jquery.fias.min.js" type="text/javascript"></script>
<script src="../js/script.js" type="text/javascript"></script>
<script src="../js/select2.min.js"></script>
<script src="../libs/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="../css/index.css">
<title>Добавление достижений</title>
<?php include('header.php');?>	
		
<script>
	$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>

<?php require_once("connection.php");?>
<div class="blocks_info">
	<form>
		<label>Название для новости в категории "Достижения"</label>
		<input type="text" name="name_achiev">
		<label>Дата новости</label>
		<input type="date" name="date_achiev">
		<textarea id="editor1" name="editor1"></textarea>
				<script>
	                CKEDITOR.replace('editor1');
	            </script>
		<input type="submit" value="Добавить новость"> 
	</form>
</div>
