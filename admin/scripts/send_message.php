<?php
    session_start();

    require_once('../connection.php');
    require_once('../translit.php');

    $message = $_POST['message'];
    $message = mysqli_real_escape_string($bd,$message);
    $id_sender = $_SESSION['user_id'];
    $chat_id = mysqli_real_escape_string($bd,trim($_POST['chat_id']));
    $chat_id = $_POST['chat_id'];

    $date = date('d-m-Y');

    $sql_id_mess = "SELECT count(*) from chat_messages where id_chat='".$chat_id."'";

    $message_count  = mysqli_query($bd, $sql_id_mess);
    $message_count = mysqli_fetch_array($message_count);
    $id_message = $message_count['count(*)'];
    $id_message = intval($id_message);
    $id_message +=1;

    $exist_message_sql = mysqli_query($bd, "SELECT * from chat_messages where id_message ='".$id_message."' and id_chat='".$chat_id."'");
    $exist_message = mysqli_fetch_array($exist_message_sql);
    if($exist_message == NULL) { 
        if(isset($_FILES['attach'])) {
           if (is_uploaded_file($_FILES['attach']['tmp_name'])) {
            $name = $chat_id;
            $name_chat = "chat".$name;
            $size = 5024000;
            $newname= translit($_FILES['attach']['name']);
                    $fm ="/chats/".$name_chat."/";
                        mkdir($_SERVER['DOCUMENT_ROOT']."/chats/".$name_chat, 0777);
                    if ($_FILES['attach']['size'] > $size){die('Слишком большой размер файла.');}
                    move_uploaded_file($_FILES['attach']['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/chats/".$name_chat."/".$newname);
                    $attachment = "/chats/".$name_chat."/".$newname;

                    $types_images = array('image/gif', 'image/png', 'image/jpeg', 'image/jpg', 'image/webp');

                    if($message == NULL) {
                        if(in_array($_FILES['attach']['type'], $types_images)) {
                        $message = '<img src="'.$attachment.'" width="250px" height="auto">';
                        }
                        if(!in_array($_FILES['attach']['type'], $types_images)) {
                            $message = '<a href="'.$attachment.'">Вложение к сообщению</a>';
                        }
                    }
                                  
                    $sql_message = "INSERT into chat_messages (id_chat, id_message, id_sender, message, attachment, date_create) values ('".$chat_id."','".$id_message."','".$id_sender."','".$message."','".$attachment."','".$date."')";
            }
        }
        else {
            $sql_message = "INSERT into chat_messages (id_chat, id_message, id_sender, message, date_create) values ('".$chat_id."','".$id_message."','".$id_sender."','".$message."','".$date."')";
        }
        $add_message = mysqli_query($bd, $sql_message);
         if($add_message) {
            $receiver_sql = "SELECT id_user_creator, id_user_receiver, id_sender, id_message from chats join chat_messages on chat_messages.id_chat=chats.id_chat where chats.id_chat=chat_messages.id_chat and chats.id_chat='".$chat_id."' and chat_messages.id_sender='".$_SESSION['user_id']."' order by id_message asc limit 0,1";
            $receiver_q = mysqli_query($bd, $receiver_sql);
            $receiver = mysqli_fetch_array($receiver_q);

            if($receiver <> NULL) {
               if($receiver['id_sender'] == $_SESSION['user_id'] && $receiver['id_sender'] <> $receiver['id_user_receiver']){
                $check_men = $receiver['id_user_receiver'];}
                else {
                    $check_men = $receiver['id_user_creator'];
                }
            }   
            $add_status = mysqli_query($bd, "INSERT into status_chat (id_message, id_receiver, id_chat) values ('".$id_message."', '".$check_men."','".$chat_id."')");
         }
        // else { }
    }

?>