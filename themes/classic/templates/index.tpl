{**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 *}
{extends file='page.tpl'}

    {block name='page_content_container'}
      <section id="content" class="page-home">
        {block name='page_content_top'}
          {$HERO_SLIDER nofilter}
          <div class="vrumm-trust-bar">
            <div class="vrumm-trust-item"><i class="material-icons">&#xE558;</i> Envio para todo o Brasil</div>
            <div class="vrumm-trust-item"><i class="material-icons">&#xE8A1;</i> Pix, boleto ou cartão</div>
            <div class="vrumm-trust-item"><i class="material-icons">&#xE897;</i> Compra 100% segura</div>
            <div class="vrumm-trust-item"><i class="material-icons">&#xE310;</i> Atendimento rápido</div>
            <div class="vrumm-trust-item"><i class="material-icons">&#xE8D5;</i> Troca garantida em 7 dias</div>
          </div>

          <div class="vrumm-category-banners">
            <a class="vrumm-category-banner vrumm-category-banner--freios" href="{$link->getCategoryLink(4)}">
              <span class="vrumm-category-banner-eyebrow">Peças de precisão</span>
              <span class="vrumm-category-banner-title">Freios</span>
              <span class="vrumm-category-banner-cta">Comprar agora</span>
            </a>
            <a class="vrumm-category-banner vrumm-category-banner--capacetes" href="{$link->getCategoryLink(7)}">
              <span class="vrumm-category-banner-eyebrow">Segurança em primeiro lugar</span>
              <span class="vrumm-category-banner-title">Capacetes</span>
              <span class="vrumm-category-banner-cta">Comprar agora</span>
            </a>
            <a class="vrumm-category-banner vrumm-category-banner--pneus" href="{$link->getCategoryLink(10)}">
              <span class="vrumm-category-banner-eyebrow">Aderência e durabilidade</span>
              <span class="vrumm-category-banner-title">Pneus</span>
              <span class="vrumm-category-banner-cta">Comprar agora</span>
            </a>
          </div>
        {/block}

        {block name='page_content'}
          {block name='hook_home'}
            {$HOOK_HOME nofilter}
          {/block}
        {/block}
      </section>
    {/block}
