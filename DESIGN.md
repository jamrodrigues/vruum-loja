---
name: Vrumm Motos
description: Loja virtual de peças de moto — preto asfalto e laranja alta-visibilidade, confiança transacional estilo marketplace BR
colors:
  primary: "#E65100"
  primary-light: "#FF6D00"
  primary-deep: "#BF360C"
  ink: "#1A1A1A"
  surface: "#FFFFFF"
  surface-alt: "#F0F0F0"
  text-on-ink: "#E0E0E0"
  text-on-ink-muted: "#B0B0B0"
  success: "#4CBB6C"
  danger: "#FF4C4C"
typography:
  display:
    fontFamily: "Plus Jakarta Sans, sans-serif"
    fontSize: "clamp(1.5rem, 3vw, 2.25rem)"
    fontWeight: 800
    lineHeight: 1.2
    letterSpacing: "normal"
  body:
    fontFamily: "Plus Jakarta Sans, sans-serif"
    fontSize: "15px"
    fontWeight: 500
    lineHeight: 1.5
    letterSpacing: "normal"
rounded:
  sm: "6px"
  md: "8px"
  lg: "12px"
spacing:
  sm: "8px"
  md: "16px"
  lg: "24px"
components:
  button-primary:
    backgroundColor: "{colors.primary}"
    textColor: "#FFFFFF"
    rounded: "{rounded.md}"
    padding: "12px 20px"
  button-primary-hover:
    backgroundColor: "{colors.primary-light}"
  product-price:
    textColor: "{colors.primary}"
  badge-discount:
    backgroundColor: "{colors.primary}"
    textColor: "#FFFFFF"
    rounded: "4px"
---

# Design System: Vrumm Motos

## 1. Overview

**Creative North Star: "A Pista Noturna"**

Vrumm Motos é uma loja de peças de moto pensada como painel de pista à noite: fundo preto-asfalto (#1A1A1A) contra laranja alta-visibilidade (#E65100), o mesmo par de cores da logo Vruumoto. A densidade de informação segue o marketplace brasileiro (Mercado Livre / Shopee), não o minimalismo europeu — cards grandes, chips de categoria, badge de desconto visível, preço em destaque. O cliente já sabe o que precisa; a interface existe pra confirmar rápido que a peça certa está ali, com estoque e forma de pagamento claras, e fechar a compra sem fricção.

O sistema explicitly rejeita: cara de loja WordPress genérica sem identidade própria, e também o extremo oposto — catálogo B2B frio de distribuidor, peça-em-fundo-branco sem contexto de marca.

**Key Characteristics:**
- Header e footer pretos (#1A1A1A), como uma pista à noite — o laranja é o farol.
- Preço sempre em laranja e bold; é o dado que mais importa numa decisão de compra rápida.
- Cards com sombra suave e cantos arredondados (12px), nunca chapados/quadrados.
- Badges (desconto, estoque, "NOVO") pequenos, sólidos, alto contraste.

## 2. Colors

Paleta comprometida (Committed): preto quase-total como base estrutural (header, footer, texto de marca) e um único laranja de alta saturação carregando toda a ação/conversão da tela.

### Primary
- **Laranja Vruumoto** (#E65100): cor de ação — botões, preço, links, badges, ícones de destaque. É a cor que "vende".
- **Laranja Claro / Hover** (#FF6D00): estado hover/active de tudo que usa a cor primária.
- **Laranja Profundo** (#BF360C): variante escura usada em estados pressed e em elementos que precisam de mais contraste sobre fundo claro.

### Neutral
- **Preto Asfalto** (#1A1A1A): background de header, footer e qualquer bloco "estrutural" da marca. Não é `#000` puro — tem leve suavidade.
- **Branco Cartão** (#FFFFFF): fundo de todo card de produto, formulário, superfície de conteúdo.
- **Cinza Base** (#F0F0F0): fundo geral de página (body), atrás dos cards.
- **Texto sobre Preto** (#E0E0E0 texto, #B0B0B0 texto secundário): usado em header/footer.

### Status (herdados do PrestaShop, mantidos)
- **Sucesso / Estoque** (#4CBB6C): badge "em estoque", confirmações.
- **Erro** (#FF4C4C): validação de formulário, indisponibilidade.

### Named Rules
**A Regra do Farol.** O laranja (#E65100) nunca é decorativo — todo uso dele é um convite à ação (comprar, ver mais, badge de urgência). Se não é clicável nem é preço, não é laranja.

## 3. Typography

**Display Font:** Plus Jakarta Sans (fallback sans-serif)
**Body Font:** Plus Jakarta Sans (fallback sans-serif)

**Character:** Família única, peso é quem carrega a hierarquia — de 500 (corpo) a 800 (títulos, preço). Geométrica o bastante pra ler como painel digital, sem ficar fria.

### Hierarchy
- **Display** (800, `clamp(1.5rem, 3vw, 2.25rem)`, 1.2): títulos de categoria/página (`h1`-`h3`), nome de produto na página de detalhe.
- **Title** (700, 16-18px, 1.3): título de card, nome curto de produto em listagem.
- **Body** (500, 15px, 1.5): texto corrido, descrição, formulário. Cap de ~70ch em blocos de descrição longa.
- **Label** (700, 11-12px, uppercase leve): categorias em chip, badges, rótulos de seção.

### Named Rules
**A Regra do Peso.** Nunca usar uma segunda família pra criar hierarquia — só peso (500→700→800) e tamanho. Duas fontes competindo lê como indecisão, não riqueza.

## 4. Elevation

Sistema majoritariamente flat com sombra suave só em cards clicáveis (produto, formulário) para separá-los do fundo cinza — não é decorativa, é o que distingue "isso é uma superfície tocável" de "isso é fundo de página".

### Shadow Vocabulary
- **card-rest** (`box-shadow: 0 2px 12px rgba(0,0,0,0.08)`): estado padrão de card de produto, formulário, popover.
- **cta-glow** (`box-shadow: 0 4px 16px rgba(230,81,0,0.35)`): botões de ação primária grandes (Adicionar ao carrinho, Finalizar Compra) — a sombra usa a própria cor laranja, reforçando "isso é o botão que importa".

### Named Rules
**A Regra do Brilho Laranja.** Só o botão de ação principal da tela ganha sombra colorida (`cta-glow`). Um único CTA glow por tela — se todo botão brilha, nenhum brilha.

## 5. Components

### Buttons
- **Shape:** cantos arredondados, 8px (`{rounded.md}`).
- **Primary:** fundo `#E65100`, texto branco, peso 700, padding `12px 20px`, sombra `cta-glow` quando é a ação principal da tela.
- **Hover / Focus:** fundo muda pra `#FF6D00`; sem mudança de tamanho/posição (nada de scale/translate chamativo).
- **Secondary / Ghost:** borda `1.5px solid #E65100`, fundo transparente, texto laranja — usado em ações secundárias (ex: "Ver detalhes do pedido").

### Chips (categoria, filtro)
- **Style:** fundo branco, borda transparente, sombra `card-rest`, texto escuro.
- **State:** selecionado = fundo `#FFF3E0` (laranja pálido), borda `1.5px solid #E65100`, texto laranja.

### Cards / Containers (produto)
- **Corner Style:** 12px (`{rounded.lg}`).
- **Background:** branco (`#FFFFFF`) sobre fundo cinza (`#F0F0F0`) de página.
- **Shadow Strategy:** `card-rest` em repouso; não escala no hover, só a sombra intensifica levemente.
- **Border:** nenhuma — a sombra já separa do fundo.
- **Internal Padding:** `{spacing.md}` (16px).

### Inputs / Fields
- **Style:** fundo branco, borda `1.5px solid` cinza-claro, cantos 8px.
- **Focus:** borda muda pra laranja (`#E65100`) + halo suave (`box-shadow: 0 0 0 3px rgba(230,81,0,0.12)`).
- **Error:** borda vermelha (`#FF4C4C`), mesma espessura.

### Navigation (header/footer)
- **Style:** fundo preto-asfalto (`#1A1A1A`) full-width, logo à esquerda, busca central, ícones (carrinho/conta) à direita em texto claro (`#E0E0E0`).
- **Default/hover:** links em `#E0E0E0`, hover vira laranja (`#E65100`), sem sublinhado.
- **Mobile:** busca e categoria colapsam em ícone; bottom nav (se usado, ver mockup do app) segue mesma paleta.

## 6. Do's and Don'ts

### Do:
- **Do** usar preço sempre em laranja bold (`#E65100`, peso 800) — é o dado mais importante da tela pro cliente que já sabe o que quer comprar.
- **Do** manter header/footer pretos (`#1A1A1A`) em toda página, front e categoria — é a identidade "Pista Noturna" que conecta site e futuro app.
- **Do** usar badges sólidos e pequenos (desconto, estoque, novo) — densidade de informação estilo Mercado Livre/Shopee é a referência, não minimalismo.
- **Do** aplicar `cta-glow` só no botão de ação principal de cada tela.

### Don't:
- **Don't** deixar a loja parecer "WordPress genérico sem identidade" — todo bloco estrutural (header, footer, banner) carrega preto+laranja da marca, nunca cinza neutro sem graça.
- **Don't** deixar a loja parecer "catálogo B2B frio de distribuidor" — produto sem contexto/vida, fundo branco puro sem card, sem badge, sem hierarquia de preço.
- **Don't** usar `border-left` colorido como indicador de status — usar badge sólido ou fundo tintado inteiro.
- **Don't** misturar uma segunda família tipográfica; hierarquia é só peso + tamanho da Plus Jakarta Sans.
- **Don't** aplicar sombra `cta-glow` em mais de um botão por tela.
