<?php
/**
 * Gera os ícones (thumbnails) do menu de categorias do ps_mainmenu.
 * Convenção exigida pelo módulo: img/c/{id_category}-{n}_thumb.jpg
 * (ver modules/ps_mainmenu/ps_mainmenu.php, generateCategoriesMenu()).
 * Reaproveita fotos que já temos: categorias 3/4/5 usam a própria foto de
 * categoria; categorias 7-16 usam a foto de capa de um produto representante.
 * Uso: php scripts/make_menu_thumbs.php
 */

require_once __DIR__ . '/../config/config.inc.php';

const THUMB_SIZE = 120;

function imagePathForProductImage(int $idImage): string
{
    $folder = implode('/', str_split((string) $idImage)) . '/';

    return _PS_PRODUCT_IMG_DIR_ . $folder . $idImage . '.jpg';
}

function makeSquareThumb(string $srcPath, string $destPath, int $size): bool
{
    if (!file_exists($srcPath)) {
        fwrite(STDERR, "Origem não encontrada: {$srcPath}\n");

        return false;
    }

    $info = getimagesize($srcPath);
    if (!$info) {
        return false;
    }

    $src = imagecreatefromstring(file_get_contents($srcPath));
    if (!$src) {
        fwrite(STDERR, "Formato de imagem não suportado: {$srcPath}\n");

        return false;
    }
    $srcW = imagesx($src);
    $srcH = imagesy($src);

    // Crop central quadrado
    $cropSize = min($srcW, $srcH);
    $cropX = (int) (($srcW - $cropSize) / 2);
    $cropY = (int) (($srcH - $cropSize) / 2);

    $thumb = imagecreatetruecolor($size, $size);
    $white = imagecolorallocate($thumb, 255, 255, 255);
    imagefill($thumb, 0, 0, $white);
    imagecopyresampled($thumb, $src, 0, 0, $cropX, $cropY, $size, $size, $cropSize, $cropSize);

    imagejpeg($thumb, $destPath, 90);
    imagedestroy($src);
    imagedestroy($thumb);

    return true;
}

// categoria => caminho de origem
$sources = [
    3 => _PS_CAT_IMG_DIR_ . '3-category_default.jpg',
    4 => _PS_CAT_IMG_DIR_ . '4-category_default.jpg',
    5 => _PS_CAT_IMG_DIR_ . '5-category_default.jpg',
    7 => imagePathForProductImage(14),
    8 => imagePathForProductImage(17),
    9 => imagePathForProductImage(20),
    10 => imagePathForProductImage(23),
    11 => imagePathForProductImage(26),
    12 => imagePathForProductImage(29),
    13 => imagePathForProductImage(32),
    14 => imagePathForProductImage(34),
    15 => imagePathForProductImage(36),
    16 => imagePathForProductImage(39),
];

$done = 0;
foreach ($sources as $idCategory => $srcPath) {
    $destPath = _PS_CAT_IMG_DIR_ . "{$idCategory}-1_thumb.jpg";
    if (makeSquareThumb($srcPath, $destPath, THUMB_SIZE)) {
        ++$done;
        echo "Thumb criado: categoria {$idCategory} -> {$destPath}\n";
    }
}

echo "\nConcluído: {$done} thumbnails de menu criados.\n";
