<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
<link href="../js/jquery.fias.min.css" rel="stylesheet">
<script src="../js/jquery.fias.min.js" type="text/javascript"></script>
<script src="../libs/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="../css/index.css">
		
<div id="page">
<?php require_once("connection.php");?>
	
	<div class="content">
		<div class="blocks_info">
			<div id="resultative"></div>
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
			    	<input type="hidden" value="0" id="user_id">
				<div style="border: 1px solid #c7c7c7;">
			   	 	<form method="post" enctype="multipart/form-data" action="scripts/upload_preview_img.php" target="preview" >
					   	
					  	<div style="background: #fff;width: 100%;padding: 15px 0;text-align: center;">
					  		<label for="upload">Выберите изображение для создания превью</label><br>
					  		<input type="file" name="upload" id="upload">	
					  		<button type="submit" style="border-radius: 0;">Добавить изображение</button>
					  	</div>
						<div style="text-align:center;">
							<button onclick="add_new()" style="border-radius: 0;font-size: 20px;border: 1px solid;">Добавить публикацию</button>
						</div>
					</form>
						<iframe name="preview" style="display: none;height: 50px;"></iframe>
				
				</div>
			</div>
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
           		 alert('Успешно добавлено!');
           		 $('#page').load("achievments.php");
        	},
            error:function (xhr, ajaxOptions, thrownError){
                alert(thrownError); //выводим ошибку
            }
        });
	}	

</script>