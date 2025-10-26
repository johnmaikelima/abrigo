# Configuração de Email - IMS Manutenção

## 📧 Sistema de Envio de Orçamentos

O formulário de orçamento está configurado para enviar emails automaticamente usando PHP.

## ⚙️ Configurações

**Servidor de Email:**
- Host: `altusci.com.br`
- Porta: `465` (SSL)
- Usuário: `contato@altusci.com.br`
- Senha: `Vegas1992john@!!@#`
- Email de destino: `orcamento@imsmanutencao.com.br`

## 🚀 Instalação (Opcional - Recomendado)

### Opção 1: Com PHPMailer (Recomendado)

Para melhor compatibilidade e recursos avançados, instale o PHPMailer:

```bash
# No diretório html5, execute:
composer require phpmailer/phpmailer
```

### Opção 2: Sem PHPMailer

O sistema funciona automaticamente com a função `mail()` nativa do PHP se o PHPMailer não estiver disponível.

## 📝 Como Funciona

1. **Usuário preenche o formulário** em `solicitar-orcamento.html`
2. **JavaScript envia os dados** via AJAX para `enviar-orcamento.php`
3. **PHP processa e envia email** para `orcamento@imsmanutencao.com.br`
4. **Usuário recebe confirmação** na tela

## ✅ Verificação

Para testar se está funcionando:

1. Acesse a página de orçamento
2. Preencha o formulário
3. Clique em "Enviar Solicitação"
4. Verifique se recebeu o email em `orcamento@imsmanutencao.com.br`

## 🔒 Segurança

**IMPORTANTE:** As credenciais de email estão no arquivo `enviar-orcamento.php`. 

Para maior segurança em produção, considere:
- Mover as credenciais para um arquivo `.env` fora do diretório público
- Usar variáveis de ambiente do servidor
- Restringir acesso ao arquivo PHP

## 🛠️ Troubleshooting

### Email não está sendo enviado?

1. **Verifique se o PHP está instalado** no servidor
2. **Verifique os logs de erro** do PHP
3. **Teste a conexão SMTP** com o servidor de email
4. **Verifique se a porta 465 está aberta** no firewall
5. **Confirme as credenciais** de email

### Alternativa: Usar serviço de email

Se o servidor não suportar SMTP, considere usar:
- SendGrid
- Mailgun
- Amazon SES
- Gmail SMTP (para testes)

## 📞 Suporte

Em caso de problemas, entre em contato com o administrador do servidor ou verifique os logs em:
- `/var/log/apache2/error.log` (Apache)
- `/var/log/nginx/error.log` (Nginx)
- Logs do PHP configurados no `php.ini`
