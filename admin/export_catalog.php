<?php session_start();
	if(!isset($_SESSION['user_id']) or $_SESSION['user_id'] == NULL) {
		header('Location: ../index');
	}
?>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Поиск</title>
	<link rel="stylesheet" href="../css/index.css">
</head>
<body>
	<?php include('header.php');?>	
<div class="container">
	<div class="content">
        шлюшка-заглушка
        <button onclick="initiate_request()">Экспорт каталога</button>
	</div>
</div>
<script>

function initiate_request(){
    document.body.style.cursor = 'wait'
    send_request()
}

function send_request(){

fetch('http://localhost:8090/get_excel')
    .then(response => {
        document.body.style.cursor = 'default'
        if(!response.ok){
            console.log(`An error occured while trying to communicate with writer API\n${response.status}`)
        }
        return response.json()
    })
    .then(data =>{
        if(!data.err){

            var lnk = document.createElement('a'), e
            lnk.download = 'Экспорт_каталога.xlsx'
            lnk.href = `http://localhost/ex_data/${data.path}`
            console.log(lnk.href)
            if (document.createEvent){
                e = document.createEvent('MouseEvents')
                e.initMouseEvent('click', true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0,  null)
                lnk.dispatchEvent(e)

            } else if (lnk.fireEvent){
                lnk.dispatchEvent("onclick")
            }

            console.log(data)
        }
    })
}
</script>
</body>
</html>


