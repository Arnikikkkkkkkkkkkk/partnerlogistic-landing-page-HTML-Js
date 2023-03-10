<?php
// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

// Переменные, которые отправляет пользователь
$family = $_POST['family'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$text = $_POST['text'];

// Формирование самого письма
$title = "Письмо с вашего сайта";
$body = "
<h2>Пиьсмо от $email</h2>
<b>Фамилия:</b> $family<br>
<b>Имя:</b> $name<br>
<b>Телефон:</b> $phone<br>
<b>Почта:</b> $email<br><br>
<b>Сообщение:</b><br>$text
";



// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки вашей почты
    $mail->Host       = 'smtp.yandex.ru'; // SMTP сервера вашей почты
    $mail->Username   = 'partnerlogistic20@yandex.ru'; // Логин на почте
    $mail->Password   = 'snobtohvlnviidsu'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('partnerlogistic20@yandex.ru', 'PARTNER LOGISTIC'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress('partnerlogistic20@mail.ru');  


// Отправка сообщения
$mail->isHTML(true);
$mail->Subject = $title;
$mail->Body = $body;    

// Проверяем отравленность сообщения
if ($mail->send()) {$result = "success";} 
else {$result = "error";}

} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
} 
// Отображение результата
echo json_encode(["result" => $result, "resultfile" => $rfile, "status" => $status]);

?>