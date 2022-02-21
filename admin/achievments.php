<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
<link href="../js/jquery.fias.min.css" rel="stylesheet">
<script src="../js/jquery.fias.min.js" type="text/javascript"></script>
<script src="../libs/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="../css/index.css">
		

<?php require_once("connection.php");?>
	<div id="resultative"></div>
	<div class="content">
		<div class="blocks_info">
			<div style="border: 1px solid #c7c7c7;">
			   	 <form method="post" enctype="multipart/form-data" action="scripts/upload_preview_img.php" target="preview" >
					   <label for="upload">Выберите изображение для создания превью</label><br>
					   <input type="file" name="upload" id="upload"><br>	
						<button type="submit">Добавить изображение</button>
					</form><br><br>
						<iframe name="preview" style="display: none;"></iframe>
				</div><br>
				<div>
					<label>Название для публикации в категории "Истории успеха"</label><br>
					<input type="text" id="news_title" placeholder="Введите название публикации"><br>
					<label>Дата публикации</label><br>
					<?php 
					$now_date = date("Y-m-d");
					echo '<input type="date" id="news_date" value="'.$now_date.'"><br><br>';?>
					<textarea id="editor1" name="editor1"></textarea>
						<script>
			                CKEDITOR.replace('editor1');
			            </script>
			    	<input type="hidden" value="0" id="user_id"><br><br>
				<button onclick="add_new()">Добавить публикацию</button>
			</div>
		</div>
	</div>

<script>
	
	function add_new() {
		var title = $('#news_title').val();
		var daten = $('#news_date').val();
		var iduser =$('#user_id').val();
		var news = CKEDITOR.instances['editor1'].getData();
		
	 //post variables
	        jQuery.ajax({
            type: "POST", // HTTP метод  POST или GET
            url: "scripts/add_new.php", //url-адрес, по которому будет отправлен запрос
            dataType:"text", // Тип данных,  которые пришлет сервер в ответ на запрос ,например, HTML, json
            data:{"news_title" : title, "news_date" : daten, "iduser" : iduser, "news" : news}, //данные, которые будут отправлены на сервер (post переменные)
            success:function(html){
           		 $('#resultative').html(html);
        	},
            error:function (xhr, ajaxOptions, thrownError){
                alert(thrownError); //выводим ошибку
            }
        });
	}	

</script>