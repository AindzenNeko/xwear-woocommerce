<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woo.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<form class="woocommerce-ordering" method="get">
	<span class="catalog__sort">
		<!-- <span>Sort by</span> -->
		<div class="dropdown">

			<div class="dropdown__row">
				<span class="dropdown__text">Sort by</span>
				<button class="dropdown__btn">Default</button>
			</div>
			
			<ul class="dropdown__list">
				<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
					<li class="dropdown__list--item" data-value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></li>
				<?php endforeach; ?>
			</ul>
			<!-- <input type="text" class="dropdown__input-hidden" name="dropdown-value" value="1"> -->
			<input type="text" class="dropdown__input-hidden" name="orderby" value="1">
		</div>
	</span>
</form>