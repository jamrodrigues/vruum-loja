<?php
/**
 * Renders the homepage hero slider above "Compre por categoria" instead of
 * ps_imageslider's default spot (after the category grid, mixed in with
 * ps_featuredproducts/specials/etc via displayHome). Reuses the module's own
 * data model (Ps_HomeSlide / ps_homeslider_slides) and admin config screen,
 * but renders through our own Slick-powered template instead of the module's
 * Bootstrap-carousel markup — see themes/classic/templates/_partials/hero-slider.tpl.
 */
class IndexController extends IndexControllerCore
{
    public function initContent()
    {
        parent::initContent();

        $heroSlider = '';
        $imageSlider = Module::getInstanceByName('ps_imageslider');
        if ($imageSlider && $imageSlider->active) {
            $slides = $imageSlider->getSlides(true);

            $this->context->controller->registerJavascript(
                'vrumm-slick-js',
                'themes/classic/assets/js/vendor/slick.min.js',
                ['position' => 'bottom', 'priority' => 80]
            );
            $this->context->controller->registerStylesheet(
                'vrumm-slick-css',
                'themes/classic/assets/css/vendor-slick.css',
                ['media' => 'all', 'priority' => 80]
            );

            $this->context->smarty->assign('hero_slides', $slides);
            $heroSlider = $this->context->smarty->fetch('_partials/hero-slider.tpl');
        }

        $this->context->smarty->assign('HERO_SLIDER', $heroSlider);
    }
}
