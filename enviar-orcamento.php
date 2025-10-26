<?php
// Configurações básicas
header('Content-Type: application/json; charset=utf-8');

// Configurações de email
$emailTo = 'orcamento@imsmanutencao.com.br';
$emailCC = 'johnpatrocinio1@gmail.com';
$emailFrom = 'contato@altusci.com.br';
$emailFromName = 'IMS Manutenção';

// Verificar se é uma requisição POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método não permitido']);
    exit;
}

// Receber dados do formulário
$data = json_decode(file_get_contents('php://input'), true);

// Validar dados obrigatórios
$required = ['nome', 'empresa', 'email', 'telefone', 'servico', 'mensagem'];
foreach ($required as $field) {
    if (empty($data[$field])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => "Campo obrigatório faltando: $field"]);
        exit;
    }
}

// Sanitizar dados
$nome = htmlspecialchars($data['nome']);
$empresa = htmlspecialchars($data['empresa']);
$email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
$telefone = htmlspecialchars($data['telefone']);
$servico = htmlspecialchars($data['servico']);
$cidade = htmlspecialchars($data['cidade'] ?? 'Não informado');
$mensagem = htmlspecialchars($data['mensagem']);

// Validar email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'E-mail inválido']);
    exit;
}

// Mapear tipos de serviço
$servicos = [
    'eletrica' => 'Manutenção Elétrica Industrial',
    'mecanica' => 'Manutenção Mecânica Industrial',
    'hidraulica' => 'Manutenção Hidráulica e Pneumática',
    'integridade' => 'Integridade Estrutural',
    'montagem' => 'Montagem de Equipamentos',
    'geradores' => 'Manutenção de Geradores',
    'paineis' => 'Montagem de Painéis Elétricos',
    'outro' => 'Outro'
];
$servicoNome = $servicos[$servico] ?? $servico;

// Criar corpo do e-mail em HTML
$assunto = "Nova Solicitação de Orçamento - $servicoNome";
$corpoEmail = "
<!DOCTYPE html>
<html lang='pt-BR'>
<head>
    <meta charset='UTF-8'>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: #f9fafb; padding: 30px; border: 1px solid #e5e7eb; }
        .field { margin-bottom: 20px; }
        .label { font-weight: bold; color: #1e40af; display: block; margin-bottom: 5px; }
        .value { background: white; padding: 10px; border-radius: 4px; border: 1px solid #e5e7eb; }
        .footer { background: #1f2937; color: white; padding: 15px; text-align: center; border-radius: 0 0 8px 8px; font-size: 12px; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h1>Nova Solicitação de Orçamento</h1>
        </div>
        <div class='content'>
            <div class='field'>
                <span class='label'>Nome Completo:</span>
                <div class='value'>$nome</div>
            </div>
            <div class='field'>
                <span class='label'>Empresa:</span>
                <div class='value'>$empresa</div>
            </div>
            <div class='field'>
                <span class='label'>E-mail:</span>
                <div class='value'>$email</div>
            </div>
            <div class='field'>
                <span class='label'>Telefone:</span>
                <div class='value'>$telefone</div>
            </div>
            <div class='field'>
                <span class='label'>Tipo de Serviço:</span>
                <div class='value'>$servicoNome</div>
            </div>
            <div class='field'>
                <span class='label'>Cidade:</span>
                <div class='value'>$cidade</div>
            </div>
            <div class='field'>
                <span class='label'>Mensagem / Descrição:</span>
                <div class='value'>$mensagem</div>
            </div>
        </div>
        <div class='footer'>
            <p>IMS Manutenção Industrial - Sistema de Orçamentos</p>
            <p>Data: " . date('d/m/Y H:i:s') . "</p>
        </div>
    </div>
</body>
</html>
";

// Enviar e-mail usando função mail() nativa do PHP
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n";
$headers .= "From: $emailFromName <$emailFrom>\r\n";
$headers .= "Cc: $emailCC\r\n";
$headers .= "Reply-To: $email\r\n";

if (mail($emailTo, $assunto, $corpoEmail, $headers)) {
    echo json_encode([
        'success' => true,
        'message' => 'Orçamento enviado com sucesso! Entraremos em contato em breve.'
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Erro ao enviar e-mail. Por favor, entre em contato pelo WhatsApp: (11) 99124-8868'
    ]);
}
?>
