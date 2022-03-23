<?php session_start(); ?>
<?php require_once('../connection.php'); ?>
<?php 
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';
?>
<?php 
	

	$all_email = mysqli_query($bd, "SELECT user_email from users where user_email <> NULL or user_email <> '-'");
	$rows_email = mysqli_fetch_array($all_email);
	do {
		$title = $_POST['title'];
		$body = $_POST['message'];
 		$email = $rows_email['user_email'];
 		$mail = new PHPMailer\PHPMailer\PHPMailer();
			try {
			    $mail->isSMTP();   
			    $mail->CharSet = "UTF-8";
			    $mail->SMTPAuth   = true;
			    #$mail->SMTPDebug = 4;
			    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

			    // Настройки вашей почты
			      $mail->Host       = 'smtp.yandex.ru'; // SMTP сервера вашей почты
			    $mail->Username   = 'export.catalog56@yandex.ru'; // Логин на почте
			    $mail->Password   = 'tulgcyelfttardja'; // Пароль на почте
			    $mail->SMTPSecure = 'ssl';
			    $mail->Port       = 465;
			    $mail->SMTPOptions = array (
			    'ssl' => array(
			    'verify_peer' => false,
			    'verify_peer_name' => false,
			    'allow_self_signed' => true)
			);
			    $mail->setFrom('export.catalog56@yandex.ru', 'Учетная запись'); // Адрес самой почты и имя отправителя
		    // Получатель письма
			   # var_dump($email_to);
			     $mail->addAddress($email); 
			// Отправка сообщения
			$mail->isHTML(true);
			$mail->Subject = $title;
			$mail->Body = $body;   
			}
			 catch (Exception $e) {
			    $result = "error";
			    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
			}
 		if ($mail->send()) {$result = "success"; 
 		$mail->clearAddresses();} 
	
	} while($rows_email = mysqli_fetch_array($all_email));

?>