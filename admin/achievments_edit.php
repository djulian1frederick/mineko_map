<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
<link href="../js/jquery.fias.min.css" rel="stylesheet">
<script src="../js/jquery.fias.min.js" type="text/javascript"></script>
<script src="../libs/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="../css/index.css">
		

<?php require_once("connection.php");?>
<div class="container">
	<div id="res"></div>
	<div class="content" style="min-width: 640px;">
		<p>Нажмите на название публикации, чтобы открыть редактор</p>
			<?php 
				$select = "SELECT news_title, id_news from news";
				$sql = mysqli_query($bd, $select);
				$row = mysqli_fetch_array($sql);
				if ($row <> NULL) {
				do { 
					echo '<div style="border: 1px solid #c7c7c7; padding: 5px; margin: 5px; width: fit-content;">
			   				<input type="hidden" id="id'.$row['id_news'].'" value="'.$row['id_news'].'">
			   				<span onclick="choose_new(`id'.$row['id_news'].'`)">'.$row['news_title'].'</span>
			  			 	<span onclick="delete_new(`id'.$row['id_news'].'`)"><img src="../img/delete.png" width="24px"></span>
						</div>';
					}while($row=mysqli_fetch_array($sql));
				}
			?>
	</div>
</div>
<script>
	
	function choose_new(id) {

		var id_news = id.substr(2);
		jQuery.ajax({
            type: "POST", // HTTP метод  POST или GET
            url: "update_history.php", //url-адрес, по которому будет отправлен запрос
            dataType:"text", // Тип данных,  которые пришлет сервер в ответ на запрос ,например, HTML, json
            data:{"id_news" : id_news}, //данные, которые будут отправлены на сервер (post переменные)
            success:function(html){
           		 $('#res').html(html);
           		 $('#res').html(html);
           		 $('#res').css('width', '110%');
        	},
            error:function (xhr, ajaxOptions, thrownError){
                alert(thrownError); //выводим ошибку
            }
        });
	}	
	function delete_new(id) {
		var id_news = id.substr(2);
		jQuery.ajax({
            type: "POST", // HTTP метод  POST или GET
            url: "scripts/delete_new.php", //url-адрес, по которому будет отправлен запрос
            dataType:"text", // Тип данных,  которые пришлет сервер в ответ на запрос ,например, HTML, json
            data:{"id_news" : id_news}, //данные, которые будут отправлены на сервер (post переменные)
            success:function(html){
           		 $('#res').html(html);
        	},
            error:function (xhr, ajaxOptions, thrownError){
                alert(thrownError); //выводим ошибку
            }
        });
	}	
</script>

<style> 
	span {
		cursor: pointer;
		height: 24px;
		border-bottom: 1px solid red;
	}
</style>