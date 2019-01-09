<?php

$name = $_POST['name'] ?? false;
$mail = $_POST['email'] ?? false;
$msg = $_POST['message'] ?? false;

$email = "alex.drobot22@gmail.com";
$subject = "Новый вопрос";
$headers = 'Content-type: text/html; charset=UTF-8';
$message = "Имя: $name<br/>Email: $mail<br/>Сообщение: $msg";

$ready = mail($email, $subject, $message, $headers);

if ($ready) echo "Успешно";
else echo "Произошла ошибка";
