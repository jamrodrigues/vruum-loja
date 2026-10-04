<?php
/**
 * Compõe o banner da Jaqueta GP Tech Vent: recorta o fundo branco da foto
 * de produto e compõe sobre um fundo de marca (preto + laranja), no mesmo
 * formato dos outros slides do homeslider. Texto (preço, 6x sem juros, CTA)
 * fica fora da imagem — vem do caption do slide (ps_imageslider), não
 * é "queimado" no banner.
 * Uso: php scripts/compose_jaqueta_banner.php
 */

$srcPath = 'C:\\Users\\james\\AppData\\Local\\Temp\\claude\\C--xampp-htdocs-vrumm\\7fba9240-4a4c-4496-ac72-072beecc8d6a\\scratchpad\\jaqueta\\jaqueta-gp-tech-vent.jpg';
$destPath = __DIR__ . '/../themes/classic/assets/img/hero-banner-2.jpg';

$canvasW = 1024;
$canvasH = 377;

// 1) Remove o fundo branco da foto do produto, gerando um PNG com alpha.
$product = imagecreatefromjpeg($srcPath);
$pw = imagesx($product);
$ph = imagesy($product);

$cutout = imagecreatetruecolor($pw, $ph);
imagealphablending($cutout, false);
imagesavealpha($cutout, true);
$transparent = imagecolorallocatealpha($cutout, 0, 0, 0, 127);
imagefill($cutout, 0, 0, $transparent);

for ($y = 0; $y < $ph; $y++) {
    for ($x = 0; $x < $pw; $x++) {
        $rgb = imagecolorat($product, $x, $y);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;

        // Distância até branco puro -> vira alpha (0 = opaco, 127 = transparente)
        $whiteness = min($r, $g, $b);
        if ($whiteness > 245) {
            $alpha = 127; // totalmente transparente
        } elseif ($whiteness > 225) {
            // transição suave pra evitar serrilhado
            $alpha = (int) (127 * (($whiteness - 225) / 20));
        } else {
            $alpha = 0; // opaco
        }

        $color = imagecolorallocatealpha($cutout, $r, $g, $b, $alpha);
        imagesetpixel($cutout, $x, $y, $color);
    }
}

imagedestroy($product);

// 2) Fundo de marca: preto à esquerda (legibilidade do texto), gradiente pra
//    laranja profundo à direita (onde o produto flutua).
$canvas = imagecreatetruecolor($canvasW, $canvasH);
$black = imagecolorallocate($canvas, 0x1A, 0x1A, 0x1A);
imagefill($canvas, 0, 0, $black);

$deepOrange = [0xBF, 0x36, 0x0C]; // #BF360C
$ink = [0x1A, 0x1A, 0x1A];
$gradientStartX = (int) ($canvasW * 0.45);

for ($x = $gradientStartX; $x < $canvasW; $x++) {
    $t = ($x - $gradientStartX) / ($canvasW - $gradientStartX);
    $r = (int) ($ink[0] + ($deepOrange[0] - $ink[0]) * $t);
    $g = (int) ($ink[1] + ($deepOrange[1] - $ink[1]) * $t);
    $b = (int) ($ink[2] + ($deepOrange[2] - $ink[2]) * $t);
    $col = imagecolorallocate($canvas, $r, $g, $b);
    imageline($canvas, $x, 0, $x, $canvasH - 1, $col);
}

// 3) Redimensiona o cutout pra caber no lado direito do canvas e compõe.
$targetH = (int) ($canvasH * 1.35); // um pouco maior que o canvas, sangrando nas bordas
$targetW = (int) ($pw * ($targetH / $ph));

$resized = imagecreatetruecolor($targetW, $targetH);
imagealphablending($resized, false);
imagesavealpha($resized, true);
$transparent2 = imagecolorallocatealpha($resized, 0, 0, 0, 127);
imagefill($resized, 0, 0, $transparent2);
imagecopyresampled($resized, $cutout, 0, 0, 0, 0, $targetW, $targetH, $pw, $ph);

$destX = $canvasW - $targetW + (int) ($targetW * 0.08);
$destY = (int) (($canvasH - $targetH) / 2);

imagealphablending($canvas, true);
imagecopy($canvas, $resized, $destX, $destY, 0, 0, $targetW, $targetH);

imagedestroy($cutout);
imagedestroy($resized);

imagejpeg($canvas, $destPath, 92);
imagedestroy($canvas);

echo "Banner composto salvo em: {$destPath} ({$canvasW}x{$canvasH})\n";
