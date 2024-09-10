<?php

function xwear_shop_filter_handler() {

    $query_data = $_GET;

    $paged = isset($query_data['paged']) ? intval($query_data['paged']) : 1;
    $orderby = isset($query_data['orderby']) ? $query_data['orderby'] : 'date';
    $posts_per_page = get_option('woocommerce_catalog_columns') * get_option('woocommerce_catalog_rows');


    $terms = ($query_data['terms_query']) ? explode(',', $query_data['terms_query']) : '';

    $tax_query = ($terms) ? array(
        array(
            'taxonomy' => 'product_cat',
            'field' => 'id',
            'terms' => $terms,
        )
    ) : false;


    $prices = isset($query_data['meta_query']) ? explode(',', $query_data['meta_query']) : 0;
    $min_price = $prices ? $prices[0] : 0;
    $max_price = $prices ? $prices[1] : 0;

    $args = array(
        'post_type' => 'product',
        'paged' => $paged,
        'posts_per_page' => $posts_per_page,
        'tax_query' => $tax_query,
        'meta_query' => array(
            array(
                'key' => '_price',
                'value' => array($min_price, $max_price),
                'compare' => 'BETWEEN',
                'type' => 'NUMERIC',
            )
        ),
    );

    switch($orderby) {
        case 'date':
            $args['orderby'] = 'date';
            // $args['meta_key'] = 'date';
            $args['order'] = 'desc';
            break;
        case 'price':
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = '_price';
            $args['order'] = 'asc';
            break;
        case 'price-desc':
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = '_price';
            $args['order'] = 'desc';
            break;
        case 'popularity':
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'total_sales';
            $args['order'] = 'desc';
            break;
        case 'rating':
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = '_wc_average_rating';
            $args['order'] = 'desc';
            break;
    }

    // print_r($args);

    $loop = new WP_Query($args);

    // echo '<pre>';
    // print_r( $loop);
    // echo '</pre>';

    wc_set_loop_prop('current_page', $paged);
    wc_set_loop_prop('is_paginated', wc_string_to_bool(true));
    wc_set_loop_prop('page_template', get_page_template_slug());
    wc_set_loop_prop('per_page', $posts_per_page);
    wc_set_loop_prop('total', $loop->found_posts);
    wc_set_loop_prop('total_pages', $loop->max_num_pages);

    

    do_action( 'woocommerce_before_shop_loop' );
    
    woocommerce_product_loop_start();

    if($loop->have_posts()) {
        while ( $loop->have_posts() ) : $loop->the_post();
            wc_get_template_part('content', 'product');
        endwhile;
    } else {
        _e('Posts not found', 'xwear');
    }

    woocommerce_product_loop_end(); 

    do_action( 'woocommerce_after_shop_loop' );

    wp_reset_postdata();
    die();
};

?>

