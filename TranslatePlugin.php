<?php
add_action('plugins_loaded', function () {

    add_filter('gettext', function ($translated, $text, $domain) {

        // Lógica para Contagem do Carrinho
        if (preg_match('/^1\s+Course\s+in\s+Cart$/i', $text)) {
            return '1 item no carrinho';
        }
        if (preg_match('/^\d+\s+Courses\s+in\s+Cart$/i', $text)) {
            return 'Itens no carrinho';
        }

        // Mapa de Traduções Diretas
        $map = [
            // Cursos e Certificados
            'View Certificate'              => 'Ver Certificado',
            'You enrolled in this course on'=> 'Você se inscreveu neste curso em',
            'Certificate'                   => 'Certificado',
            'Last Updated'                  => 'Última atualização',
            'Total Enrolled'                => 'Total de inscritos',
            'What I will learn? '           => 'O que vou aprender?',
            'Course Curriculum'             => 'Currículo do curso',
            'Wishlist'                      => 'Lista de desejos',
            'Rating'                        => 'Avaliação',
            'Certificate of completion'     => 'Certificado de conclusão',
            'Course Progress'               => 'Progresso do Curso',
            'Share'                         => 'Compartilhar',
            'Download Certificate'          => 'Baixar certificado',

            // Meses
            'January'   => 'Janeiro',
            'February'  => 'Fevereiro',
            'March'     => 'Março',
            'April'     => 'Abril',
            'May'       => 'Maio',
            'June'      => 'Junho',
            'July'      => 'Julho',
            'August'    => 'Agosto',
            'September' => 'Setembro',
            'October'   => 'Outubro',
            'November'  => 'Novembro',
            'December'  => 'Dezembro',

            // Carrinho e Checkout
            'Cart'                  => 'Carrinho',
            'Checkout'              => 'Pagamento',
            'View Cart'             => 'Ver o carrinho',
            'Add to Cart'           => 'Adicionar ao carrinho',
            'Remove'                => 'Remover',
            'Summary'               => 'Resumo',
            'Summary:'              => 'Resumo',
            'Subtotal'              => 'Subtotal',
            'Subtotal:'             => 'Subtotal:',
            'Total'                 => 'Total',
            'Grand total'           => 'Total',
            'Grand Total'           => 'Total',
            'Proceed to checkout'   => 'Prosseguir para o pagamento',
            'Pay Now'               => 'Finalizar pedido',

            // Detalhes do Pedido
            'Order Details'     => 'Detalhes do pedido',
            'Billing Address'   => 'Endereço de cobrança',
            'Address'           => 'Endereço',
            'City'              => 'Cidade',
            'Postcode / ZIP'    => 'CEP',
            'Phone'             => 'Telefone',
            'Select Country'    => 'País',
            'Payment Method'    => 'Método de pagamento',

            // Cupons e Mensagens
            'Have a coupon?'    => 'Adicionar cupom',
            'Click here'        => 'Adicionar',
            'Add coupon code'   => 'Adicionar cupons',
            'Success'           => 'Sucesso',
            'The course was removed successfully' => 'O curso foi removido com sucesso',
            'No payment method found. Please contact the site administrator.' => 'Nenhum método de pagamento disponível. Entre em contato com o administrador.'
        ];

        return $map[$text] ?? $translated;

    }, 20, 3); 
});


//Tradução no Hardcode (via HTML)
add_action('template_redirect', function () {

    ob_start(function ($html) {

        // 1. Substituições Dinâmicas
        $html = preg_replace('/\b1\s+Course\s+in\s+Cart\b/i', '1 item no carrinho', $html);
        $html = preg_replace('/\b(\d+)\s+Courses\s+in\s+Cart\b/i', 'Itens no carrinho', $html);

        $replacements = [
            // Termos Gerais
            'Checkout'                  => 'Pagamento',
            'Cart'                      => 'Carrinho',
            'Wishlist'                  => 'Lista de desejos',
            'What I will learn?'        => 'O que vou aprender?',
            'Rating'                    => 'Avaliação',
            'Share'                     => 'Compartilhar',
            'Certificate of completion' => 'Certificado de conclusão',
            'Course Progress'           => 'Progresso do Curso',
            'Download Certificate'      => 'Baixar certificado',
            'View Certificate'          => 'Ver Certificado',
            
            // Mensagens
            'Success'                   => 'Sucesso',
            'The course was removed successfully' => 'O curso foi removido com sucesso',
            'No payment method found'   => 'Nenhum método de pagamento encontrado',
            'Proceed to checkout'       => 'Prosseguir para o pagamento',
            'Pay Now'                   => 'Finalizar pedido',
            'Have a coupon?'            => 'Adicionar cupom',
            'Add to Cart'               => 'Adicionar ao carrinho',

            // Meses 
            'January'   => 'Janeiro',
            'February'  => 'Fevereiro',
            'March'     => 'Março',
            'April'     => 'Abril',
            'May'       => 'Maio',
            'June'      => 'Junho',
            'July'      => 'Julho',
            'August'    => 'Agosto',
            'September' => 'Setembro',
            'October'   => 'Outubro',
            'November'  => 'Novembro',
            'December'  => 'Dezembro'
        ];

        foreach ($replacements as $search => $replace) {
            $html = preg_replace('/\b' . preg_quote($search, '/') . '\b/', $replace, $html);
        }

        return $html;
    });

});

// Garante que o buffer seja fechado corretamente no final da execução
add_action('shutdown', function () {
    if (ob_get_length()) {
        ob_end_flush();
    }
});