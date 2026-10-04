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
<div class="modal fade js-checkout-modal" id="modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="{l s='Close' d='Shop.Theme.Global'}">
        <span aria-hidden="true">&times;</span>
      </button>
      <div class="js-modal-content"></div>
    </div>
  </div>
</div>

<div class="text-sm-center">
  {if $tos_cms != false}
    <span class="d-block js-terms">{$tos_cms nofilter}</span>
  {/if}
  © 2026 Todos os direitos autorais - Vruum Motos
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
