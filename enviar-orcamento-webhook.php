<?php
// Versão alternativa usando webhook/API para ambientes como Coolify
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método não permitido']);
    exit;
}

// Receber dados
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

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'E-mail inválido']);
    exit;
}

// Mapear serviços
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

// Criar mensagem formatada para email
$emailBody = "
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: #f9fafb; padding: 30px; border: 1px solid #e5e7eb; }
        .field { margin-bottom: 15px; }
        .label { font-weight: bold; color: #1e40af; }
        .value { background: white; padding: 10px; border-radius: 4px; margin-top: 5px; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h1>Nova Solicitação de Orçamento</h1>
        </div>
        <div class='content'>
            <div class='field'>
                <div class='label'>Nome:</div>
                <div class='value'>$nome</div>
            </div>
            <div class='field'>
                <div class='label'>Empresa:</div>
                <div class='value'>$empresa</div>
            </div>
            <div class='field'>
                <div class='label'>E-mail:</div>
                <div class='value'>$email</div>
            </div>
            <div class='field'>
                <div class='label'>Telefone:</div>
                <div class='value'>$telefone</div>
            </div>
            <div class='field'>
                <div class='label'>Serviço:</div>
                <div class='value'>$servicoNome</div>
            </div>
            <div class='field'>
                <div class='label'>Cidade:</div>
                <div class='value'>$cidade</div>
            </div>
            <div class='field'>
                <div class='label'>Mensagem:</div>
                <div class='value'>$mensagem</div>
            </div>
            <p style='margin-top: 20px; color: #666; font-size: 12px;'>Data: " . date('d/m/Y H:i:s') . "</p>
        </div>
    </div>
</body>
</html>
";

// Tentar enviar usando SMTP via socket (mais confiável)
try {
    $to = 'orcamento@imsmanutencao.com.br';
    $cc = 'johnpatrocinio1@gmail.com';
    $subject = "Nova Solicitação de Orçamento - $servicoNome";
    
    // Usar mail() com headers corretos
    $headers = [
        'MIME-Version: 1.0',
        'Content-type: text/html; charset=utf-8',
        'From: IMS Manutenção <contato@altusci.com.br>',
        'Cc: ' . $cc,
        'Reply-To: ' . $email,
        'X-Mailer: PHP/' . phpversion()
    ];
    
    $success = mail($to, $subject, $emailBody, implode("\r\n", $headers));
    
    if ($success) {
        echo json_encode([
            'success' => true,
            'message' => 'Orçamento enviado com sucesso! Entraremos em contato em breve.'
        ]);
    } else {
        throw new Exception('Falha ao enviar email');
    }
    
} catch (Exception $e) {
    error_log("Erro ao enviar email: " . $e->getMessage());
    
    // Fallback: Salvar em arquivo como backup
    $logFile = 'orcamentos_backup.txt';
    $logData = "\n\n=== NOVO ORÇAMENTO - " . date('d/m/Y H:i:s') . " ===\n";
    $logData .= "Nome: $nome\n";
    $logData .= "Empresa: $empresa\n";
    $logData .= "Email: $email\n";
    $logData .= "Telefone: $telefone\n";
    $logData .= "Serviço: $servicoNome\n";
    $logData .= "Cidade: $cidade\n";
    $logData .= "Mensagem: $mensagem\n";
    
    file_put_contents($logFile, $logData, FILE_APPEND);
    
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Não foi possível enviar o email no momento. Por favor, entre em contato pelo WhatsApp: (11) 99124-8868',
        'fallback' => 'Seus dados foram salvos e entraremos em contato em breve.'
    ]);
}
?>
