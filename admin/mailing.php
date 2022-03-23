<?php session_start();
	if(!isset($_SESSION['user_id']) || $_SESSION['level'] <> 3) {
		header('Location: ../index');
	}
?>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Рассылка между участниками системы</title>
	<link rel="stylesheet" href="../css/index.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
    <link href="../js/jquery.fias.min.css" rel="stylesheet">
    <script src="../js/jquery.fias.min.js" type="text/javascript"></script>
    <script src="../libs/ckeditor/ckeditor.js"></script>
</head>
<body>
	<?php include('header.php');?>	
<div class="container">
	<div class="content">
        <div class="blocks_info">
        <p>Рассылка автоматически производится на все электронные адреса пользователей*</p>
                <label>Тема рассылки</label>
                <input type="text" placeholder="Введите тему рассылки" id="theme"><br><br>
                <label for="editor1">Содержимое рассылки</label>
                <textarea id="editor1" name="editor1"></textarea>
                            <script>
                                CKEDITOR.replace('editor1');
                </script>
                <button style="border-radius: 0;font-size: 16px;border: 1px solid; max-resolution: lef;t:auto;" onclick="mailtoall()" id="butt">Разослать</button>
                <div id="result_mailing">
                    
                </div>
	    </div>
    </div>
</div>
<?php require_once('footer.php'); ?>
</body>
</html>
<script>
    function mailtoall() {
        $('#butt').css("cursor", "wait");
        var title = $('#theme').val();
        var message = CKEDITOR.instances['editor1'].getData();
        
     //post variables
            jQuery.ajax({
            type: "POST", // HTTP метод  POST или GET
            url: "scripts/mailing_all.php", //url-адрес, по которому будет отправлен запрос
            dataType:"text", // Тип данных,  которые пришлет сервер в ответ на запрос ,например, HTML, json
            data:{"title" : title, "message" : message}, //данные, которые будут отправлены на сервер (post переменные)
            success:function(html){
                 $('#result_mailing').html(html);
            },
            error:function (xhr, ajaxOptions, thrownError){
                alert(thrownError); //выводим ошибку
            }
        });
    }   

</script>
<style>
    button:active
</style>

