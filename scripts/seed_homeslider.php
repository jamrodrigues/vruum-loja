<?php
/**
 * Configura o ps_imageslider (módulo nativo "Image Slider") com os 3 banners
 * da home, no lugar de reimplementar um slider na mão. Remove os 3 slides de
 * amostra do módulo e cria os nossos, com imagem real + link + legenda.
 * Uso: php scripts/seed_homeslider.php (rodar da raiz do projeto).
 */

require_once __DIR__ . '/../config/config.inc.php';
require_once _PS_MODULE_DIR_ . 'ps_imageslider/ps_imageslider.php';

const ID_LANG = 1;

$module = Module::getInstanceByName('ps_imageslider');
if (!$module) {
    fwrite(STDERR, "Módulo ps_imageslider não encontrado/instalado.\n");
    exit(1);
}

$imagesDir = _PS_MODULE_DIR_ . 'ps_imageslider/images/';

// Remove slides de amostra existentes (sample-1/2/3)
$existing = Db::getInstance()->executeS('SELECT id_homeslider_slides FROM ' . _DB_PREFIX_ . 'homeslider_slides');
foreach ($existing as $row) {
    $slide = new Ps_HomeSlide((int) $row['id_homeslider_slides']);
    if (Validate::isLoadedObject($slide)) {
        $slide->delete();
    }
}

$slides = [
    [
        'source' => __DIR__ . '/../themes/classic/assets/img/hero-banner-1.jpg',
        'filename' => 'vrumm-hero-1.jpg',
        'title' => 'Peça certa. Rápido.',
        'legend' => 'Vrumm Motos',
        'description' => '<p>Filtros, freios e motor — tudo pra moto rodar sem desculpa, com retirada rápida ou frete pra todo o Brasil.</p><a href="' . Context::getContext()->link->getBaseLink() . '3-filtros">Ver categorias</a>',
        'url' => Context::getContext()->link->getBaseLink() . '3-filtros',
    ],
    [
        'source' => __DIR__ . '/../themes/classic/assets/img/hero-banner-2.jpg',
        'filename' => 'vrumm-hero-2.jpg',
        'title' => 'Jaqueta X11 Impermeável',
        'legend' => 'Equipamento',
        'description' => '<p class="vrumm-slide-price">R$ 399,90 <span class="vrumm-slide-installment">ou 6x de R$ 66,65 sem juros</span></p><p>Impermeável, com proteções removíveis e forro térmico destacável.</p><a href="' . Context::getContext()->link->getBaseLink() . 'vestuario/14-jaqueta-motociclista-impermeavel-x11.html">Aproveitar oferta</a>',
        'url' => Context::getContext()->link->getBaseLink() . 'vestuario/14-jaqueta-motociclista-impermeavel-x11.html',
    ],
    [
        'source' => __DIR__ . '/../themes/classic/assets/img/hero-banner-3.jpg',
        'filename' => 'vrumm-hero-3.jpg',
        'title' => 'Capacete Liberty Three',
        'legend' => 'Oferta da semana',
        'description' => '<p class="vrumm-slide-price">R$ 289,90</p><p>Casco em ABS, viseira solar, certificado INMETRO. Por tempo limitado.</p><a href="' . Context::getContext()->link->getBaseLink() . 'capacetes/11-capacete-pro-tork-liberty-three.html">Aproveitar oferta</a>',
        'url' => Context::getContext()->link->getBaseLink() . 'capacetes/11-capacete-pro-tork-liberty-three.html',
    ],
];

$position = 1;
$created = 0;

foreach ($slides as $data) {
    if (!file_exists($data['source'])) {
        fwrite(STDERR, "Imagem não encontrada, pulando: {$data['source']}\n");
        continue;
    }

    copy($data['source'], $imagesDir . $data['filename']);

    $slide = new Ps_HomeSlide();
    $slide->position = $position++;
    $slide->active = 1;
    $slide->id_shop = (int) Context::getContext()->shop->id;
    $slide->title = [ID_LANG => $data['title']];
    $slide->legend = [ID_LANG => $data['legend']];
    $slide->description = [ID_LANG => $data['description']];
    $slide->url = [ID_LANG => $data['url']];
    $slide->image = [ID_LANG => $data['filename']];

    if (!$slide->add()) {
        fwrite(STDERR, "Falha ao criar slide: {$data['title']}\n");
        continue;
    }

    ++$created;
    echo "Slide criado: {$data['title']} (id {$slide->id})\n";
}

echo "\nConcluído: {$created} slides configurados no ps_imageslider.\n";
