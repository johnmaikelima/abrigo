# 📋 Template para Páginas de Informações

## 🎯 Como Usar o Template

1. **Copie o arquivo `_TEMPLATE.html`**
2. **Renomeie** para o slug da página (ex: `manutencao-mecanica-industrial.html`)
3. **Substitua os placeholders** marcados com `[TEXTO]`
4. **Adicione a imagem** correspondente na pasta `../images/`

## 📝 Placeholders para Substituir

### Meta Tags (Head)
- `[DESCRIÇÃO PARA SEO]` - Descrição curta (150-160 caracteres)
- `[PALAVRAS-CHAVE]` - Keywords separadas por vírgula
- `[TÍTULO DA PÁGINA]` - Título completo da página

### Conteúdo
- `[TÍTULO DO ARTIGO]` - H1 principal
- `[NOME-DA-IMAGEM]` - Nome do arquivo de imagem (sem caminho)
- `[ALT DA IMAGEM]` - Texto alternativo da imagem
- `[PARÁGRAFO INTRODUTÓRIO]` - Primeiro parágrafo (destaque)
- `[SEGUNDO PARÁGRAFO]` - Continuação da introdução
- `[TÍTULO DA SEÇÃO]` - Títulos de seções
- `[TEXTO]` - Conteúdo de texto
- `[Título do Card]` - Títulos dos cards
- `[Item 1], [Item 2]...` - Itens de lista
- `[TÍTULO DO CTA]` - Call to Action
- `[NOME DO SERVIÇO]` - Nome do serviço para a seção de regiões

## ✅ Estrutura Garantida

O template inclui:
- ✅ Grid 3fr/1fr funcionando
- ✅ Sidebar componentizado (carrega via JS)
- ✅ Seção de regiões com tabs funcionais
- ✅ CTA com gradiente
- ✅ Contato
- ✅ Responsive design
- ✅ SEO otimizado

## 🎨 Componentes Incluídos

1. **Hero** - Título + Imagem
2. **Introdução** - 2 parágrafos
3. **Seção Destacada** - Background cinza com lista
4. **Grid de Cards** - 3 colunas (responsivo)
5. **CTA** - Gradiente azul
6. **Contato** - Informações de contato
7. **Regiões** - 7 tabs interativas
8. **Sidebar** - Artigos relacionados (automático)

## 📦 Imagens Disponíveis

- `manutencao industrial.png`
- `manutencao industrial 2.png`
- `manutencao eletrica industrial.png`
- `manutencao eletrica industrial 2.png`
- `manutencao mecanica industrial.png`
- `manutencao em maquinas.png`

## 🔧 Customização

### Adicionar mais cards:
```html
<div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
    <h4 class="font-semibold text-lg mb-3 text-blue-600">Título</h4>
    <ul class="space-y-2 text-gray-700 list-disc pl-5">
        <li>Item</li>
    </ul>
</div>
```

### Adicionar seção:
```html
<h2 class="text-3xl font-bold text-gray-800 mb-4">Título</h2>
<p class="text-lg leading-relaxed mb-6">Texto</p>
```

## ⚠️ IMPORTANTE

- **NÃO remova** o `data-page-level="informacoes"` do body
- **NÃO remova** o `id="article-sidebar"` do aside
- **Mantenha** a estrutura do grid inline (style="display: grid...")
- **Use** `list-disc pl-5` para listas com bullets
- **NÃO use** `•` no texto (o CSS já adiciona)

## 🚀 Próximos Passos

1. Criar todas as páginas usando este template
2. Copiar conteúdo dos arquivos `.tsx` originais
3. Testar cada página
4. Ajustar conforme necessário
