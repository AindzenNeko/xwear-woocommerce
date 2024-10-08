<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined( 'ABSPATH' ) || exit;

/**
	 * Hook: woocommerce_before_cart.
	 *
	 * ...
	 * @hooked woocommerce_breadcrumb - 20
	 * ...
	 */
do_action( 'woocommerce_before_cart' ); ?>

<section class="cart__section">
	<div class="cart__container">

			<form class="woocommerce-cart-form cart__row" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
				<?php do_action( 'woocommerce_before_cart_table' ); ?>

				<div class="cart-products__wrapper">
				<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents cart-products__table" cellspacing="0">
					<thead>
						<tr>
							<!-- <th class="product-remove"><span class="screen-reader-text"><?php esc_html_e( 'Remove item', 'woocommerce' ); ?></span></th> -->
							<!-- <th class="product-thumbnail"><span class="screen-reader-text"><?php esc_html_e( 'Thumbnail image', 'woocommerce' ); ?></span></th> -->
							<th class="product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
							<th class="product-details"><?php esc_html_e('Details', 'xwear') ?></th>
							<th></th>
							<!-- <th class="product-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th> -->
							<!-- <th class="product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th> -->
							<th class="product-subtotal"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php do_action( 'woocommerce_before_cart_contents' ); ?>

						<?php
						foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
							$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
							$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
							/**
							 * Filter the product name.
							 *
							 * @since 2.1.0
							 * @param string $product_name Name of the product in the cart.
							 * @param array $cart_item The product in the cart.
							 * @param string $cart_item_key Key for the product in the cart.
							 */
							$product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );

							if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
								$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
								?>
								<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item cart-products__product', $cart_item, $cart_item_key ) ); ?>">

									<td class="product-thumbnail product__img">
										<?php
										$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

										if ( ! $product_permalink ) {
											echo $thumbnail; // PHPCS: XSS ok.
										} else {
											printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
										}
										?>
									</td>

									<td>
										<div class="product__details">
											<h3 class="product-name product__title" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
												<?php
												if ( ! $product_permalink ) {
													echo wp_kses_post( $product_name . '&nbsp;' );
												} else {
													/**
													 * This filter is documented above.
													 *
													 * @since 2.1.0
													 */
													echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
												}

												do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

												// Meta data.
												echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

												// Backorder notification.
												if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
													echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
												}
												?>
											</h3>

											<div class="product-price product__price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
												<?php
													//echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
													echo $_product->get_price_html()
												?>
											</div>

											<?php if($_product->is_on_sale()) { 
												$saved_money = $_product->get_regular_price() - $_product->get_sale_price();
											?>
												<div class="product__sale">
													<?php echo 'Save ' . $saved_money . '$' ?>
												</div>	
											<?php } ?>

											<?php if($_product->is_type('variation')) { ?>
												<div class="product__info">
													<?php 
														$_product_attributes = $_product->get_attributes();
														foreach($_product_attributes as $_product_attribute_key => $_product_attribute) {
															if($_product_attribute_key == 'pa_color') { 
																$color = get_term_meta(get_term_by('slug', $_product_attribute, $_product_attribute_key)->term_id)['cfvsw_color'][0];
															?>

																<div class="product__color">
																	<?php echo wc_attribute_label($_product_attribute_key).':'; ?> <span style="background-color: <?php echo $color;?>;" class="color-circle"></span>
																</div>

															<?php } else { ?>
																<div class="product__size">
																<?php echo wc_attribute_label($_product_attribute_key).':'; ?> <span><?php echo $_product_attribute; ?></span>
															</div>

													<?php }} ?>
												</div>
											<?php } ?>
										</div>	
									</td>

									<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
									<?php
									if ( $_product->is_sold_individually() ) {
										$min_quantity = 1;
										$max_quantity = 1;
									} else {
										$min_quantity = 0;
										$max_quantity = $_product->get_max_purchase_quantity();
									}

									$product_quantity = woocommerce_quantity_input(
										array(
											'input_name'   => "cart[{$cart_item_key}][qty]",
											'input_value'  => $cart_item['quantity'],
											'max_value'    => $max_quantity,
											'min_value'    => $min_quantity,
											'product_name' => $product_name,
										),
										$_product,
										false
									);
									?>

									<div class="counter product__counter" data-counter>
										<div class="counter__body">
											<div class="counter__btn counter__minus">
												<button type="button" class="minus__btn">-</button>
											</div>
											<div class="counter__input">
												<?php
												echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
												?>
											</div>
											<div class="counter__btn counter__plus">
												<button type="button" class="plus__btn">+</button>
											</div>
										</div>
									</div>
									</td>

									<td class="product-subtotal product__total" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
										<?php
											echo '<div class="product__totalPrice">';
												echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
											echo '</div>';

											if($_product->is_on_sale()) {
												echo '<div class="product__totalSale">';
												$saved_money_discount = $saved_money * $cart_item['quantity'];
													echo 'Save ' . $saved_money_discount . '$';
												echo '</div>';
											}
										?>
									</td>

									<td class="product-remove product__remove-btn">
										<?php
											echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
												'woocommerce_cart_item_remove_link',
												sprintf(
													'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">
														<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 64 64">
															<path d="M 28 11 C 26.895 11 26 11.895 26 13 L 26 14 L 13 14 C 11.896 14 11 14.896 11 16 C 11 17.104 11.896 18 13 18 L 14.160156 18 L 16.701172 48.498047 C 16.957172 51.583047 19.585641 54 22.681641 54 L 41.318359 54 C 44.414359 54 47.041828 51.583047 47.298828 48.498047 L 49.839844 18 L 51 18 C 52.104 18 53 17.104 53 16 C 53 14.896 52.104 14 51 14 L 38 14 L 38 13 C 38 11.895 37.105 11 36 11 L 28 11 z M 18.173828 18 L 45.828125 18 L 43.3125 48.166016 C 43.2265 49.194016 42.352313 50 41.320312 50 L 22.681641 50 C 21.648641 50 20.7725 49.194016 20.6875 48.166016 L 18.173828 18 z"></path>
														</svg>
													</a>',
													esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
													/* translators: %s is the product name */
													esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) ),
													esc_attr( $product_id ),
													esc_attr( $_product->get_sku() )
												),
												$cart_item_key
											);
										?>
									</td>
								</tr>
								<?php
							}
						}
						?>

						<?php do_action( 'woocommerce_cart_contents' ); ?>

						<tr>
							<td colspan="6" class="actions">

								<button type="submit" style="display: none;" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

								<?php do_action( 'woocommerce_cart_actions' ); ?>

								<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
							</td>
						</tr>

						<?php do_action( 'woocommerce_after_cart_contents' ); ?>
					</tbody>
				</table>
				</div>
				<?php do_action( 'woocommerce_after_cart_table' ); ?>
				

				<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

				<div class="cart-collaterals cart-total__wrapper">
					<?php
						/**
						 * Cart collaterals hook.
						 *
						 * @hooked woocommerce_cart_totals - 10
						 * 
						 * Removed
						 * 
						 * @hooked woocommerce_cross_sell_display - 10
						 * 
						 */
						do_action( 'woocommerce_cart_collaterals' );
					?>
				</div>
			</form>

	</div>
</section>


<?php
	/**
	 * Hook: woocommerce_after_cart
	 *
	 * @hooked woocommerce_cross_sell_display - 10
	 */
	do_action( 'woocommerce_after_cart' ); 
?>
