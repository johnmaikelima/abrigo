# IMS Manutenção - Versão HTML5

Esta é a versão em HTML5 puro do site IMS Manutenção, convertida do Next.js/React para HTML, CSS e JavaScript vanilla.

## Estrutura do Projeto

```
html5/
├── index.html              # Página inicial
├── sobre.html             # Página Sobre Nós
├── produtos.html          # Página de Produtos
├── solicitar-orcamento.html # Formulário de orçamento
├── css/
│   └── styles.css         # Estilos principais
├── js/
│   └── main.js           # JavaScript principal (header, footer, slider)
├── servicos/             # Páginas de serviços
│   ├── eletrica-industrial.html
│   ├── mecanica-industrial.html
│   ├── manutencao-hidraulica-pneumatica.html
│   └── integridade-estrutural.html
└── informacoes/          # Artigos informativos
    ├── manutencao-industrial.html
    ├── manutencao-eletrica-industrial.html
    └── ... (todas as páginas regionais)
```

## Características

- **100% HTML5, CSS3 e JavaScript Vanilla** - Sem frameworks ou bibliotecas externas
- **Responsivo** - Funciona em desktop, tablet e mobile
- **SEO Otimizado** - Meta tags apropriadas em cada página
- **Componentes Reutilizáveis** - Header e Footer carregados via JavaScript
- **Menu Dropdown** - Menus de Serviços e Informações com submenu
- **Slider de Imagens** - Hero slider na página inicial

## Como Usar

1. **Abrir localmente:**
   - Basta abrir o arquivo `index.html` em qualquer navegador moderno

2. **Servir via servidor web:**
   ```bash
   # Usando Python
   python -m http.server 8000
   
   # Usando Node.js (http-server)
   npx http-server
   
   # Usando PHP
   php -S localhost:8000
   ```

3. **Deploy:**
   - Faça upload de todos os arquivos para seu servidor web
   - Configure o servidor para servir `index.html` como página padrão
   - Certifique-se de que as imagens estão no caminho correto

## Páginas Criadas

### Principais
- ✅ Página Inicial (index.html)
- ⏳ Sobre Nós (sobre.html)
- ⏳ Produtos (produtos.html)
- ⏳ Solicitar Orçamento (solicitar-orcamento.html)

### Serviços
- ⏳ Elétrica Industrial
- ⏳ Mecânica Industrial
- ⏳ Manutenção Hidráulica e Pneumática
- ⏳ Integridade Estrutural

### Informações (Artigos)
- ⏳ Todas as páginas de informações do site original

## Próximos Passos

Para completar a conversão, você precisa:

1. Criar as páginas restantes seguindo o padrão do `index.html`
2. Ajustar os caminhos das imagens para o local correto
3. Adicionar formulários funcionais (com backend ou serviço de email)
4. Testar em diferentes navegadores
5. Otimizar imagens para web

## Customização

### Cores
As cores principais estão definidas em `css/styles.css` usando variáveis CSS:
```css
:root {
    --blue-900: #1e3a8a;
    --yellow-500: #eab308;
    /* ... */
}
```

### Menu
Para adicionar/remover itens do menu, edite o arquivo `js/main.js` na seção `headerHTML`.

### Estilos
Todos os estilos estão centralizados em `css/styles.css`. O CSS usa uma abordagem mobile-first com media queries para responsividade.

## Compatibilidade

- Chrome/Edge: ✅
- Firefox: ✅
- Safari: ✅
- IE11: ❌ (não suportado)

## Notas Importantes

1. **Imagens**: Ajuste os caminhos das imagens conforme sua estrutura de pastas
2. **Links**: Todos os links estão configurados para arquivos `.html`
3. **Formulários**: Precisam de backend para funcionar (PHP, Node.js, etc.)
4. **SEO**: Cada página tem suas próprias meta tags otimizadas

## Suporte

Para dúvidas ou problemas, consulte a documentação original do Next.js ou entre em contato com o desenvolvedor.
