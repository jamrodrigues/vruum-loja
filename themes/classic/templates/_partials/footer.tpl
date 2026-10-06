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
<div class="container">
  <div class="row">
    {block name='hook_footer_before'}
      {hook h='displayFooterBefore'}
    {/block}
  </div>
</div>
<div class="footer-container">
  <div class="container">
    <div class="row">
      {block name='hook_footer'}
        {hook h='displayFooter'}
      {/block}
    </div>
    <div class="row">
      {block name='hook_footer_after'}
        {hook h='displayFooterAfter'}
      {/block}
    </div>
    <div class="row">
      <div class="col-md-12">
        {block name='payment_methods'}
          <div class="payment-methods">
            <span class="payment-methods-label">Formas de pagamento:</span>
            <ul class="payment-methods-list">
              <li class="payment-badge">Pix</li>
              <li class="payment-badge payment-badge-img">
                <img src="/modules/mercadopago/views/img/mercadopago_big.png" alt="Mercado Pago" loading="lazy">
              </li>
              <li class="payment-badge">Boleto</li>
            </ul>
          </div>
        {/block}
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        {if $shop.registration_number}
          <p class="text-sm-center">
            CNPJ: {$shop.registration_number}
          </p>
        {/if}
        <p class="text-sm-center">
          © 2026 Todos os direitos autorais - Vruum Motos
        </p>
        <p class="text-sm-center">
          Desenvolvido por <a href="https://astrealabs.com.br" target="_blank" rel="noopener noreferrer">astrealabs.com.br</a>
        </p>
      </div>
    </div>
  </div>
</div>
<script>
{literal}
  (function () {
    function lookupCep(cepField) {
      var cep = cepField.value.replace(/\D/g, '');
      if (cep.length !== 8) {
        return;
      }

      var form = cepField.closest('form');
      if (!form) {
        return;
      }

      var address1 = form.querySelector('#field-address1');
      var address2 = form.querySelector('#field-address2');
      var city = form.querySelector('#field-city');

      fetch('https://brasilapi.com.br/api/cep/v2/' + cep)
        .then(function (response) {
          return response.ok ? response.json() : Promise.reject();
        })
        .then(function (data) {
          if (address1) {
            address1.value = data.street || address1.value;
          }
          if (address2) {
            address2.value = data.neighborhood || address2.value;
          }
          if (city) {
            city.value = data.city || city.value;
          }
        })
        .catch(function () {
          // CEP not found or API unreachable: leave fields as-is.
        });
    }

    function handle(event) {
      var target = event.target;
      if (target && target.id === 'field-postcode') {
        lookupCep(target);
      }
    }

    document.addEventListener('blur', handle, true);
    document.addEventListener('input', function (event) {
      var target = event.target;
      if (target && target.id === 'field-postcode' && target.value.replace(/\D/g, '').length === 8) {
        lookupCep(target);
      }
    });
  })();
{/literal}
</script>
