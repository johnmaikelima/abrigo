<?php
// Arquivo de teste para verificar se o mail() funciona no Coolify

$to = 'johnpatrocinio1@gmail.com';
$subject = 'Teste de Email - IMS Manutenção';
$message = '<html><body><h1>Teste de Email</h1><p>Se você recebeu este email, o sistema está funcionando corretamente!</p></body></html>';
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n";
$headers .= "From: IMS Manutenção <contato@altusci.com.br>\r\n";

if (mail($to, $subject, $message, $headers)) {
    echo "✅ Email enviado com sucesso para $to<br>";
    echo "Verifique sua caixa de entrada (e spam)";
} else {
    echo "❌ Erro ao enviar email<br>";
    echo "O servidor pode não ter o sendmail configurado";
}

echo "<hr>";
echo "<h3>Informações do PHP:</h3>";
echo "Versão PHP: " . phpversion() . "<br>";
echo "Sistema: " . php_uname() . "<br>";
echo "Sendmail path: " . ini_get('sendmail_path') . "<br>";
?>
