<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

require_once _PS_MODULE_DIR_ . 'mercadopago/includes/module/settings/AbstractSettings.php';

class HomologationSettings extends AbstractSettings
{
    public function __construct()
    {
        parent::__construct();
        $this->submit = null;
        $this->values = $this->getFormValues();
        $this->form = $this->generateForm();
    }

    /**
     * Generate inputs form
     *
     * @return array
     */
    public function generateForm()
    {
        $title = $this->module->l('Homologation', 'HomologationSettings');
        $fields = null;

        return $this->buildForm($title, $fields);
    }

    /**
     * Set values for the form inputs
     *
     * @return null
     */
    public function getFormValues()
    {
        return null;
    }
}
