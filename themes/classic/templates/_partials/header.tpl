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
{block name='header_banner'}
  <div class="header-banner">
  </div>
{/block}

{block name='header_nav'}
  <nav class="header-nav">
    <div class="container">
      <div class="row">
        <div class="hidden-sm-down">
          <div class="col-md-12 col-xs-12 vrumm-topbar-row">
            <div class="vrumm-topbar-contact">
              <a href="{$link->getPageLink('contact')}">Fale conosco</a>
              {if $modules.poscookielaw.whatsapp_number}
                <a href="https://wa.me/55{$modules.poscookielaw.whatsapp_number|regex_replace:'/[^0-9]/':''}" target="_blank" rel="noopener noreferrer" class="vrumm-topbar-whatsapp">
                  <i class="material-icons">&#xE0B0;</i> {$modules.poscookielaw.whatsapp_number}
                </a>
              {/if}
            </div>
          </div>
        </div>
        <div class="hidden-md-up text-sm-center mobile">
          <div class="float-xs-left" id="menu-icon">
            <i class="material-icons d-inline">&#xE5D2;</i>
          </div>
          <div class="float-xs-right" id="_mobile_cart"></div>
          <div class="float-xs-right" id="_mobile_user_info"></div>
          <div class="top-logo" id="_mobile_logo"></div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </nav>
{/block}

{block name='header_top'}
  <div class="header-top vrumm-header-main">
    <div class="container">
       <div class="row vrumm-header-main-row">
        <div class="col-md-2 hidden-sm-down" id="_desktop_logo">
          {if $shop.logo_details}
            {if $page.page_name == 'index'}
              <h1>
                {renderLogo}
              </h1>
            {else}
              {renderLogo}
            {/if}
          {/if}
        </div>
        <div class="vrumm-header-search hidden-sm-down">
          {hook h='displayBanner'}
        </div>
        <div class="vrumm-header-account hidden-sm-down">
          <a href="{$link->getModuleLink('poscompare', 'comparePage')}" class="vrumm-header-icon-link" title="Comparar produtos">
            <i class="material-icons">&#xE8D5;</i>
          </a>
          <a href="{$link->getModuleLink('poswishlist', 'mywishlist')}" class="vrumm-header-icon-link" title="Lista de favoritos">
            <i class="material-icons">&#xE87D;</i>
          </a>
          {hook h='displayNav2'}
        </div>
      </div>
      <div id="mobile_top_menu_wrapper" class="row hidden-md-up" style="display:none;">
        <div class="js-top-menu mobile" id="_mobile_top_menu"></div>
        <div class="js-top-menu-bottom">
          <div id="_mobile_currency_selector"></div>
          <div id="_mobile_language_selector"></div>
          <div id="_mobile_contact_link"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="vrumm-header-menu hidden-sm-down">
    <div class="container vrumm-menu-row">
      <div class="vrumm-menu-categories">
        {hook h='displayVegamenu'}
      </div>
      <div class="vrumm-menu-nav">
        {hook h='displayMegamenu'}
      </div>
    </div>
  </div>
  {hook h='displayNavFullWidth'}
{/block}
