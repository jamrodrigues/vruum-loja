<?php
/**
 * Seed de catálogo de teste: ~10 categorias x 3 produtos, inspirado no mix de
 * categorias da Paulinho Motos (capacetes, vestuário, acessórios, pneus...).
 * Uso: php scripts/seed_test_catalog.php (rodar da raiz do projeto).
 * Produtos sem foto real caem no placeholder padrão do PrestaShop (base de teste).
 */

require_once __DIR__ . '/../config/config.inc.php';

const ID_LANG = 1;
const ID_SHOP = 1;
const ID_PARENT_CATEGORY = 2; // "Home" — mesma raiz de Filtros/Freios/Motor

$catalog = [
    'Capacetes' => [
        ['Capacete Pro Tork Liberty Three', 289.90],
        ['Capacete Fechado LS2 Rapid', 459.90],
        ['Capacete Aberto Zeus Z 395', 349.90],
    ],
    'Vestuário' => [
        ['Jaqueta Motociclista Impermeável X11', 399.90],
        ['Luva Motociclista Pro Tork Summer', 89.90],
        ['Calça Motociclista com Proteção', 329.90],
    ],
    'Acessórios' => [
        ['Suporte de Celular para Guidão', 49.90],
        ['Capa Protetora para Moto', 119.90],
        ['Trava Disco Antifurto', 69.90],
    ],
    'Pneus' => [
        ['Pneu Traseiro Pirelli Diablo 130/70-17', 459.00],
        ['Pneu Dianteiro Technic 90/90-19', 289.00],
        ['Câmara de Ar Reforçada Aro 18', 39.90],
    ],
    'Baús e Bauletos' => [
        ['Baú Traseiro 33 Litros Preto', 249.90],
        ['Bauleto Lateral Par 20 Litros', 319.90],
        ['Suporte Bagageiro Universal', 99.90],
    ],
    'Óleo e Lubrificantes' => [
        ['Óleo Motor 10W40 Semissintético 1L', 44.90],
        ['Óleo Mineral 20W50 1L', 24.90],
        ['Graxa para Corrente de Moto', 19.90],
    ],
    'Som e Eletrônica' => [
        ['Caixa de Som Bluetooth para Moto', 179.90],
        ['Alarme Automotivo para Moto', 149.90],
        ['Carregador USB Veicular para Guidão', 59.90],
    ],
    'Ferramentas' => [
        ['Kit Chaves Combinadas 8 Peças', 89.90],
        ['Macaco Central para Moto', 139.90],
        ['Chave de Vela Universal', 29.90],
    ],
    'Iluminação' => [
        ['Lâmpada LED H4 Farol de Moto', 69.90],
        ['Pisca LED Sequencial Par', 79.90],
        ['Lanterna Traseira LED Universal', 54.90],
    ],
    'Proteção e Segurança' => [
        ['Protetor de Motor Carenagem', 159.90],
        ['Colete Refletivo Motociclista', 44.90],
        ['Cadeado U-Lock Antifurto', 109.90],
    ],
];

function slugify(string $text): string
{
    return Tools::str2url($text);
}

$createdCategories = 0;
$createdProducts = 0;

foreach ($catalog as $categoryName => $products) {
    $category = new Category();
    $category->id_parent = ID_PARENT_CATEGORY;
    $category->active = 1;
    $category->name = [ID_LANG => $categoryName];
    $category->link_rewrite = [ID_LANG => slugify($categoryName)];
    $category->id_shop_default = ID_SHOP;

    if (!$category->add()) {
        fwrite(STDERR, "Falha ao criar categoria: {$categoryName}\n");
        continue;
    }

    $createdCategories++;
    echo "Categoria criada: {$categoryName} (id {$category->id_category})\n";

    foreach ($products as [$productName, $price]) {
        $product = new Product();
        $product->name = [ID_LANG => $productName];
        $product->link_rewrite = [ID_LANG => slugify($productName)];
        $product->price = $price;
        $product->id_tax_rules_group = 0;
        $product->id_category_default = (int) $category->id_category;
        $product->active = 1;
        $product->state = Product::STATE_SAVED;
        $product->visibility = 'both';
        $product->show_price = 1;
        $product->indexed = 0;

        if (!$product->add()) {
            fwrite(STDERR, "Falha ao criar produto: {$productName}\n");
            continue;
        }

        $product->addToCategories([$category->id_category]);
        StockAvailable::setQuantity($product->id_product, 0, 20, ID_SHOP);

        $createdProducts++;
        echo "  Produto criado: {$productName} (id {$product->id_product})\n";
    }
}

echo "\nConcluído: {$createdCategories} categorias, {$createdProducts} produtos.\n";
