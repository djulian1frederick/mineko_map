<?php 
	session_start();
	$thischat = $_SESSION['id_chat'];
	$id_receiver = $_POST['id_receiver'];
	if ($_POST['id_receiver'] == NULL) {
	$id_receiver = $_SESSION['id_receiver'];
	}

	echo '<div class="box-with-message">
					<div>
						<ul class="chat-block" id="chat-block">';

	echo '

						</ul>
					</div>
				</div>';
		echo '
				<div class="box-with-control">
					<form id="sendmessage" enctype="multipart/form-data">
						<div class="control-message">
						<div class="control-text-file">
							<div class="file-block">
							    <label class="label">
									    <img class="material-icons" src="/img/attachment.png"><br>
									    <span class="title-file">Добавить файл</span>
									    <input type="hidden" value="'.$thischat.'" name="chat_id">
									    <input type="file" name="attachment" class="input-file">
							    </label>
							</div>
						<textarea name="message" id="message" placeholder="Напишите сообщение..."></textarea>
						</div>
						<div class="message-button">
							<button type="submit" onclick="form_submit(`'.$id_receiver.'`)">Отправить</button>
						</div>
					</form>
				</div>
		';
?>

	<link rel="stylesheet" href="../css/chat.css">