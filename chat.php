<?php session_start();
	if(!isset($_SESSION['user_id']) or $_SESSION['user_id'] == NULL) {
		header('Location: ../index');
	}
?>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Внутренний чат</title>
	<link rel="stylesheet" href="../css/index.css">
	<link rel="stylesheet" href="../css/chat.css">
<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../js/send.js"></script>
</head>
<body>
	<?php include('header.php');?>	
<div class="container">
	<div class="message">
		
		<ul class="message-list" id="message-list">
			<span>Список пользователей</span>
			<div class="search-users">
			<input id="search-users" size="20" placeholder="Начните вводить имя пользователя" />
			<img src="img/search.png"></div>
				<?php require_once("admin/connection.php"); ?>
				<?php 
				$current_user = $_SESSION['user_id'];
				$sql_users_all = "SELECT id_user, first_name_user, second_name_user, user_login, last_name_user from users where second_name_user is not null or user_login is not null order by first_name_user desc"; 
					$user_all = mysqli_query($bd, $sql_users_all);
					$users_row = mysqli_fetch_array($user_all);

					$sql_cont_people = "SELECT contacts_people.id_user, users.id_user, first_name_con, second_name_con, last_name_con, user_login from contacts_people join users on contacts_people.id_user=users.id_user where contacts_people.id_user <> '".$_SESSION['user_id']."' and second_name_con is not null order by first_name_con desc";
					$cont_all = mysqli_query($bd, $sql_cont_people);
					$contacts_people_row = mysqli_fetch_array($cont_all);
						
					
						if ($users_row <> NULL || $contacts_people_row <> NULL){
							do {
								$mark_unread_sql = "SELECT is_read, id_receiver, id_sender from chat_messages join status_chat where chat_messages.id_message=status_chat.id_message and chat_messages.id_chat=status_chat.id_chat and id_receiver='".$_SESSION['user_id']."' and id_sender='".$users_row['id_user']."' and is_read='0'";
								$mark_unread_query = mysqli_query($bd, $mark_unread_sql);
								$mark_unread = mysqli_fetch_array($mark_unread_query);
								$user_id = $users_row['id_user'];
											if($user_id <> $current_user) {
											do {
												if($contacts_people_row['contacts_people.id_user'] == $user_id) {
														$cont_user_id = $contacts_people_row['id_user'];
														if($contacts_people_row['second_name_con'] <> NULL) {
															echo '<li class="message_man" onclick="open_dialog(this.id)" id="'.$contacts_people_row['id_user'].'">
															<img src="/img/account.png"> <p class="message-to">'.$contacts_people_row['first_name_con'].' '.$contacts_people_row['second_name_con'].'</p>';
															if($mark_unread['id_sender'] == $users_row['id_user']) { echo '* непрочитанные';}
															echo '</li>';
														}
												}
											}while($contacts_people_row=mysqli_fetch_array($cont_all));	
										if($users_row['second_name_user'] <> NULL || $users_row['user_login'] <> NULL ) {
											if($user_id <> $cont_user_id) {
											echo '<li class="message_man" onclick="open_dialog(this.id)" id="'.$users_row['id_user'].'">
												<img src="/img/account.png"><p class="message-to">'.$users_row['first_name_user'].' '.$users_row['second_name_user'].' '.$users_row['user_login'].'</p>';
											if($mark_unread['id_sender'] == $users_row['id_user']) { echo '* непрочитанные';}
											echo '</li>';}
										}
								}
							}while($users_row = mysqli_fetch_array($user_all));
						}

					?>			
			</ul>
			<div class="message-box" id="messages">
				
			</div>
	</div>
</div>
</body>
</html>
