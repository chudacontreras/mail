<?php
//Librerías para el envío de mail
include_once('class.phpmailer.php');
include_once('class.smtp.php');

//Recibir todos los parámetros del formulario
//$para = $_POST['email'];
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$mensaje = $_POST['mensaje'];
//$archivo = $_FILES['hugo'];
$para = 'correo_que_recibe@dominio.com';



//Este bloque es importante
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = "mail.host.com";
$mail->Port = 465;

//Nuestra cuenta
$mail->Username ='correo_que_envia@dominio.com';
$mail->Password = 'secret';

//Agregar destinatario
$mail->AddAddress($para);
$mail->FromName = $name;
$mail->From = $email;
$mail->Subject = $subject;
$mail->AddReplyTo($email);
$mail->Body = "Nombre: $name\n<br />"."Email: $email \n<br />". "Asunto: $subject \n<br />"."Mensaje: $mensaje";
//Para adjuntar archivo
$mail->AddAttachment($archivo['tmp_name'], $archivo['name']);
$mail->MsgHTML("Nombre: $name\n<br />"."Email: $email \n<br />". "Asunto: $subject \n<br />"."Mensaje: $mensaje");

//Avisar si fue enviado o no y dirigir al index
if($mail->Send())
{
	echo'<script>
			alert("Enviado Correctamente");
			window.location="/es/contact/form"
		 </script>';
}
else{
	echo'<script>
			alert("NO ENVIADO, intentar de nuevo");
			window.location="/es/contact/form"
		 </script>';
}
?>
