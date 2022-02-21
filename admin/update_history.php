<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
<link href="../js/jquery.fias.min.css" rel="stylesheet">
<script src="../js/jquery.fias.min.js" type="text/javascript"></script>
<script src="../libs/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="../css/index.css">
		
<?php $id = $_POST['id_news'];?>
<?php require_once("connection.php");?>
<?php 
	$sql = "SELECT * from news where id_news='".$id."'";
	$query = mysqli_query($bd, $sql);
	$row = mysqli_fetch_array($query);
 ?>
	<div class="content">
	<div id="result"></div>
		<div class="blocks_info">
			<div style="border: 1px solid #c7c7c7;">
			   	 <form method="post" enctype="multipart/form-data" action="scripts/change_preview_img.php" target="preview" >
					  <?php echo '<input type="hidden" name="oldphoto" value="'.$row['news_img'].'">' ?>
					  <?php echo '<input type="hidden" name="idnew" value="'.$row['id_news'].'">' ?>
					   <label for="upload">Выберите изображение для изменения превью</label><br>
					   <input type="file" name="upload" id="upload"><br>	
						<button type="submit">Обновить изображение</button>
					</form><br><br>
						<iframe name="preview" style="display: none;"></iframe>
				</div><br>
				<div>
					<label>Редактирование публикации в категории "Истории успеха"</label><br>
					<?php echo '<input type="text" id="news_title" value="'.$row['news_title'].'" placeholder="Введите название публикации">';?>
					<label>Дата публикации</label><br>
					<?php echo '<input type="date" id="news_date" value="'.$row['news_date'].'"><br><br>';?>
					<?php
						$textnew = htmlspecialchars($row['news_text']);
						echo '<textarea id="editor1" name="editor1">'.$textnew.'</textarea>';
						echo "<script>
			                CKEDITOR.replace('editor1');
			            </script>";?>
			    	<input type="hidden" value="0" id="user_id"><br><br>
			    	<?php echo '<input type="hidden" id="idnew" value="'.$row['id_news'].'">' ?>
				<button onclick="edit_new()">Обновить публикацию</button>
			</div>
		</div>
	</div>

<script>
	function edit_new() {
		var title = $('#news_title').val();
		var daten = $('#news_date').val();
		var iduser =$('#user_id').val();
		var idnew = $('#idnew').val();
		var news = CKEDITOR.instances['editor1'].getData();
		
	 //post variables
	        jQuery.ajax({
            type: "POST", // HTTP метод  POST или GET
            url: "scripts/change_new.php", //url-адрес, по которому будет отправлен запрос
            dataType:"text", // Тип данных,  которые пришлет сервер в ответ на запрос ,например, HTML, json
            data:{"news_title" : title, "idnew" : idnew, "news_date" : daten, "iduser" : iduser, "news" : news}, //данные, которые будут отправлены на сервер (post переменные)
            success:function(html){
           		 $('#result').html(html);
        	},
            error:function (xhr, ajaxOptions, thrownError){
                alert(thrownError); //выводим ошибку
            }
        });
	}	

</script>