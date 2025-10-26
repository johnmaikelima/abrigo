# 📧 Como Configurar EmailJS (Solução para Sites Estáticos)

## ⚠️ Problema Identificado

O Coolify está servindo apenas **arquivos estáticos** (HTML, CSS, JS) e **não executa PHP**.
Por isso, precisamos usar uma solução JavaScript que funciona direto do navegador.

## ✅ Solução: EmailJS (Gratuito e Simples)

EmailJS permite enviar emails diretamente do JavaScript sem backend.

### 📝 Passo a Passo:

#### 1. Criar Conta no EmailJS

1. Acesse: https://www.emailjs.com/
2. Clique em **"Sign Up"**
3. Crie sua conta (gratuita - 200 emails/mês)

#### 2. Adicionar Serviço de Email

1. No dashboard, vá em **"Email Services"**
2. Clique em **"Add New Service"**
3. Escolha **"Gmail"** (mais fácil) ou outro
4. Conecte sua conta Gmail: `johnpatrocinio1@gmail.com`
5. Anote o **Service ID** (ex: `service_abc123`)

#### 3. Criar Template de Email

1. Vá em **"Email Templates"**
2. Clique em **"Create New Template"**
3. Configure o template:

**Template Name:** `orcamento_ims`

**Subject:** `Nova Solicitação de Orçamento - {{servico}}`

**Content (HTML):**
```html
<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 600px; margin: 0 auto; }
        .header { background: #1e40af; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background: #f9fafb; }
        .field { margin-bottom: 15px; }
        .label { font-weight: bold; color: #1e40af; }
        .value { background: white; padding: 10px; border-radius: 4px; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Nova Solicitação de Orçamento</h1>
        </div>
        <div class="content">
            <div class="field">
                <div class="label">Nome:</div>
                <div class="value">{{nome}}</div>
            </div>
            <div class="field">
                <div class="label">Empresa:</div>
                <div class="value">{{empresa}}</div>
            </div>
            <div class="field">
                <div class="label">E-mail:</div>
                <div class="value">{{email}}</div>
            </div>
            <div class="field">
                <div class="label">Telefone:</div>
                <div class="value">{{telefone}}</div>
            </div>
            <div class="field">
                <div class="label">Serviço:</div>
                <div class="value">{{servico}}</div>
            </div>
            <div class="field">
                <div class="label">Cidade:</div>
                <div class="value">{{cidade}}</div>
            </div>
            <div class="field">
                <div class="label">Mensagem:</div>
                <div class="value">{{mensagem}}</div>
            </div>
            <p style="margin-top: 20px; color: #666; font-size: 12px;">
                Data: {{data_envio}}
            </p>
        </div>
    </div>
</body>
</html>
```

**Settings:**
- **To Email:** `orcamento@imsmanutencao.com.br`
- **Cc:** `johnpatrocinio1@gmail.com` (adicione no campo Cc)
- **Reply To:** `{{email}}`

4. Clique em **"Save"**
5. Anote o **Template ID** (ex: `template_xyz789`)

#### 4. Obter Public Key

1. Vá em **"Account"** → **"General"**
2. Copie sua **Public Key** (ex: `abc123xyz789`)

#### 5. Atualizar o Código

Abra o arquivo `solicitar-orcamento.html` e substitua:

```javascript
emailjs.init("YOUR_PUBLIC_KEY"); // Linha 479
```
Por:
```javascript
emailjs.init("abc123xyz789"); // Sua Public Key
```

E substitua:
```javascript
emailjs.send('YOUR_SERVICE_ID', 'YOUR_TEMPLATE_ID', templateParams)
```
Por:
```javascript
emailjs.send('service_abc123', 'template_xyz789', templateParams)
```

## 🎯 Exemplo Completo:

```javascript
// Inicializar EmailJS
(function(){
    emailjs.init("abc123xyz789"); // Sua Public Key
})();

// No handleSubmit
emailjs.send('service_abc123', 'template_xyz789', templateParams)
```

## ✅ Testar

1. Faça as alterações no código
2. Faça commit e push para o Coolify
3. Acesse o formulário de orçamento
4. Preencha e envie
5. Verifique os emails em:
   - `orcamento@imsmanutencao.com.br`
   - `johnpatrocinio1@gmail.com`

## 📊 Limites do Plano Gratuito

- ✅ 200 emails por mês
- ✅ Sem limite de templates
- ✅ Suporte a múltiplos destinatários

Se precisar de mais, o plano pago custa $15/mês para 1000 emails.

## 🔒 Segurança

- ✅ Public Key pode ser exposta (é segura)
- ✅ Não expõe credenciais de email
- ✅ Rate limiting automático
- ✅ Proteção contra spam

## 🆘 Problemas Comuns

### Email não chega?
1. Verifique spam/lixo eletrônico
2. Confirme que conectou o Gmail corretamente
3. Verifique os logs no dashboard do EmailJS

### Erro "User ID not found"?
- Você não inicializou o EmailJS com `emailjs.init()`

### Erro "Template not found"?
- Verifique se o Template ID está correto

## 📞 Suporte

- Documentação: https://www.emailjs.com/docs/
- Dashboard: https://dashboard.emailjs.com/

---

**Pronto!** Com isso, seu formulário vai funcionar perfeitamente no Coolify sem precisar de PHP! 🚀
