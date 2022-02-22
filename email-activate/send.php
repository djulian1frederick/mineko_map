<?php
// Файлы phpmailer
require '/libs/phpmailer/PHPMailer.php';
require '/libs/phpmailer/SMTP.php';
require '/libs/phpmailer/Exception.php';


// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    //$mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки вашей почты
    $mail->Host       = 'smtp.mail.ru'; // SMTP сервера вашей почты
    $mail->Username   = 'ecat56@inbox.ru'; // Логин на почте
    $mail->Password   = 'FXm4ELCP5rJmgDmSX4ti'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('ecat56@inbox.ru', 'Учетная запись'); // Адрес самой почты и имя отправителя

    // Получатель письма
   # var_dump($email_to);
     $mail->addAddress($email); 

// Отправка сообщения
$mail->isHTML(true);
$mail->Subject = $title;
$mail->Body = $body;    
$mail->Address = $email;

// Проверяем отравленность сообщения
if ($mail->send()) {$result = "success";} 
else {$result = "error";}

} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

// Отображение результата

?>