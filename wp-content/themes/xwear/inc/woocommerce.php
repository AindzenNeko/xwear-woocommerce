<?php

add_action( 'after_setup_theme', 'xwear_photoswipe_gallery_setup' );

function xwear_photoswipe_gallery_setup() {
  add_theme_support( 'wc-product-gallery-zoom' );
//   add_theme_support( 'wc-product-gallery-lightbox' );
  add_theme_support( 'wc-product-gallery-slider' );
}

// Customize breadcrumbs

add_filter( 'woocommerce_breadcrumb_defaults', 'xwear_woocommerce_breadcrumbs' );
function xwear_woocommerce_breadcrumbs() {
    return array(
            'delimiter'   => '<span class="breadcrumbs__delimiter"> &#47; </span>',
            'wrap_before' => '<div class="breadcrubms__container"><nav class="breadcrumbs woocommerce-breadcrumb" itemprop="breadcrumb">',
            'wrap_after'  => '</nav></div>',
            'before'      => '',
            'after'       => '',
            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
        );
}

// Remove Sidebar on Shop page

remove_action('woocommerce_sidebar','woocommerce_get_sidebar', 10);

// Remove Taxonomy and Product archive description

remove_action('woocommerce_archive_description','woocommerce_taxonomy_archive_description', 10);
remove_action('woocommerce_archive_description','woocommerce_product_archive_description', 10);

// Customize Shop Template by hooks

add_action('woocommerce_after_main_content', 'xwear_woocommerce_shop_filters_template', 3);
function xwear_woocommerce_shop_filters_template() {
	if(is_shop()) {
		get_template_part( 'template-parts/shop-filters', 'none' );
	}
};

add_action('woocommerce_before_main_content', 'xwear_woocommerce_shop_wrapper_start', 40);
function xwear_woocommerce_shop_wrapper_start() {
	echo '<section class="shop__section">';
	echo '<div class="shop__container">';
};
add_action('woocommerce_after_main_content', 'xwear_woocommerce_shop_wrapper_end', 5);
function xwear_woocommerce_shop_wrapper_end() {
	echo '</div>';
	echo '</section>';
};

add_action('woocommerce_before_shop_loop', 'xwear_woocommerce_shop_loop_wrapper_start', 5);
function xwear_woocommerce_shop_loop_wrapper_start() {
	echo '<section class="catalog__section">';
};
add_action('woocommerce_after_shop_loop', 'xwear_woocommerce_shop_loop_wrapper_end', 15);
function xwear_woocommerce_shop_loop_wrapper_end() {
	echo '</section>';
};

remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
add_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
add_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 30);

add_action('woocommerce_before_shop_loop', 'xwear_woocommerce_before_shop_loop_start', 15);
function xwear_woocommerce_before_shop_loop_start() {
	echo '<div class="catalog__row">';
};
add_action('woocommerce_before_shop_loop', 'xwear_woocommerce_before_shop_loop_title', 17);
function xwear_woocommerce_before_shop_loop_title() {
	echo '<h1 class="catalog__title">Catalog</h1>';
};
add_action('woocommerce_before_shop_loop', 'xwear_woocommerce_before_shop_loop_end', 25);
function xwear_woocommerce_before_shop_loop_end() {
	echo '</div>';
};

remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
add_action('woocommerce_before_shop_loop_item', 'xwear_woocommerce_template_loop_product_link_open', 10);
function xwear_woocommerce_template_loop_product_link_open() {
	global $product;

	$link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );

	echo '<a href="' . esc_url( $link ) . '" class="product__wrapper woocommerce-LoopProduct-link woocommerce-loop-product__link">';
};

remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);


add_action('woocommerce_before_shop_loop_item_title', 'xwear_woocommerce_template_loop_product_thumbnail_wrapper_start', 5);
function xwear_woocommerce_template_loop_product_thumbnail_wrapper_start() {
	echo '<div class="product__img">';
};
add_action('woocommerce_before_shop_loop_item_title', 'xwear_woocommerce_template_loop_product_thumbnail_wrapper_end', 15);
function xwear_woocommerce_template_loop_product_thumbnail_wrapper_end() {
	echo '</div>';
};

add_filter( 'woocommerce_product_loop_title_classes', 'wp_kama_woocommerce_product_loop_title_classes_filter' );
function wp_kama_woocommerce_product_loop_title_classes_filter( $string ){
	$string = 'product__title ' . $string;
	
	return $string;
};

remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

// Customize Single Product Template by hook

add_action('woocommerce_before_single_product_summary', 'xwear_woocommerce_single_product_row_start', 5);
function xwear_woocommerce_single_product_row_start(){
	echo '<div class="product__row">';
};
add_action('woocommerce_single_product_summary', 'xwear_woocommerce_single_product_row_end', 65);
function xwear_woocommerce_single_product_row_end(){
	echo '</div>';
};
add_action('woocommerce_before_single_product_summary', 'xwear_woocommerce_single_product_col_start', 6);
function xwear_woocommerce_single_product_col_start(){
	echo '<div class="product__col">';
};
add_action('woocommerce_before_single_product_summary', 'xwear_woocommerce_single_product_col_end', 25);
function xwear_woocommerce_single_product_col_end(){
	echo '</div>';
};

remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 8);

add_action('woocommerce_single_product_summary', 'xwear_woocommerce_single_product_title_row_start', 4);
function xwear_woocommerce_single_product_title_row_start(){
	echo '<div class="title_row">';
};
add_action('woocommerce_single_product_summary', 'xwear_woocommerce_single_product_title_row_end', 9);
function xwear_woocommerce_single_product_title_row_end(){
	echo '</div>';
};

// Edit Woocommerce Tabs

add_filter( 'woocommerce_product_tabs', 'xwear_edit_product_tab', 9999);
function xwear_edit_product_tab( $tabs ) {
	if(isset($tabs['description'])) {
		unset($tabs['description']);
	};
   $tabs['faq'] = array(
      'title' => __( 'FAQ', 'woocommerce' ), // TAB TITLE
      'priority' => 40, // TAB SORTING (DESC 10, ADD INFO 20, REVIEWS 30)
      'callback' => 'xwear_faq_product_tab_content', // TAB CONTENT CALLBACK
   );
   return $tabs;
}

function xwear_faq_product_tab_content() {
	echo '
		<div class="info__tab-4">
			<h2 class="tab-4__title">General Issues</h2>
			<div class="tab-4__accordion-all-questions">
				<div class="accordion__item">
					<div class="accordion__header">
					What does our online store do?
					<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M9 17L9 1" stroke="#2C2C2C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M1 9L17 9" stroke="#2C2C2C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
					</div>
					<div class="accordion__content">
					<p>Our online store offers a wide selection of fashionable clothing for any occasion.</p>
					</div>
				</div>
				<div class="accordion__item">
					<div class="accordion__header">
					Is the security of my data guaranteed?
					<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M9 17L9 1" stroke="#2C2C2C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M1 9L17 9" stroke="#2C2C2C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
					</div>
					<div class="accordion__content">
					<p>We keep all your data secure using cutting-edge encryption technology.</p>
					</div>
				</div>
			</div>
			<h2 class="tab-4__title">Products</h2>
			<div class="tab-4__accordion-products">
				<div class="accordion__item">
					<div class="accordion__header">
					Do you sell original products?
					<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M9 17L9 1" stroke="#2C2C2C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M1 9L17 9" stroke="#2C2C2C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
					</div>
					<div class="accordion__content">
					<p>Yes, we guarantee that all products displayed in our store are original and authentic.</p>
					</div>
				</div>
				<div class="accordion__item">
					<div class="accordion__header">
					Are there new products in your store?
					<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M9 17L9 1" stroke="#2C2C2C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M1 9L17 9" stroke="#2C2C2C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
					</div>
					<div class="accordion__content">
					<p>Yes, we regularly update our range with new collections to meet our customers&#700 needs for the latest fashion trends.</p>
					</div>
				</div>
				<div class="accordion__item">
					<div class="accordion__header">
					Why does the price depend on the size?
					<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M9 17L9 1" stroke="#2C2C2C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M1 9L17 9" stroke="#2C2C2C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
					</div>
					<div class="accordion__content">
					<p>Price may vary depending on product size due to differences in manufacturing and material costs.</p>
					</div>
				</div>
				<div class="accordion__item">
					<div class="accordion__header">
					Is the price of the goods final?
					<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M9 17L9 1" stroke="#2C2C2C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M1 9L17 9" stroke="#2C2C2C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
					</div>
					<div class="accordion__content">
					<p>Yes, all prices shown on our website are final and include all additional costs.</p>
					</div>
				</div>
			</div>
			<h2 class="tab-4__title">Shipping</h2>
			<div class="tab-4__accordion-shipping">
				<div class="accordion__item">
					<div class="accordion__header">
					How long does delivery take?
					<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M9 17L9 1" stroke="#2C2C2C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M1 9L17 9" stroke="#2C2C2C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
					</div>
					<div class="accordion__content">
					<p>Delivery time depends on your location and the shipping method you choose, but usually takes from a few days to a few weeks.</p>
					</div>
				</div>
				<div class="accordion__item">
					<div class="accordion__header">
					Is it possible to return an item?
					<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M9 17L9 1" stroke="#2C2C2C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M1 9L17 9" stroke="#2C2C2C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
					</div>
					<div class="accordion__content">
					<p>Yes, we provide the option to return items within a certain period of time after purchase in accordance with our return policy. Please review our return policy on our website or contact our customer service team for more information.</p>
					</div>
				</div>
			</div>
		</div>';
}
//

// Edit Woocommerce Additional Information Table

add_filter('woocommerce_display_product_attributes', 'xwear_display_product_attributes', 10, 2);
function xwear_display_product_attributes($product_attributes, $product) {
	// Categories

    $category_ids = $product->get_category_ids();

    if ( ! empty($category_ids) ) {
        $product_attributes[ 'category-field  category-field-single' ] = array(
            'label' => _n( 'Category', 'Categories', count( $category_ids ), 'woocommerce' ),
            'value' => wc_get_product_category_list( $product->get_id(), ', ', '', '' ),
        );
    }

	return $product_attributes;
}

add_action('woocommerce_after_single_product_summary', 'xwear_interesting_section_container_start', 14);
function xwear_interesting_section_container_start() {
	echo '<section class="interesting__section">';
	echo '<div class="interesting__container">';
}
add_action('woocommerce_after_single_product_summary', 'xwear_interesting_section_container_end', 50);
function xwear_interesting_section_container_end() {
	echo '<div/>';
	echo '<section/>';
}

remove_action('woocommerce_before_single_product', 'woocommerce_output_all_notices', 10);
add_action('woocommerce_before_main_content', 'woocommerce_output_all_notices', 30);


// Change number of related products output
add_filter( 'woocommerce_output_related_products_args', 'xwear_related_products_args', 20 );
function xwear_related_products_args( $args ) {
	$args['posts_per_page'] = 16;
	return $args;
}


// Cart page customize

add_action('woocommerce_before_cart', 'woocommerce_breadcrumb', 20);

remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 10);
add_action('woocommerce_after_cart', 'woocommerce_cross_sell_display', 10);