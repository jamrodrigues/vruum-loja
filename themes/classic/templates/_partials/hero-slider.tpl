{if $hero_slides}
<div class="vrumm-hero-slick">
  {foreach from=$hero_slides item=slide}
    <div class="vrumm-hero-slide" style="background-image:url('{$slide.image_url|escape:'html':'UTF-8'}')">
      <div class="vrumm-hero-slide-content">
        <h3>{$slide.title|escape:'html':'UTF-8'}</h3>
        {$slide.description nofilter}
      </div>
    </div>
  {/foreach}
</div>
<script>
{literal}
  (function () {
    function initVrummHeroSlick() {
      if (typeof jQuery === 'undefined' || !jQuery.fn.slick) {
        return setTimeout(initVrummHeroSlick, 100);
      }
      jQuery('.vrumm-hero-slick').slick({
        dots: true,
        arrows: true,
        infinite: true,
        speed: 500,
        autoplay: true,
        autoplaySpeed: 6000,
        slidesToShow: 1,
        slidesToScroll: 1,
        adaptiveHeight: false
      });
    }
    document.addEventListener('DOMContentLoaded', initVrummHeroSlick);
  })();
{/literal}
</script>
{/if}
