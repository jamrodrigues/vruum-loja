<?php
/**
 * Baixa fotos de referência (paulinhomotos.com.br, mesma fonte usada para
 * compor o catálogo de teste) e associa como imagem de capa de cada produto
 * criado por scripts/seed_test_catalog.php.
 * Uso: php scripts/import_seed_photos.php (rodar da raiz do projeto).
 *
 * As fotos são de terceiros — usar só como placeholder de desenvolvimento,
 * nunca em produção sem direito de uso.
 */

require_once __DIR__ . '/../config/config.inc.php';

// id_product => URL da foto de referência (vazio = sem correspondência boa no site de referência)
$photoMap = [
    11 => 'https://paulinhomotos.fbitsstatic.net/img/p/256737/capacete-pro-tork-new-liberty-three-aberto-fosco-70199/256737.jpg',
    12 => 'https://paulinhomotos.fbitsstatic.net/img/p/296358/capacete-pro-tork-v-pro-jet-3-articulado-91114/296358-1.jpg',
    13 => 'https://paulinhomotos.fbitsstatic.net/img/p/284948/capacete-gp-tech-a118-sv-mono-articulado-87223/284948-1.jpg',
    14 => 'https://paulinhomotos.fbitsstatic.net/img/p/jaqueta-x11-veler-88473/287119.jpg',
    15 => 'https://paulinhomotos.fbitsstatic.net/img/p/luva-x11-blackproof-79430/273116.jpg',
    16 => 'https://paulinhomotos.fbitsstatic.net/img/p/calca-alpinestars-andes-v4-drystar-88326/286840.jpg',
    17 => 'https://paulinhomotos.fbitsstatic.net/img/p/suporte-celular-smartphone-garra-ferro-sem-carregador-87833/286067.jpg',
    18 => 'https://paulinhomotos.fbitsstatic.net/img/p/capa-moto-termica-piracapas-preta-92663/298064-1.jpg',
    19 => 'https://paulinhomotos.fbitsstatic.net/img/p/trava-disco-pequena-gp-tech-7102-77827/269826.jpg',
    20 => 'https://paulinhomotos.fbitsstatic.net/img/p/pneu-pirelli-mt60-90-90-21-54h-tt-80438/274401.jpg',
    21 => 'https://paulinhomotos.fbitsstatic.net/img/p/pneu-metzeler-cruisetec-130-70-18-tl-front-79980/273943.jpg',
    22 => 'https://paulinhomotos.fbitsstatic.net/img/p/camara-ar-pirelli-mh-17-biz-dianteiro-71618/258718.jpg',
    23 => 'https://paulinhomotos.fbitsstatic.net/img/p/bau-stoned-38l-preto-88275/286779.jpg',
    24 => 'https://paulinhomotos.fbitsstatic.net/img/p/base-fixacao-bau-glider-28-33-35-40-litros-92329/297672-1.jpg',
    25 => 'https://paulinhomotos.fbitsstatic.net/img/p/rack-do-bau-braz-superior-universal-85343/281608.jpg',
    26 => 'https://paulinhomotos.fbitsstatic.net/img/p/oleo-honda-4t-original-10w30-89195/287975.jpg',
    27 => 'https://paulinhomotos.fbitsstatic.net/img/p/oleo-motul-motylgear-75w90-1l-87341/285321-2.jpg',
    28 => 'https://paulinhomotos.fbitsstatic.net/img/p/oleo-corrente-jerod-100-ml-92483/297841-1.jpg',
    29 => '', // Caixa de Som Bluetooth — sem correspondência no site de referência
    30 => 'https://paulinhomotos.fbitsstatic.net/img/p/trava-disco-com-alarme-gp-tech-zx7104-media-72644/260146.jpg',
    31 => 'https://paulinhomotos.fbitsstatic.net/img/p/carregador-usb-moto-com-acendedor-it-blue-92157/297500-1.jpg',
    32 => 'https://paulinhomotos.fbitsstatic.net/img/p/kit-chave-mod-security-lock-givi-sl101-87985/286344.jpg',
    33 => '', // Macaco Central — sem correspondência no site de referência
    34 => 'https://paulinhomotos.fbitsstatic.net/img/p/vela-ngk-dpr9ea9-cbr1000f-74020/262260.jpg',
    35 => 'https://paulinhomotos.fbitsstatic.net/img/p/lampada-farol-stallion-2-led-h4-12w-universal-84417/280134-1.jpg',
    36 => 'https://paulinhomotos.fbitsstatic.net/img/p/pisca-factor-valplas-cristal-92140/297483-1.jpg',
    37 => 'https://paulinhomotos.fbitsstatic.net/img/p/lente-lanterna-vermelha-falcon-92116/297459-1.jpg',
    38 => 'https://paulinhomotos.fbitsstatic.net/img/p/protetor-motor-givi-bmw-r1250-gs-2019-preto-78721/271835.jpg',
    39 => '', // Colete Refletivo — sem correspondência no site de referência
    40 => 'https://paulinhomotos.fbitsstatic.net/img/p/mesa-cadeado-guidao-cg-titan-fan-87160/284831.jpg',
];

function downloadImage(string $url): ?string
{
    if (!$url) {
        return null;
    }
    $tmpFile = tempnam(_PS_TMP_IMG_DIR_, 'PS');
    $ch = curl_init($url);
    $fp = fopen($tmpFile, 'wb');
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
    $ok = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    fclose($fp);

    if (!$ok || $httpCode !== 200 || filesize($tmpFile) < 500) {
        @unlink($tmpFile);
        return null;
    }

    return $tmpFile;
}

$imported = 0;
$skipped = 0;

foreach ($photoMap as $idProduct => $url) {
    $product = new Product((int) $idProduct);
    if (!Validate::isLoadedObject($product)) {
        fwrite(STDERR, "Produto {$idProduct} não encontrado\n");
        continue;
    }

    if (!$url) {
        echo "Produto {$idProduct} ({$product->name[1]}): sem foto de referência, mantendo placeholder padrão.\n";
        ++$skipped;
        continue;
    }

    $tmpFile = downloadImage($url);
    if (!$tmpFile) {
        fwrite(STDERR, "Falha ao baixar imagem do produto {$idProduct}: {$url}\n");
        ++$skipped;
        continue;
    }

    $image = new Image();
    $image->id_product = (int) $idProduct;
    $image->position = Image::getHighestPosition($idProduct) + 1;
    $image->cover = !Image::getCover($idProduct);

    if (!$image->add()) {
        fwrite(STDERR, "Falha ao criar registro de imagem para produto {$idProduct}\n");
        @unlink($tmpFile);
        continue;
    }

    $newPath = $image->getPathForCreation();
    $error = 0;

    if (!$newPath || !ImageManager::resize($tmpFile, $newPath . '.' . $image->image_format, null, null, 'jpg', false, $error)) {
        fwrite(STDERR, "Falha ao gravar imagem principal do produto {$idProduct} (erro {$error})\n");
        $image->delete();
        @unlink($tmpFile);
        continue;
    }

    foreach (ImageType::getImagesTypes('products') as $imageType) {
        ImageManager::resize(
            $tmpFile,
            $newPath . '-' . stripslashes($imageType['name']) . '.' . $image->image_format,
            $imageType['width'],
            $imageType['height']
        );
    }

    @unlink($tmpFile);
    $image->associateTo(Shop::getContextListShopID());

    ++$imported;
    echo "Produto {$idProduct} ({$product->name[1]}): foto importada (id_image {$image->id}).\n";
}

echo "\nConcluído: {$imported} fotos importadas, {$skipped} produtos sem foto (placeholder padrão).\n";
