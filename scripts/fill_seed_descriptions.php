<?php
/**
 * Preenche descrição curta e completa dos 30 produtos criados por
 * scripts/seed_test_catalog.php, pra dar uma ideia real de ficha de produto.
 * Uso: php scripts/fill_seed_descriptions.php (rodar da raiz do projeto).
 */

require_once __DIR__ . '/../config/config.inc.php';

const ID_LANG = 1;

$details = [
    11 => [
        'short' => 'Capacete aberto Pro Tork Liberty Three, leve e ventilado, ideal pro dia a dia na cidade.',
        'full' => '<p>O <strong>Capacete Pro Tork Liberty Three</strong> é aberto, leve e com viseira solar integrada — pensado pra quem roda todo dia na cidade e não abre mão de conforto.</p><ul><li>Casco em ABS de alta resistência</li><li>Viseira cristal com proteção UV</li><li>Forro interno removível e lavável</li><li>Certificado INMETRO</li></ul><p>Disponível pra retirada rápida no nosso centro ou envio pra todo o Brasil.</p>',
    ],
    12 => [
        'short' => 'Capacete fechado LS2 Rapid, proteção total com ótimo custo-benefício pra estrada e cidade.',
        'full' => '<p>O <strong>Capacete Fechado LS2 Rapid</strong> entrega proteção integral com acabamento premium, ideal pra quem roda em estrada e busca segurança sem abrir mão do visual esportivo.</p><ul><li>Casco em policarbonato injetado</li><li>Sistema de ventilação frontal e traseira</li><li>Viseira anti-risco com troca rápida</li><li>Certificado INMETRO</li></ul><p>Confira a tabela de numeração antes de comprar — trocamos sem burocracia em até 7 dias.</p>',
    ],
    13 => [
        'short' => 'Capacete aberto Zeus Z 395, design moderno e viseira ampla pro seu dia a dia.',
        'full' => '<p>O <strong>Capacete Aberto Zeus Z 395</strong> combina leveza e estilo, com viseira ampla que garante boa visibilidade em qualquer trajeto urbano.</p><ul><li>Casco em ABS injetado de alta resistência</li><li>Viseira ampla anti-embaçante</li><li>Regulagem de jugular micrométrica</li><li>Certificado INMETRO</li></ul><p>Pagamento via Pix, cartão ou boleto — compra 100% segura.</p>',
    ],
    14 => [
        'short' => 'Jaqueta X11 impermeável, com proteções e forro térmico removível pra rodar em qualquer clima.',
        'full' => '<p>A <strong>Jaqueta Motociclista Impermeável X11</strong> foi feita pra te proteger da chuva, do vento e das quedas — sem abrir mão do conforto no dia a dia.</p><ul><li>Tecido impermeável e respirável</li><li>Proteções removíveis em ombros e cotovelos (CE)</li><li>Forro térmico destacável</li><li>Bolsos impermeáveis e ajuste de cintura</li></ul><p>Confira a tabela de medidas antes de escolher o tamanho.</p>',
    ],
    15 => [
        'short' => 'Luva Pro Tork Summer, ventilada e com proteção nos nós dos dedos pro verão.',
        'full' => '<p>A <strong>Luva Motociclista Pro Tork Summer</strong> é ideal pros dias quentes: tecido ventilado, boa aderência no guidão e proteção nos pontos de maior impacto.</p><ul><li>Palma em courvin antiderrapante</li><li>Proteção rígida nos nós dos dedos</li><li>Punho ajustável com velcro</li><li>Compatível com telas touchscreen</li></ul><p>Disponível em vários tamanhos — veja a tabela de medidas.</p>',
    ],
    16 => [
        'short' => 'Calça motociclista com proteções removíveis em joelhos e quadris, resistente à abrasão.',
        'full' => '<p>A <strong>Calça Motociclista com Proteção</strong> é feita em tecido resistente à abrasão, com proteções removíveis que dão segurança extra sem perder o conforto pra andar o dia todo.</p><ul><li>Tecido reforçado nas áreas de maior atrito</li><li>Proteções removíveis em joelhos e quadris (CE)</li><li>Cintura ajustável e corte confortável</li><li>Compatível com a jaqueta via zíper de conexão</li></ul><p>Troca garantida em até 7 dias se o tamanho não servir.</p>',
    ],
    17 => [
        'short' => 'Suporte universal de celular pro guidão, fixação firme mesmo em terrenos irregulares.',
        'full' => '<p>O <strong>Suporte de Celular para Guidão</strong> prende o smartphone com firmeza no guidão, liberando o GPS sem risco de queda mesmo em buracos e lombadas.</p><ul><li>Garra ajustável para celulares de 4,5" a 7"</li><li>Rotação 360° pra ajustar o ângulo</li><li>Instalação sem ferramentas</li><li>Compatível com a maioria dos modelos de moto</li></ul><p>Instalação rápida — leve pra retirar e já sair rodando.</p>',
    ],
    18 => [
        'short' => "Capa protetora impermeável, protege contra sol, chuva e poeira quando a moto fica parada.",
        'full' => '<p>A <strong>Capa Protetora para Moto</strong> é feita em tecido impermeável e forrado, protegendo a pintura e os componentes contra sol, chuva e poeira.</p><ul><li>Tecido 100% impermeável com forro interno</li><li>Elástico nas bordas pra ajuste firme</li><li>Costura reforçada contra rasgos</li><li>Serve pra maioria das motos de até 250cc (confira o tamanho)</li></ul><p>Guarda em bolsa compacta inclusa.</p>',
    ],
    19 => [
        'short' => 'Trava de disco antifurto, trava simples e rápida de instalar, com lembrete sonoro.',
        'full' => '<p>A <strong>Trava Disco Antifurto</strong> bloqueia o disco de freio em segundos, dificultando o furto enquanto a moto fica estacionada.</p><ul><li>Corpo em liga de alumínio resistente</li><li>Trava de segurança com 2 chaves</li><li>Alça de lembrete pra não esquecer de retirar</li><li>Compacta — cabe no bolso da jaqueta</li></ul><p>Reforce a segurança combinando com o cadeado U-Lock.</p>',
    ],
    20 => [
        'short' => 'Pneu traseiro Pirelli Diablo 130/70-17, aderência esportiva pra pilotagem mais firme.',
        'full' => '<p>O <strong>Pneu Traseiro Pirelli Diablo 130/70-17</strong> entrega aderência esportiva em piso seco e molhado, com boa durabilidade pro uso diário e passeios mais firmes.</p><ul><li>Medida 130/70-17</li><li>Composto de borracha para maior aderência</li><li>Banda de rodagem otimizada pra escoamento de água</li><li>Instalação e balanceamento disponíveis na loja física</li></ul><p>Confira a compatibilidade com o modelo da sua moto antes de comprar.</p>',
    ],
    21 => [
        'short' => 'Pneu dianteiro Technic 90/90-19, custo-benefício pro uso urbano e misto.',
        'full' => '<p>O <strong>Pneu Dianteiro Technic 90/90-19</strong> é uma opção de ótimo custo-benefício pra quem roda no dia a dia entre cidade e estrada.</p><ul><li>Medida 90/90-19</li><li>Banda de rodagem versátil (uso misto)</li><li>Boa durabilidade pro uso diário</li><li>Instalação e balanceamento disponíveis na loja física</li></ul><p>Confira a compatibilidade com o modelo da sua moto antes de comprar.</p>',
    ],
    22 => [
        'short' => 'Câmara de ar reforçada aro 18, borracha espessa contra furos e perda de pressão.',
        'full' => '<p>A <strong>Câmara de Ar Reforçada Aro 18</strong> tem borracha mais espessa que a câmara comum, reduzindo o risco de furos e perda de pressão no dia a dia.</p><ul><li>Aro 18 — confira a medida compatível com seu pneu</li><li>Borracha reforçada de alta durabilidade</li><li>Válvula padrão já instalada</li><li>Recomendada pra quem roda bastante em terreno irregular</li></ul><p>Item simples, mas essencial pra evitar imprevistos na estrada.</p>',
    ],
    23 => [
        'short' => 'Baú traseiro 33 litros, cabe capacete fechado e dá segurança pra guardar seus itens.',
        'full' => '<p>O <strong>Baú Traseiro 33 Litros Preto</strong> tem espaço pra guardar capacete, jaqueta e itens do dia a dia com segurança, direto na garupa.</p><ul><li>Capacidade de 33 litros — cabe capacete fechado</li><li>Fechadura com 2 chaves</li><li>Estrutura resistente a impacto</li><li>Requer suporte/base de fixação compatível (vendido à parte)</li></ul><p>Combine com o Suporte Bagageiro Universal pra instalar na sua moto.</p>',
    ],
    24 => [
        'short' => 'Par de bauletos laterais, 20 litros cada, equilibram a carga nos dois lados da moto.',
        'full' => '<p>O <strong>Bauleto Lateral Par 20 Litros</strong> distribui a carga dos dois lados da moto, ideal pra quem viaja ou precisa de mais espaço no dia a dia.</p><ul><li>Par de bauletos com 20 litros cada</li><li>Material resistente a impacto e intempérie</li><li>Fechadura individual em cada lado</li><li>Requer suporte de fixação compatível (confira o modelo da sua moto)</li></ul><p>Fale com a gente pra conferir a compatibilidade antes de fechar o pedido.</p>',
    ],
    25 => [
        'short' => 'Suporte bagageiro universal, base firme pra instalar baú ou prender carga na garupa.',
        'full' => '<p>O <strong>Suporte Bagageiro Universal</strong> serve de base firme pra instalar baú traseiro ou simplesmente prender carga na garupa com segurança.</p><ul><li>Estrutura em aço com pintura anticorrosiva</li><li>Fixação nos pontos originais da moto (confira compatibilidade)</li><li>Suporta o peso de baús até 33 litros</li><li>Instalação disponível na loja física</li></ul><p>Pergunte pela instalação ao retirar seu pedido.</p>',
    ],
    26 => [
        'short' => 'Óleo de motor 10W40 semissintético, proteção e desempenho pro uso diário.',
        'full' => '<p>O <strong>Óleo Motor 10W40 Semissintético 1L</strong> protege o motor contra desgaste e mantém o desempenho em dia, recomendado pra troca periódica.</p><ul><li>Viscosidade 10W40</li><li>Fórmula semissintética</li><li>Indicado pra motos 4 tempos (confira a especificação do fabricante)</li><li>Embalagem de 1 litro</li></ul><p>Troque a cada manutenção periódica — fale com a gente sobre o prazo ideal pro seu modelo.</p>',
    ],
    27 => [
        'short' => 'Óleo mineral 20W50, opção econômica pra manutenção periódica.',
        'full' => '<p>O <strong>Óleo Mineral 20W50 1L</strong> é a opção mais econômica pra manter a troca de óleo em dia sem pesar no bolso.</p><ul><li>Viscosidade 20W50</li><li>Fórmula mineral</li><li>Indicado pra motos 4 tempos de menor cilindrada (confira a especificação do fabricante)</li><li>Embalagem de 1 litro</li></ul><p>Troque a cada manutenção periódica — fale com a gente sobre o prazo ideal pro seu modelo.</p>',
    ],
    28 => [
        'short' => 'Graxa pra corrente, reduz atrito e prolonga a vida útil da transmissão.',
        'full' => '<p>A <strong>Graxa para Corrente de Moto</strong> lubrifica e protege a corrente contra ferrugem, reduzindo o desgaste e o barulho na transmissão.</p><ul><li>Fórmula aderente — não escorre com facilidade</li><li>Protege contra ferrugem e sujeira</li><li>Aplicação simples com bico dosador</li><li>Recomendado aplicar a cada 500 km rodados</li></ul><p>Mantenha a corrente lubrificada pra rodar com mais suavidade.</p>',
    ],
    29 => [
        'short' => "Caixa de som Bluetooth à prova d'água, música e chamadas direto do guidão.",
        'full' => '<p>A <strong>Caixa de Som Bluetooth para Moto</strong> toca suas músicas e atende chamadas direto do guidão, com resistência à água pros dias de chuva.</p><ul><li>Conexão Bluetooth com celular</li><li>Resistente a respingos de água (confira o índice IP)</li><li>Bateria recarregável via USB</li><li>Fixação no guidão incluída</li></ul><p>Sem foto real disponível no momento — imagem meramente ilustrativa.</p>',
    ],
    30 => [
        'short' => 'Alarme com sensor de movimento e controle remoto, mais segurança pra sua moto parada.',
        'full' => '<p>O <strong>Alarme Automotivo para Moto</strong> dispara em caso de movimento suspeito, afastando possíveis furtos enquanto a moto fica estacionada.</p><ul><li>Sensor de movimento e vibração</li><li>Controle remoto com alcance de até 15 metros</li><li>Sirene de alto volume</li><li>Instalação disponível na loja física</li></ul><p>Combine com a trava de disco pra uma segurança extra.</p>',
    ],
    31 => [
        'short' => 'Carregador USB pro guidão, mantém o celular carregado durante o trajeto.',
        'full' => '<p>O <strong>Carregador USB Veicular para Guidão</strong> conecta direto na bateria da moto e mantém seu celular carregado enquanto você usa o GPS ou ouve música.</p><ul><li>Saída USB com proteção contra sobrecarga</li><li>Resistente a respingos de água</li><li>Instalação simples, direto na bateria</li><li>Compatível com a maioria das motos</li></ul><p>Instalação disponível na loja física, se preferir.</p>',
    ],
    32 => [
        'short' => 'Kit com 8 chaves combinadas, essencial pra manutenção básica da moto.',
        'full' => '<p>O <strong>Kit Chaves Combinadas 8 Peças</strong> reúne as medidas mais usadas em manutenção básica de moto, pra ter sempre à mão em casa ou na bagagem.</p><ul><li>8 chaves combinadas em aço cromo-vanádio</li><li>Medidas de 8mm a 19mm</li><li>Acabamento resistente à corrosão</li><li>Vem em estojo organizador</li></ul><p>Útil pra pequenos reparos sem precisar ir até a oficina.</p>',
    ],
    33 => [
        'short' => 'Macaco central, facilita manutenção e troca de pneu levantando a moto com segurança.',
        'full' => '<p>O <strong>Macaco Central para Moto</strong> levanta a moto com estabilidade pra facilitar troca de pneu, lubrificação de corrente e outras manutenções.</p><ul><li>Estrutura em aço resistente</li><li>Base antiderrapante</li><li>Confira a compatibilidade de peso e modelo da sua moto</li><li>Uso recomendado em piso plano e firme</li></ul><p>Sem foto real disponível no momento — imagem meramente ilustrativa.</p>',
    ],
    34 => [
        'short' => 'Chave de vela universal, pra trocar a vela de ignição sem complicação.',
        'full' => '<p>A <strong>Chave de Vela Universal</strong> facilita a troca da vela de ignição em casa, sem precisar de ferramentas extras.</p><ul><li>Soquete com ímã interno pra não derrubar a vela</li><li>Compatível com as velas mais comuns do mercado</li><li>Cabo em aço resistente</li><li>Compacta — cabe no porta-objetos da moto</li></ul><p>Confira a medida da sua vela antes de comprar.</p>',
    ],
    35 => [
        'short' => 'Lâmpada LED H4, mais iluminação e durabilidade que a lâmpada halógena comum.',
        'full' => '<p>A <strong>Lâmpada LED H4 Farol de Moto</strong> entrega iluminação mais branca e potente que a halógena original, com vida útil muito maior.</p><ul><li>Soquete H4 (confira a compatibilidade do seu farol)</li><li>Temperatura de cor 6000K (luz branca)</li><li>Instalação plug-and-play</li><li>Vida útil muito superior à lâmpada halógena</li></ul><p>Instalação rápida — dá pra trocar você mesmo em poucos minutos.</p>',
    ],
    36 => [
        'short' => 'Par de piscas LED sequenciais, visual esportivo e boa visibilidade.',
        'full' => '<p>O <strong>Pisca LED Sequencial Par</strong> dá um visual mais esportivo à moto e melhora a visibilidade no trânsito com o efeito de acendimento sequencial.</p><ul><li>Par completo (lado esquerdo e direito)</li><li>Efeito sequencial de acendimento</li><li>Resistente a vibração e água</li><li>Pode exigir resistor/relé de LED (confira a compatibilidade)</li></ul><p>Instalação disponível na loja física, se preferir não fazer em casa.</p>',
    ],
    37 => [
        'short' => 'Lanterna traseira LED universal, mais visibilidade pra quem vem atrás.',
        'full' => '<p>A <strong>Lanterna Traseira LED Universal</strong> melhora a visibilidade da moto no trânsito, com acionamento mais rápido que a lâmpada comum.</p><ul><li>Acendimento instantâneo (LED)</li><li>Resistente a vibração e intempérie</li><li>Fixação universal — confira o encaixe da sua moto</li><li>Reduz o consumo elétrico comparado à lâmpada comum</li></ul><p>Boa opção pra quem quer mais segurança à noite.</p>',
    ],
    38 => [
        'short' => 'Protetor de motor, reduz avarias em quedas e tombos de baixa velocidade.',
        'full' => '<p>O <strong>Protetor de Motor Carenagem</strong> absorve impacto em quedas e tombos de baixa velocidade, protegendo motor e carenagem contra avarias.</p><ul><li>Estrutura em aço tubular resistente</li><li>Fixação nos pontos originais da moto</li><li>Confira a compatibilidade com o modelo da sua moto</li><li>Instalação disponível na loja física</li></ul><p>Um dos itens mais procurados por quem roda na cidade todo dia.</p>',
    ],
    39 => [
        'short' => 'Colete refletivo, mais visibilidade e segurança pra pilotar à noite ou com chuva.',
        'full' => '<p>O <strong>Colete Refletivo Motociclista</strong> aumenta sua visibilidade no trânsito, principalmente à noite ou em dias de chuva e neblina.</p><ul><li>Faixas refletivas de alta visibilidade</li><li>Tecido leve e respirável</li><li>Ajuste com velcro lateral</li><li>Veste por cima da jaqueta</li></ul><p>Sem foto real disponível no momento — imagem meramente ilustrativa.</p>',
    ],
    40 => [
        'short' => 'Cadeado U-Lock de alta resistência, proteção extra contra furto da moto parada.',
        'full' => '<p>O <strong>Cadeado U-Lock Antifurto</strong> é feito de aço endurecido, oferecendo resistência extra contra tentativas de corte e arrombamento.</p><ul><li>Corpo em aço endurecido</li><li>Trava de segurança com 2 chaves</li><li>Suporte de fixação incluso</li><li>Recomendado combinar com a trava de disco</li></ul><p>Mais uma camada de segurança pra sua moto ficar tranquila na rua.</p>',
    ],
];

$updated = 0;

foreach ($details as $idProduct => $content) {
    $product = new Product((int) $idProduct);
    if (!Validate::isLoadedObject($product)) {
        fwrite(STDERR, "Produto {$idProduct} não encontrado\n");
        continue;
    }

    $product->description_short = [ID_LANG => $content['short']];
    $product->description = [ID_LANG => $content['full']];

    if (!$product->update()) {
        fwrite(STDERR, "Falha ao atualizar descrição do produto {$idProduct}\n");
        continue;
    }

    ++$updated;
    echo "Produto {$idProduct}: descrições atualizadas.\n";
}

echo "\nConcluído: {$updated} produtos atualizados.\n";
