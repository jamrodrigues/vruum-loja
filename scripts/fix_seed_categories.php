<?php
/**
 * Corrige id_category_default=0 deixado por scripts/seed_test_catalog.php
 * (Category::add()/Product::add() não populam id_category/id_product no
 * objeto nesta versão do PrestaShop — precisa reler via Db::Insert_ID() ou,
 * aqui, corrigir depois pelo mapeamento conhecido de criação).
 */

require_once __DIR__ . '/../config/config.inc.php';

const ID_SHOP = 1;

$mapping = [
    7 => [11, 12, 13],   // Capacetes
    8 => [14, 15, 16],   // Vestuário
    9 => [17, 18, 19],   // Acessórios
    10 => [20, 21, 22],  // Pneus
    11 => [23, 24, 25],  // Baús e Bauletos
    12 => [26, 27, 28],  // Óleo e Lubrificantes
    13 => [29, 30, 31],  // Som e Eletrônica
    14 => [32, 33, 34],  // Ferramentas
    15 => [35, 36, 37],  // Iluminação
    16 => [38, 39, 40],  // Proteção e Segurança
];

// Remove as associações erradas (id_category = 0) criadas pelo seed.
Db::getInstance()->delete('category_product', 'id_category = 0 AND id_product BETWEEN 11 AND 40');

$fixed = 0;
foreach ($mapping as $idCategory => $productIds) {
    foreach ($productIds as $idProduct) {
        $product = new Product($idProduct);
        if (!Validate::isLoadedObject($product)) {
            fwrite(STDERR, "Produto {$idProduct} não encontrado\n");
            continue;
        }

        $product->id_category_default = $idCategory;
        $product->update();
        $product->addToCategories([$idCategory]);

        $fixed++;
        echo "Produto {$idProduct} -> categoria {$idCategory}\n";
    }
}

echo "\nCorrigidos: {$fixed} produtos.\n";
