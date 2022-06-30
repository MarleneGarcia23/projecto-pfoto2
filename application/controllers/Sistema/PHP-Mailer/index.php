<?php

use PHPMailer\PHPMailer\PHPMailer;


if (isset($_POST['email'])){ 
require_once 'vendor/autoload.php';

$mail= new PHPMailer;

$mail ->isSMTP();

$mail->SMTPDebug=0;

$mail->Host='smtp.gmail.com';
$mail->Port=587;
$mail->SMTPSecure='tls';
$mail->SMTPAuth=true;
$mail->Username='acesso.uan19@gmail.com';
$mail->Password='acesso_UAN_2019';

$mail->setFrom('acesso.uan19@gmail.com', 'SIGEA');
$mail->addReplyTo('acesso.uan19@gmail.com', 'SIGEA');
$mail->addAddress($_POST['email'], 'MN');

$mail->Subject='Exame de Acesso';
$mail->Body='Bem Vindo ao Exame de Acesso 2019';


if (!$mail->send()){
    echo "Erro ao ENviar Email".$mail->ErrorInfo;
}else{ 
    echo "Email enviado Para: ".$_POST['email'] ;
}
}
?>
<form action="" method="post">
    <input type="text" name="email" placeholder="Entre com o Email">
    <input type="submit" value="Mail me"> 
</form>