<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$total   = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
$current = isset( $current ) ? $current : wc_get_loop_prop( 'current_page' );
$base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
$format  = isset( $format ) ? $format : '';

if ( $total <= 1 ) {
	return;
}
?>
<nav class="catalog__pagination woocommerce-pagination">
	<?php
	$larr = '<svg width="23" height="10" viewBox="0 0 23 10" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0.54038 4.54038C0.286539 4.79422 0.286539 5.20578 0.54038 5.45962L4.67695 9.59619C4.9308 9.85003 5.34235 9.85003 5.59619 9.59619C5.85003 9.34235 5.85003 8.9308 5.59619 8.67696L1.91924 5L5.59619 1.32304C5.85003 1.0692 5.85003 0.657647 5.59619 0.403806C5.34235 0.149965 4.9308 0.149965 4.67695 0.403806L0.54038 4.54038ZM23 4.35L1 4.35V5.65L23 5.65V4.35Z" fill="#121214"/>
					</svg>';
	$rarr = '<svg width="23" height="10" viewBox="0 0 23 10" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M18.323 9.59624L22.4596 5.45967C22.7135 5.20583 22.7135 4.79427 22.4596 4.54043L18.323 0.403852C18.0692 0.150011 17.6576 0.150011 17.4038 0.403852C17.15 0.657693 17.15 1.06925 17.4038 1.32309L20.4308 4.35005L0 4.35005L0 5.65005L20.4308 5.65005L17.4038 8.677C17.15 8.93084 17.15 9.3424 17.4038 9.59624C17.6576 9.85008 18.0692 9.85008 18.323 9.59624Z" fill="#121214"/>
					</svg>';

	$paginate_links = paginate_links(
		apply_filters(
			'woocommerce_pagination_args',
			array( // WPCS: XSS ok.
				'base'      => $base,
				'format'    => $format,
				'add_args'  => false,
				'current'   => max( 1, $current ),
				'total'     => $total,
				'prev_text' => is_rtl() ? $rarr : $larr,
				'next_text' => is_rtl() ? $larr : $rarr,
				'type'      => 'array',
				'end_size'  => '0',
				'mid_size'  => '3',
			)
		)
	);

	$prev_btn = '<span class="pagination__prev prev-page page-numbers disabled">' . (is_rtl() ? $rarr : $larr) . '</span>';
	$next_btn = '<span class="pagination__next next-page page-numbers disabled">' . (is_rtl() ? $larr : $rarr) . '</span>';

	if ( $current == 1) {
		array_unshift($paginate_links, $prev_btn);
	}
	if ( $current == $total) {
		array_push($paginate_links, $next_btn);
	}

	foreach($paginate_links as $link) {
		echo $link;
	}
	?>
</nav>