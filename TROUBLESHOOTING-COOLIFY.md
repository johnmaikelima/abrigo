# 🔧 Troubleshooting - Email no Coolify

## Problema Atual
O formulário de orçamento não está conseguindo enviar emails no ambiente Coolify.

## ✅ Soluções Implementadas

### 1. **Dois arquivos PHP criados:**
- `enviar-orcamento.php` - Versão principal com PHPMailer
- `enviar-orcamento-webhook.php` - Versão alternativa com `mail()` nativo

### 2. **Sistema de Fallback:**
O formulário tenta primeiro o PHP principal, se falhar, usa automaticamente o webhook.

### 3. **Backup de Segurança:**
Se ambos falharem, os dados são salvos em `orcamentos_backup.txt`

## 🚀 Como Resolver no Coolify

### Opção 1: Instalar PHPMailer (Recomendado)

```bash
# SSH no container do Coolify
cd /var/www/html/html5

# Instalar Composer se não tiver
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

# Instalar PHPMailer
composer require phpmailer/phpmailer
```

### Opção 2: Configurar SMTP no Container

Adicione estas variáveis de ambiente no Coolify:

```env
SMTP_HOST=altusci.com.br
SMTP_PORT=465
SMTP_USER=contato@altusci.com.br
SMTP_PASS=Vegas1992john@!!@#
SMTP_FROM=contato@altusci.com.br
```

### Opção 3: Usar Serviço Externo (Mais Confiável)

#### A) Resend (Recomendado)
1. Criar conta em https://resend.com
2. Obter API Key
3. Criar arquivo `enviar-orcamento-resend.php`:

```php
<?php
$apiKey = 'SUA_API_KEY_RESEND';

$data = [
    'from' => 'IMS Manutenção <onboarding@resend.dev>',
    'to' => ['orcamento@imsmanutencao.com.br', 'johnpatrocinio1@gmail.com'],
    'subject' => 'Nova Solicitação de Orçamento',
    'html' => $emailBody
];

$ch = curl_init('https://api.resend.com/emails');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $apiKey,
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);
?>
```

#### B) SendGrid
1. Criar conta em https://sendgrid.com
2. Obter API Key
3. Similar ao Resend

#### C) Mailgun
1. Criar conta em https://mailgun.com
2. Configurar domínio
3. Usar API

### Opção 4: Verificar Configuração do PHP

No Coolify, verifique se o PHP tem suporte a `mail()`:

```bash
# SSH no container
php -i | grep sendmail
php -i | grep mail
```

Se não tiver, instale:

```bash
apt-get update
apt-get install -y sendmail
```

## 🔍 Debug

### Ver logs de erro:

```bash
# No container Coolify
tail -f /var/log/apache2/error.log
# ou
tail -f /var/log/nginx/error.log
# ou
tail -f /var/www/html/html5/orcamentos_backup.txt
```

### Testar PHP manualmente:

```bash
php -r "mail('seu@email.com', 'Teste', 'Corpo do email');"
```

### Verificar se o arquivo existe:

```bash
ls -la /var/www/html/html5/enviar-orcamento*.php
```

## 📞 Solução Temporária

Enquanto o email não funciona, o formulário:
1. Tenta enviar email
2. Se falhar, oferece abrir WhatsApp automaticamente
3. Salva dados em arquivo de backup

## ✅ Checklist

- [ ] PHPMailer instalado?
- [ ] Porta 465 aberta no firewall?
- [ ] Credenciais SMTP corretas?
- [ ] PHP tem extensão `openssl` habilitada?
- [ ] Arquivo `enviar-orcamento.php` tem permissão de execução?
- [ ] Logs de erro verificados?

## 🎯 Recomendação Final

**Use um serviço externo como Resend ou SendGrid** - São mais confiáveis em ambientes containerizados como Coolify e têm melhor entregabilidade.

## 📧 Contato

Se precisar de ajuda adicional, entre em contato com o suporte do Coolify ou verifique a documentação oficial.
