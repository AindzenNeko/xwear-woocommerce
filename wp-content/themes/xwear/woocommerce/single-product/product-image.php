<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.8.0
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ( $post_thumbnail_id ? 'with-images' : 'without-images' ),
		// 'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
	)
);
?>

<div class="swiper product__slider <?php // echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" >
	<div class="swiper-wrapper product__slider-wrapper "> <!-- woocommerce-product-gallery__wrapper -->
		<?php 
			if ( $post_thumbnail_id ) {
				echo '<div class="swiper-slide product__slider-slide">';
					echo wp_get_attachment_image($post_thumbnail_id, 'medium');
				echo '</div>';
			} else {
				$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
				$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
				$html .= '</div>';
			}

			if($product->gallery_image_ids) {
				foreach( $product->gallery_image_ids as $image_id) {
					echo '<div class="swiper-slide product__slider-slide">';
						echo wp_get_attachment_image($image_id, 'full');
					echo '</div>';
				}
			}
		?>
	</div>
	<?php do_action( 'woocommerce_product_thumbnails' ); ?>
</div>
