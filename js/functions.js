function abort_operation() {
		$('#popup').hide();
	}
function show_popup(){
		$('#popup').show();

}
function yes_i_do() {
		document.location.href="logout";
}
function restore_password() {
		var email = $('#email').val();
		$.ajax({
		type: "POST", // HTTP метод  POST или GET
		            url: "../restore_password", //url-адрес, по которому будет отправлен запрос
		            dataType:"text", // Тип данных,  которые пришлет сервер в ответ на запрос ,например, HTML, json
		            data:{"email" : email}, //данные, которые будут отправлены на сервер (post переменные)
		            success:function(html){
		           		$("#result").html(html);
		        	},
		            error:function (xhr, ajaxOptions, thrownError){
		                alert(thrownError); //выводим ошибку
		            }
		});
}

function hide_modal() {
		setTimeout(function() {
	        $('#search_result').css("display", 'none');
		}, 1000);
}