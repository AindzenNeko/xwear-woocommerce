<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( $related_products ) : ?>

	<section class="related products interesting__shoes">

		<?php
		$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'woocommerce' ) );

		if ( $heading ) :
			?>
			<div class="interesting__row">
			 	<h2 class="interesting__title"><?php echo esc_html( $heading ); ?></h2>
            </div>
		<?php endif; ?>
		<div class="swiper interesting__slider">
			<div class="swiper-wrapper interesting__slider-wrapper">
				<?php //woocommerce_product_loop_start(); ?>

					<?php foreach ( $related_products as $related_product ) : ?>

						<?php
						$post_object = get_post( $related_product->get_id() );

						setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

						
						?>

						<div class="swiper-slide interesting__slider-slide">
							<a class="interesting__slider-slide-favourite" href="<?php echo $related_product->add_to_cart_url(); ?>">
							<svg width="17" height="20" viewBox="0 0 17 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M8.2995 1.6C7.73948 1.6 7.19868 1.82733 6.7971 2.238C6.39493 2.64928 6.16589 3.21082 6.16589 3.8V5H10.4331V3.8C10.4331 3.21082 10.2041 2.64928 9.80189 2.238C9.40031 1.82733 8.85951 1.6 8.2995 1.6ZM12.0331 5V3.8C12.0331 2.79788 11.644 1.8333 10.9459 1.11936C10.2471 0.404808 9.29556 0 8.2995 0C7.30343 0 6.35188 0.404808 5.65315 1.11936C4.955 1.8333 4.56589 2.79788 4.56589 3.8V5H2.75606M4.56589 6.6H2.75596C2.59211 6.59998 2.42952 6.63616 2.27934 6.70674C2.1291 6.77734 1.99409 6.88102 1.88434 7.01183C1.77454 7.14269 1.69277 7.29744 1.64572 7.46584C1.59868 7.63424 1.58772 7.81141 1.6138 7.98491C1.61379 7.98487 1.6138 7.98495 1.6138 7.98491L2.84102 16.1369C2.91982 16.6608 3.17894 17.1351 3.56681 17.4755C3.95423 17.8154 4.44479 18 4.94932 18C4.94931 18 4.94933 18 4.94932 18H11.6497C12.1543 18.0001 12.6453 17.8157 13.0329 17.4757C13.4209 17.1354 13.6801 16.6611 13.7589 16.137L14.9862 7.98503C15.0123 7.8115 15.0013 7.63428 14.9542 7.46584C14.9072 7.29744 14.8254 7.14268 14.7156 7.01183C14.6059 6.88102 14.4709 6.77734 14.3206 6.70674C14.1705 6.63616 14.008 6.59998 13.8441 6.6H12.0331V8.8C12.0331 9.24183 11.6749 9.6 11.2331 9.6C10.7913 9.6 10.4331 9.24183 10.4331 8.8V6.6H6.16589V8.8C6.16589 9.24183 5.80772 9.6 5.36589 9.6C4.92406 9.6 4.56589 9.24183 4.56589 8.8V6.6ZM12.0331 5H13.8439C13.8439 5 13.844 5 13.8439 5C14.244 4.99997 14.6389 5.08843 15.0011 5.25866C15.3633 5.42888 15.6838 5.67649 15.9413 5.98338C16.1988 6.29021 16.3874 6.64919 16.4952 7.03533C16.6031 7.42144 16.628 7.82647 16.5684 8.22297L15.3411 16.375C15.3411 16.375 15.3411 16.3749 15.3411 16.375C15.2069 17.2677 14.7639 18.0856 14.088 18.6785C13.4116 19.2718 12.5468 19.6002 11.6497 19.6C11.6496 19.6 11.6498 19.6 11.6497 19.6H4.94932C4.05238 19.6 3.18774 19.2714 2.51155 18.6781C1.83582 18.0852 1.39311 17.2677 1.25885 16.3751C1.25885 16.375 1.25886 16.3751 1.25885 16.3751L0.0316256 8.22309C-0.0280014 7.82659 -0.00313763 7.42144 0.104732 7.03533C0.212611 6.64919 0.401203 6.29021 0.658659 5.98338C0.916162 5.67649 1.23663 5.42888 1.59884 5.25866C1.96108 5.08843 2.35596 4.99997 2.75606 5" fill="black"></path>
							</svg>
							</a>
							<a href="<?php echo $related_product->get_permalink();?>" class="interesting__slider-slide-wrapper">
								<div class="interesting__slider-slide-img"><?php echo $related_product->get_image();?></div>
								<div class="interesting__slider-slide-title"><?php echo $related_product->get_title(); ?></div>
								<div class="interesting__slider-slide-price product__price"><?php echo $related_product->get_price_html();?></div>
							</a>
						</div>

					<?php endforeach; ?>

				<?php //woocommerce_product_loop_end(); ?>
			</div>


			<?php if (count($related_products) > 4): ?>
				<div class="interesting__slider-buttons">
					<div class="interesting__slider-button-prev swiper-button-prev">
						<svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M7 13L1 7L7 1" stroke="#121214" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</div>
					<div class="interesting__slider-pagination swiper-pagination"></div>
					<div class="interesting__slider-button-next swiper-button-next">
						<svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M1 13L7 7L1 1" stroke="#121214" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<?php
endif;

wp_reset_postdata();
