<?php
/**
 * Renders the ps_imageslider module's real widget output as the homepage hero,
 * placed above "Compre por categoria" instead of its default spot (after the
 * category grid, mixed in with ps_featuredproducts/specials/etc via displayHome).
 * Calling renderWidget() directly reuses the module's own data model
 * (Ps_HomeSlide), admin config screen and front template/JS/CSS untouched.
 */
class IndexController extends IndexControllerCore
{
    public function initContent()
    {
        parent::initContent();

        $heroSlider = '';
        $imageSlider = Module::getInstanceByName('ps_imageslider');
        if ($imageSlider && $imageSlider->active) {
            $heroSlider = $imageSlider->renderWidget('displayHome');
        }

        $this->context->smarty->assign('HERO_SLIDER', $heroSlider);
    }
}
