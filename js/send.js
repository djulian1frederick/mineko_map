function open_dialog(id) {
        $('#messages').html('');
        var id_receiver = id;
            $.ajax({
                url: 'messages.php',
                type: "GET",
                dataType: "text",
                  data: {"id_receiver" : id_receiver},
                  success: function(html) {
                        $('#messages').html(html);
                        var block = document.getElementById("chat-block");
                        block.scrollTop = block.scrollHeight;
                    }
                });
}

function form_submit(id) {
    var thisform = document.querySelector('form');

$("#sendmessage").submit(function (e) { // Устанавливаем событие отправки для формы с id=sendmessage
           e.preventDefault();
            var form_data = new FormData(); // Собираем все данные из формы
                form_data.append('attach', thisform.attachment.files[0]);
                form_data.append('message', thisform.message.value);
                form_data.append('chat_id',thisform.chat_id.value);
            $.ajax({
                processData: false,
                contentType: false,
                type: 'POST', // Метод отправки
                url: "/editor/scripts/send_message.php", // Путь до php файла отправителя
                data: form_data,
                success: function () {
                    // Код в этом блоке выполняется при успешной отправке сообщения
                   $('#message').val('');
                   $('#attach').val(null);
                   $('#statusfile').text('Добавить файл');
                   setTimeout(function() {open_dialog(id);},1000);
                }
            });
        });
}

function file_exists() {
        alert('Файл прикреплен');
        $('#statusfile').text('Изменить файл');
}

$(function(){
  $('input#search-users').on('input', function(){
    var str = $(this).val().toLowerCase();
    if (str.length <= 1){
      $('ul#message-list li').show();
    }
    else {
      $('ul#message-list li').each(function(){
        if ($(this).text().toLowerCase().indexOf(str) < 0){
          $(this).hide();
        }
      });  
    }    
  });
});