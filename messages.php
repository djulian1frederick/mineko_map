<?php 
session_start();
require_once('admin/connection.php');
	$id_sender = $_SESSION['user_id'];
	$id_receiver = $_GET['id_receiver'];

	$nameuser_con = mysqli_query($bd,"SELECT contacts_people.id_user, users.id_user, first_name_con, second_name_con, last_name_con, user_login from contacts_people join users on contacts_people.id_user=users.id_user where contacts_people.id_user = '".$id_receiver."' and second_name_con is not null");
	$nameuser_user = mysqli_query($bd,"SELECT id_user, first_name_user, second_name_user, user_login, last_name_user from users where second_name_user is not null or user_login is not null and id_user='".$id_receiver."'");
	$nameuser_con_row = mysqli_fetch_array($nameuser_con);
	$nameuser_user_row = mysqli_fetch_array($nameuser_user);

	if($nameuser_con_row <> NULL) {
		$name = $nameuser_con_row['first_name_con'].' '.$nameuser_con_row['second_name_con'];
	}
	elseif ($nameuser_user_row <> NULL) {
		$name = $nameuser_user_row['first_name_user'].' '.$nameuser_user_row['second_name_user'];
	}

	$mark_unread_sql = "SELECT is_read, id_receiver, id_sender from chat_messages join status_chat where chat_messages.id_message=status_chat.id_message and chat_messages.id_chat=status_chat.id_chat and id_receiver='".$_SESSION['user_id']."' and id_sender='".$id_receiver."' and is_read='0'";
		$mark_unread_query = mysqli_query($bd, $mark_unread_sql);
		$mark_unread = mysqli_fetch_array($mark_unread_query);
	
if (isset($id_receiver)) {
	$login_receiver = mysqli_query($bd, "SELECT user_login from users where id_user='".$id_receiver."'");
	$login_receiver = mysqli_fetch_array($login_receiver);
	$login_receiver = $login_receiver['user_login'];
	
	$login_sender = mysqli_query($bd, "SELECT user_login from users where id_user='".$id_sender."'");
	$login_sender = mysqli_fetch_array($login_sender);
	$login_sender = $login_sender['user_login'];

	$name_chat=$login_sender."&".$login_receiver;
	$name_chat_chek_exists = $login_receiver."&".$login_sender;

	$check_chat_sql = "SELECT id_chat from chats where name_chat='".$name_chat_chek_exists."' or name_chat='".$name_chat."'";
	$check_chat_exists = mysqli_query($bd, $check_chat_sql);
	$name_chat_chek_exists_func = mysqli_fetch_array($check_chat_exists);
	
	if($name_chat_chek_exists_func == NULL) {

		$sql_create_chat = "INSERT into chats(name_chat, id_user_creator, id_user_receiver) values ('".$name_chat."','".$id_sender."', '".$id_receiver."')";
		$create_chat = mysqli_query($bd, $sql_create_chat);

		$thischat = mysqli_query($bd, "SELECT id_chat from chats where name_chat='".$name_chat."'");
		$thischat = mysqli_fetch_array($thischat);
		$thischat = $thischat['id_chat'];

	}
	else {
		$select_chat = "SELECT id_chat from chats where name_chat='".$name_chat."' or name_chat='".$name_chat_chek_exists."'";

		$select_chat = mysqli_query($bd, $select_chat);
		$select_chat = mysqli_fetch_array($select_chat);
		$thischat = $select_chat['id_chat'];
	}
		if ($mark_unread <> NULL) {
			$sql = "delete from status_chat where id_receiver='".$_SESSION['user_id']."' and id_chat='".$thischat."' and is_read='0'";
			$query = mysqli_query($bd, $sql);
	}

		$message_from_chat_sql = "SELECT message, attachment, date_create, id_sender, id_message from chat_messages where id_chat='".$thischat."' order by id_message";
		$message_from_chat_all =  mysqli_query($bd, $message_from_chat_sql);
		$message_from_chat = mysqli_fetch_array($message_from_chat_all);
		
		echo '<div class="box-with-message" style="position: relative;">
					<div>
						<ul class="chat-block" id="chat-block">';

		if($message_from_chat <> NULL){
			do {
					if($message_from_chat['id_sender'] == $id_receiver){
						echo '
					
								 <li>
									<div class="receiver">
										<div class="receiver-up">
											<div class="receiver-img">
												<img src="/img/user.png" alt="пользователь">
											</div>
											<div class="receiver-name">
												<p>'.$name.'<span>('.$message_from_chat['date_create'].')</span></p> 
											</div>
										</div>
										<div class="receiver-down">
											<div class="message-in-chat">									
												'.$message_from_chat['message'];	
											
												if($message_from_chat['attachment'] <> NULL) { echo '<br><a href="'.$message_from_chat['attachment'].'" target="window" id="preview_'.$message_from_chat['id_message'].'" onclick="show_preview(this.id)">Вложение к сообщению</a>';}
											echo'
											</div>
										</div>
									</div>
								</li>';
					}
					if($message_from_chat['id_sender'] == $_SESSION['user_id']){
						echo '	
								<li>
									<div class="sender">
										<div class="sender-up">
											<div class="sender-img">
												<img src="/img/user.png" alt="пользователь">
											</div>
											<div class="sender-name">
												<p>Вы <span>('.$message_from_chat['date_create'].')</span></p> 
											</div>
										</div>
										<div class="sender-down">
											<div class="message-in-chat">									
												'.$message_from_chat['message'];	
												
												if($message_from_chat['attachment'] <> NULL) { echo '<br><a href="'.$message_from_chat['attachment'].'" target="window" id="preview_'.$message_from_chat['id_message'].'" onclick="show_preview(this.id)">Вложение к сообщению</a>';}
											echo'
											</div>
										</div>
									</div>

								</li>';
							}
			}while($message_from_chat = mysqli_fetch_array($message_from_chat_all));
	}
	else {
		echo '<li class="no-message" style="padding: 25% 25% 0 25%;">Между Вами и выбранным пользователем нет сообщений</li>';
	}

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
									    <span class="title-file" id="statusfile">Добавить файл</span>
									    <input type="hidden" value="'.$thischat.'" name="chat_id">
									    <input type="file" name="attachment" id="attach" class="input-file" onchange="file_exists()">
							    </label>
							</div>
						<textarea name="message" id="message" placeholder="Напишите сообщение..."></textarea>
						</div>
						<div class="message-button">';
							
							echo
							'<button type="submit" onclick="form_submit(`'.$id_receiver.'`)">Отправить</button>
						</div>
					</form>
				</div>
		';
	}
?>
<script>
	function show_preview(id){
		var preview_href = document.getElementById(id).href;
		var href_changed = preview_href.substr(-4,4);
		if(href_changed == '.png' || href_changed == '.jpg' || href_changed == 'jpeg' || href_changed == 'webp'){
		$('#preview').show();}
	}
	function close_preview(){
		$('#preview').hide();
	}
</script>

<div class="popup-window-attach" id="preview" style="display: none;">
	<span class="close-preview" onclick="close_preview()">x</span>
	<iframe name="window"></iframe>
</div>

<style>
	.close-preview {
		font-weight: bolder;
		font-size: 28px;
		color: red;
		text-align: right;
		display: block;
		margin-left: auto;
		padding: 2.5px 15px;
		cursor: pointer;
	}
	.popup-window-attach {
		background: #fff;
		width: 40%;
		margin: 25% 20%;
		height: auto;
		max-height: 100%;
		top:  20%;
		position: fixed;
		border: 1px solid;
		margin: 0 auto;
		z-index: 555;
		left:  40%;
		text-align: center;
	}
	.popup-window-attach iframe {
		width: 80%;
		height: 400px;
		margin: 0 auto;
		padding: 20px;
	}
</style>
