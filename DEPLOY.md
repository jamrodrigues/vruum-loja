# Deploy pra produção — checklist

Loja pronta localmente. Quando for subir pro servidor de verdade, siga isso na ordem.

## 1. Levar os arquivos

Copia a pasta `vrumm/` inteira pro servidor (via FTP/SFTP ou git), **exceto**:
- `var/cache/*` (deixa vazio, ele regenera sozinho)
- `.git/` se não for usar git no servidor

## 2. Banco de dados

Exporta o banco local e importa no servidor:

```
mysqldump -u root vrumm > vrumm_producao.sql
```

No servidor, cria o banco e importa esse arquivo.

## 3. `app/config/parameters.php`

Editar esse arquivo no servidor com as credenciais do banco de produção (host, usuário, senha, nome do banco). **Não** copiar o arquivo local direto — as credenciais são diferentes.

## 4. Trocar domínio

Via admin (**Parâmetros da Loja > Geral**) ou direto no banco, trocar `localhost` pelo domínio real em:
- `ps_shop_url` (campo `domain` e `domain_ssl`)
- Configuração `PS_SHOP_DOMAIN` e `PS_SHOP_DOMAIN_SSL`

## 5. Regenerar o `.htaccess`

**Obrigatório** — o `.htaccess` atual foi gerado pro caminho local (`/vrumm/`), não serve pro servidor. No admin: **Parâmetros da Loja > Tráfego e SEO > Definições de SEO > Gerar arquivo .htaccess**.

## 6. HTTPS

Depois de instalar certificado SSL no servidor, ativar em **Parâmetros da Loja > Geral**:
- `PS_SSL_ENABLED` = Sim
- `PS_SSL_ENABLED_EVERYWHERE` = Sim

## 7. E-mail (importante — sem isso cliente não recebe confirmação/Pix)

Configurar SMTP real em **Parâmetros da Loja > E-mail**: hoje está usando `mail()` do PHP (só funciona local). Usar Gmail/SendGrid/etc com SMTP + senha de app.

## 8. Trocar a chave Pix de teste

Módulo **Pix** (Módulos > Pagamento) tem uma chave placeholder (`jameson.rodriguesx@gmail.com`). Trocar pela chave Pix real da loja antes de vender de verdade.

## 9. Revisar preço do frete Correios

Os valores de PAC/SEDEX que configurei são **estimativas** (por faixa de peso). Ajustar pros valores reais, ou futuramente conectar API dos Correios / Melhor Envio pra cálculo automático.

## 10. Segurança

- Trocar a senha do admin (`12345678` é só de desenvolvimento).
- Confirmar que a pasta admin continua com nome aleatório (já está: não é `/admin/` padrão).
- Apagar este arquivo (`DEPLOY.md`) e qualquer script solto na raiz depois do deploy, se sobrar algum.

## Requisitos do servidor

- PHP 8.1 a 8.3
- Extensões: `gd`, `intl`, `openssl`, `mbstring`, `pdo_mysql`, `curl`, `zip` (a maioria dos hosts já vem com isso)
- MySQL/MariaDB 5.7+ / 10.x

## O que NÃO precisa mexer

Tema, categorias, produtos, transportadoras (Correios/Retirada) e módulo Pix já estão configurados — sobem junto com o banco de dados, sem trabalho extra.
