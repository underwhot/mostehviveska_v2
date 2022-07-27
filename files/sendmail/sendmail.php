<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';
	require 'phpmailer/src/SMTP.php';

	// Переменные, которые отправляет пользователь
	$name = $_POST['name'];
	$tel = $_POST['tel'];
	$email = $_POST['email'];
	$text = $_POST['text'];
	$file = $_FILES['myfile'];

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('ru', 'phpmailer/language/');
	$mail->IsHTML(true);

	
	$mail->isSMTP();                                            //Send using SMTP
	$mail->Host       = 'smtp.yandex.ru';                     //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	$mail->Username   = 'artvpart';                     //SMTP username
	$mail->Password   = 'acckyowdmzqucqet';                               //SMTP password
	$mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
	$mail->Port       = 465;                 
	

	//От кого письмо
	$mail->setFrom('artvpart@yandex.ru'); // Указать нужный E-mail
	//Кому отправить
	$mail->addAddress('artvpart@gmail.com'); // Указать нужный E-mail
	//Тема письма
	$mail->Subject = 'Заявка в сайта';

	// Формирование самого письма
	$title = "Заголовок письма";
	$body = "
	<h2>Новое письмо</h2>
	<b>Имя:</b> $name<br>
	<b>Телефон:</b> $tel<br>
	<b>Почта:</b> $email<br><br>
	";
	
	

	$mail->Body = $body;

	//Отправляем
	if (!$mail->send()) {
		$message = 'Ошибка';
	} else {
		$message = 'Данные отправлены!';
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>